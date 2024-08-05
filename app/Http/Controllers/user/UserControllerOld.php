<?php

namespace App\Http\Controllers\user;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
	public function dashboard(Request $request)
	{

		$token = $this->generateToken();
		//  dd($token);
		// Prepare the parameters for the second request
		$params = json_encode([
			"token" => $token,
			"user" => "nikita",
			"cabinet" => "Private Sector Commision of Guyana",
			"folder" => "AR Listing",
			"subfolder" => ""
		]);

		// Initialize a new cURL session for the second request
		$ch2 = curl_init();
		curl_setopt($ch2, CURLOPT_URL, 'https://misha.sharedocsdms.com/ViewDocumentApi/ListDocuments?params=' . urlencode($params));
		curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 0);

		// Execute the second cURL session and store the response
		$response2 = curl_exec($ch2);

		// Check for cURL errors
		if (curl_errno($ch2)) {
			echo 'Curl error: ' . curl_error($ch2);
			return;
		}

		// Check HTTP response code
		$http_code2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
		if ($http_code2 != 200) {
			echo "Request failed with HTTP code $http_code2";
			return;
		}

		// Decode the JSON response from the second request
		$response_data2 = json_decode($response2, true);
		// Close the second cURL session
		curl_close($ch2);
		// dd($response_data2);
		// Extract all files from the response
		$all_files = [];
		foreach ($response_data2 as $data) {
			if (isset($data['files'])) {
				$all_files = array_merge($all_files, $data['files']);
			}
		}

		// Initialize array to hold all file details including view links
		$files_with_links = [];

		//foreach ($all_files as $fileKey => $file) {
		//   $token = $this->generateToken();
		//  $docLink = $this->getDocumentLink($token, $file['FILENAME']);

		// if($docLink !== false){
		//     $all_files[$fileKey]['view_document_link'] = $docLink;
		// }else{
		//     $all_files[$fileKey]['view_document_link'] = 'Not Found';
		// }

		// }

		$files_with_links = $all_files;
		//dd($files_with_links);
		return view('user.dashboard', compact('files_with_links'));
	}

	function getDocumentLink($fileName = null)
	{
		$filename = $_GET['id'];
		$token = $this->generateToken();
		if ($token && $fileName) {
			$params1 = json_encode([
				"token" => $token,
				"user" => "nikita",
				"cabinet" => "Private Sector Commision of Guyana",
				"folder" => "AR Listing",
				"subfolder" => "",
				"document_name" => $fileName
			]);

			$ch3 = curl_init();
			curl_setopt($ch3, CURLOPT_URL, 'https://misha.sharedocsdms.com/ViewDocumentApi/ViewDocumentLink?params=' . urlencode($params1));
			curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch3, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch3, CURLOPT_SSL_VERIFYHOST, 0);

			$response3 = curl_exec($ch3);
			$response_data3 = json_decode($response3, true);


			if (curl_errno($ch3)) {
				echo 'Curl error: ' . curl_error($ch3);
				return;
			}

			$http_code3 = curl_getinfo($ch3, CURLINFO_HTTP_CODE);
			if ($http_code3 != 200) {
				echo "Request failed with HTTP code $http_code3";
				return;
			}

			// if (isset($response_data3[0]['view_document_link'])) {
			//     return $response_data3[0]['view_document_link'];
			// } else {
			//     return false;
			// }
			curl_close($ch3);
		} else {
			return false;
		}
	}

	function getFileDetails(Request $request)
	{
		$validated = $request->validate([
			'fileName' => ['required'],
		]);


		$fileName = $validated['fileName'];
		$token = $this->generateToken();

		if ($token && $fileName) {
			$params1 = json_encode([
				"token" => $token,
				"user" => "nikita",
				"cabinet" => "Private Sector Commision of Guyana",
				"folder" => "AR Listing",
				"subfolder" => "",
				"document_name" => $fileName
			]);

			$ch3 = curl_init();
			curl_setopt($ch3, CURLOPT_URL, 'https://misha.sharedocsdms.com/ViewDocumentApi/ViewDocumentLink?params=' . urlencode($params1));
			curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch3, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch3, CURLOPT_SSL_VERIFYHOST, 0);

			$response3 = curl_exec($ch3);
			$response_data3 = json_decode($response3, true);


			if (curl_errno($ch3)) {
				$data['error'] = true;
				$data['msg'] = 'Missing parameters';
			}

			$http_code3 = curl_getinfo($ch3, CURLINFO_HTTP_CODE);
			if ($http_code3 != 200) {
				$data['error'] = true;
				$data['msg'] = 'Missing parameters';
			}

			$data['error'] = false;
			$data['msg'] = 'Success';
			$data['data'] = $response_data3;
			curl_close($ch3);
		} else {
			$data['error'] = true;
			$data['msg'] = 'Missing parameters';
		}

		return response()->json($data, 200);
	}

	function downFileDetails(Request $request)
	{
		$validated = $request->validate([
			'fileName' => ['required'],
		]);


		$fileName = $validated['fileName'];
		$token = $this->generateToken();

		if ($token && $fileName) {
			$params1 = json_encode([
				"token" => $token,
				"user" => "Ashwini test",
				"path" => "Misha Infotech / ADMINISTRATION",
				"file" => $fileName
			]);

			$ch3 = curl_init();
			curl_setopt($ch3, CURLOPT_URL, 'https://misha.sharedocsdms.com/DownloadApi/document?params=' . urlencode($params1));
			curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch3, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch3, CURLOPT_SSL_VERIFYHOST, 0);

			$response3 = curl_exec($ch3);
			$response_data3 = json_decode($response3, true);


			if (curl_errno($ch3)) {
				$data['error'] = true;
				$data['msg'] = 'Missing parameters';
			}

			$http_code3 = curl_getinfo($ch3, CURLINFO_HTTP_CODE);
			if ($http_code3 != 200) {
				$data['error'] = true;
				$data['msg'] = 'Missing parameters';
			}

			$data['error'] = false;
			$data['msg'] = 'Success';
			$data['data'] = $response_data3;
			curl_close($ch3);
		} else {
			$data['error'] = true;
			$data['msg'] = 'Missing parameters';
		}

		return response()->json($data, 200);
	}

	//Generate Token API

	function generateToken()
	{

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://misha.sharedocsdms.com/TokenApi/genrateToken?api_key=CR6528062024190623&service_name=GuyanaAPI&password=Pass%401234&client_id=65');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

		$response = curl_exec($ch);

		if (curl_errno($ch)) {
			echo 'Curl error: ' . curl_error($ch);
			return;
		}

		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if ($http_code != 200) {
			echo "Request failed with HTTP code $http_code";
			return;
		}


		$response_data = json_decode($response, true);
		curl_close($ch);

		if (!isset($response_data[0]['token'])) {
			return false;
		}

		return $response_data[0]['token'];
	}
}
