<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrganizationDocumentService;
use App\Http\Requests\OrganizationDocumentRequest;

class OrganizationDocumentController extends Controller
{
     /**
     * Get all documents of this Organization
     */
    public function index($company_id){
        $documents = (new OrganizationDocumentService())->index($company_id);
        if($documents == false){
            return response()->json([
                'success' => false,
                'message'=>"No documents found"
            ],404);
        }
        if(count($documents) > 0){
            return response()->json([
                'success' => true,
                'message' => "Get organization documents successfully",
                'data' => $documents
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message'=>"No documents found"
            ],404);
        }
    }


     /**
     * Get all documents of all employees of this Organization
     */
    public function employeeDocument($company_id){
        $documents = (new OrganizationDocumentService())->employeeDocument($company_id);
        if($documents == false){
            return response()->json([
                'success' => false,
                'message'=>"No documents found"
            ],404);
        }
        if(count($documents) > 0){
            return response()->json([
                'success' => true,
                'message' => "Get employees documents successfully",
                'data' => $documents
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message'=>"No documents found"
            ],404);
        }
    }


     /**
     * store the organization documents
     */
    public function store(OrganizationDocumentRequest $request){
        //validate request data
        $validated = $request->validated();
        if($validated){
            $data = (new OrganizationDocumentService())->store($request);
            if($data){
                return response()->json([
                    'success' => false,
                    'message'=>"Document uploaded successfully.",
                    'date' => $data
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Document not uploaded."
                ],404);
            }
        }
    }

     /**
     * Get document details
     */
    public function show($id){
        if($id){
            $document = (new OrganizationDocumentService())->show($id);
            if($document){
                return response()->json([
                    'success' => true,
                    'message' => "Get document successfully",
                    'data' => $document
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Document not valid"
                ],404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Document not valid"
            ],404);
        }
    }

     /**
     * Update a document
     */
    public function update(OrganizationDocumentRequest $request,$id){
        //validate request data
        $validated = $request->validated();
        if($validated){
            $data = (new OrganizationDocumentService())->update($request,$id);
            if($data){
                return response()->json([
                    'success' => true,
                    'message' => "Document updated successfully",
                    'data' => $data
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Document not valid"
                ],404);
            }
        }
    }

     /**
     * Delete document
     */
    public function destroy($id){
        if($id){
            $response = (new OrganizationDocumentService())->destroy($id);
            if($response){
                return response()->json([
                    'success' => true,
                    'message' => "Document deleted successfully",
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Document not valid"
                ],404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Document not valid"
            ],404);
        }
    }

}
