<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RetrieveDocumentLink
{
    public function handle(Request $request, Closure $next)
    {
        // Generate token
        $response = Http::get('https://misha.sharedocsdms.com/TokenApi/genrateToken', [
            'api_key' => 'CR6528062024190623',
            'service_name' => 'GuyanaAPI',
            'password' => 'Pass@1234',
            'client_id' => '65'
        ]);

        if ($response->successful()) {
            $tokenData = $response->json();

            if (isset($tokenData[0]['token'])) {
                $token = $tokenData[0]['token'];

                // Get the document link
                $params = [
                    "token" => $token,
                    "user" => "nikita",
                    "cabinet" => "Private Sector Commision of Guyana",
                    "folder" => "AR Listing",
                    "subfolder" => "",
                    "document_name" => "AR_Listing.pdf"
                ];

                $documentResponse = Http::get('https://misha.sharedocsdms.com/ViewDocumentApi/ViewDocumentLink', [
                    'params' => json_encode($params)
                ]);

                if ($documentResponse->successful()) {
                    $documentData = $documentResponse->json();

                    if (isset($documentData[0]['view_document_link'])) {
                        $documentLink = $documentData[0]['view_document_link'];
                        session(['document_link' => $documentLink]);
                    } else {
                        session()->flash('error', 'Document link not found');
                    }
                } else {
                    session()->flash('error', 'Failed to retrieve document link');
                }
            } else {
                session()->flash('error', 'Token not found in the response');
            }
        } else {
            session()->flash('error', 'Failed to generate token');
        }

        return $next($request);
    }
}
