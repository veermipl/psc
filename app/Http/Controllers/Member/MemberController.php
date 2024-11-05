<?php

namespace App\Http\Controllers\Member;

use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MemberController extends Controller
{
	public function dashboard(Request $request)
	{
		$this->authorize('member_dashboard');
		$id = Auth::user()->id;

	
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
		return view('member.dashboard', compact('files_with_links', 'error_msg'));
		
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

	public function application_form(Request $request){

		// dd($request->all());
		$this->validate($request, [
            'applicationtypeid' => 'required',
            'name_of_business'  => 'required',
			'legal_status'  => 'required',
            'date_of_egistration'  => 'required',
            'sector'  => 'required',
			'No_of_employees'  => 'required',
			'registered_office_address'  => 'required',
			'type_of_business'  => 'required',
            'telephone_no'  => 'required',
			'fax_no'  => 'required',
            'email'  => 'required',
			'website'  => 'required',
            'membership_id'  => 'required',
			'your_expectation.*'  => 'required',
            'contribute_towards.*'  => 'required',
			'state_briefly'  => 'required',
            'you_know_about'  => 'required',
			'references_name.*'  => 'required',
            'references_address.*'  => 'required',
			'references_name_of_business.*'  => 'required',
            'references_tel_nos.*'  => 'required',
			'references_email.*'  => 'required',
            'references_website.*'  => 'required',
			'principal_name'  => 'required',
            'principal_designation'  => 'required',
			'principal_signature'  => 'required',
            'principal_date'  => 'required',           
           
	 ], [
		'applicationtypeid.required' => 'The application type is required.',
		'name_of_business.required' => 'Please provide the name of the business.',
		'legal_status.required' => 'The legal status field is mandatory.',
		'date_of_egistration.required' => 'Please specify the date of registration.',
		'sector.required' => 'Please choose the sector.',
		'No_of_employees.required' => 'Enter the number of employees.',
		'registered_office_address.required' => 'The office address is required.',
		'type_of_business.required' => 'Please specify the type of business.',
		'telephone_no.required' => 'Please provide a telephone number.',
		'fax_no.required' => 'Fax number is required.',
		'email.required' => 'Please provide an email address.',
		'website.required' => 'Website is required.',
		'membership_id.required' => 'Please provide a membership ID.',
		'your_expectation.*.required' => 'Please specify your expectations.',
		'contribute_towards.*.required' => 'Please specify how you will contribute.',
		'state_briefly.required' => 'Please provide a brief statement.',
		'you_know_about.required' => 'How you know about us is required.',
		'references_name.*.required' => 'Name is required for all entries.',
		'references_address.*.required' => 'Address is required for all entries.',
		'references_name_of_business.*.required' => 'Business name is required for all entries.',
		'references_tel_nos.*.required' => 'Telephone number is required for all entries.',
		'references_email.*.required' => 'Email is required for all entries.',
		'references_website.*.required' => 'Website is required for all entries.',
		'principal_name.required' => 'The  name is required.',
		'principal_designation.required' => 'The  designation is required.',
		'principal_signature.required' => 'The  signature is required.',
		'principal_date.required' => 'Please provide the date.',
	
	]);

   
		   $your_expectation =  implode(',', $request->your_expectation) ;
		   $contribute_towards =  implode(',', $request->contribute_towards) ;
		   $references_name =  implode(',', $request->references_name) ;
		   $references_address =  implode(',', $request->references_address) ;
		   $references_name_of_business =  implode(',', $request->references_name_of_business) ;
		   $references_tel_nos =  implode(',', $request->references_tel_nos) ;
		   $references_email =  implode(',', $request->references_email) ;
		   $references_website =  implode(',', $request->references_website) ;
   
		   $id = Auth::user()->id;
		   Application::create([
			   'user_id' => $id,
			   'application_type_id' => $request->applicationtypeid,
			   'name_of_business' => $request->name_of_business,
			   'legal_status' => $request->legal_status,
			   'date_of_egistration' => $request->date_of_egistration,
			   'sector' => $request->sector,
			   'No_of_employees' => $request->No_of_employees,
			   'registered_office_address' => $request->registered_office_address,
			   'type_of_business' => $request->type_of_business,
			   'telephone_no' => $request->telephone_no,
			   'fax_no' => $request->fax_no,
			   'email' => $request->email,
			   'website' => $request->website,
			   'membership_id' => $request->membership_id,
			   'state_briefly' => $request->state_briefly,
			   'you_know_about' => $request->you_know_about,
			   'principal_name' => $request->principal_name,
			   'principal_designation' => $request->principal_designation,
			   'principal_signature' => $request->principal_signature,
			   'principal_date' => $request->principal_date,
			   'your_expectation' => $your_expectation,
			   'contribute_towards' => $contribute_towards,
			   'contribute_towards' => $contribute_towards,
			   'references_name' => $references_name,
			   'references_address' => $references_address,
			   'references_name_of_business' => $references_name_of_business,
			   'references_tel_nos' => $references_tel_nos,
			   'references_email' => $references_email,
			   'references_website' => $references_website,
		   ]);
   
		   return redirect()->route('member.dashboard')->with('success', 'Data Sumbmt successfully');
   
	   }


}