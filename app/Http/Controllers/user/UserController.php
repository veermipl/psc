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
		$error_msg = null;
		$token = $this->generateToken();

		$params = [
			"token" => $token,
			"user" => "nikita",
			"cabinet" => "Private Sector Commision of Guyana",
			"folder" => "AR Listing",
			"subfolder" => ""
		];

		$response = Http::withOptions(['verify' => false])
			->get('https://misha.sharedocsdms.com/ViewDocumentApi/ListDocuments', ['params' => json_encode($params)]);

		if ($response->failed()) {
			$error_msg = "Request failed with HTTP code " . $response->status();
		}

		$response_data = $response->json();
		$all_files = [];
		foreach ($response_data as $data) {
			if (isset($data['files'])) {
				$all_files = array_merge($all_files, $data['files']);
			}
		}

		$files_with_links = $all_files;

		return view('user.dashboard', compact('files_with_links', 'error_msg'));
	}

	function getDocumentLink($fileName = null)
	{
		$filename = $_GET['id'];
		$token = $this->generateToken();
		if ($token && $fileName) {
			$params = [
				"token" => $token,
				"user" => "nikita",
				"cabinet" => "Private Sector Commision of Guyana",
				"folder" => "AR Listing",
				"subfolder" => "",
				"document_name" => $fileName
			];

			$response = Http::withOptions(['verify' => false])
				->get('https://misha.sharedocsdms.com/ViewDocumentApi/ViewDocumentLink', ['params' => json_encode($params)]);

			if ($response->failed()) {
				echo "Request failed with HTTP code " . $response->status();
				return false;
			}

			$response_data = $response->json();

			// Close curl is not necessary as we are using HTTP facade.
			if (isset($response_data[0]['view_document_link'])) {
				return $response_data[0]['view_document_link'];
			} else {
				return false;
			}
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
			$params = [
				"token" => $token,
				"user" => "nikita",
				"cabinet" => "Private Sector Commision of Guyana",
				"folder" => "AR Listing",
				"subfolder" => "",
				"document_name" => $fileName
			];

			$response = Http::withOptions(['verify' => false])
				->get('https://misha.sharedocsdms.com/ViewDocumentApi/ViewDocumentLink', ['params' => json_encode($params)]);

			if ($response->failed()) {
				return response()->json([
					'error' => true,
					'msg' => 'Missing parameters',
				], 400);
			}

			$response_data = $response->json();

			return response()->json([
				'error' => false,
				'msg' => 'Success',
				'data' => $response_data,
			], 200);
		} else {
			return response()->json([
				'error' => true,
				'msg' => 'Missing parameters',
			], 400);
		}
	}

	function downFileDetails(Request $request)
	{
		$validated = $request->validate([
			'fileName' => ['required'],
		]);

		$fileName = $validated['fileName'];
		$token = $this->generateToken();

		if ($token && $fileName) {
			$params = [
				"token" => $token,
				"user" => "Ashwini test",
				"path" => "Misha Infotech / ADMINISTRATION",
				"file" => $fileName
			];

			$response = Http::withOptions(['verify' => false])
				->get('https://misha.sharedocsdms.com/DownloadApi/document', ['params' => json_encode($params)]);

			if ($response->failed()) {
				return response()->json([
					'error' => true,
					'msg' => 'Missing parameters',
				], 400);
			}

			$response_data = $response->json();

			return response()->json([
				'error' => false,
				'msg' => 'Success',
				'data' => $response_data,
			], 200);
		} else {
			return response()->json([
				'error' => true,
				'msg' => 'Missing parameters',
			], 400);
		}
	}

	//Generate Token API
	function generateToken()
	{
		$url = 'https://misha.sharedocsdms.com/TokenApi/genrateToken';
		$params = [
			'api_key' => 'CR6528062024190623',
			'service_name' => 'GuyanaAPI',
			'password' => 'Pass@1234',
			'client_id' => '65'
		];

		$response = Http::withOptions(['verify' => false])
			->get($url, $params);

		if ($response->failed()) {
			return false;
		}

		$response_data = $response->json();

		if (!isset($response_data[0]['token'])) {
			return false;
		}

		return $response_data[0]['token'];
	}
}
