<?php
namespace App\Services;

use App\Models\OrganizationDocument;
use DateTime;

class OrganizationDocumentService {

     /**
     * Get all organization Documents
     *
     * @return array
     */
    public function index($company_id){
        if(auth('sanctum')->user()->company_id == $company_id){
            $organizationDocuments = OrganizationDocument::where('company_id',$company_id)->where('is_organization','yes')->get();
            return $organizationDocuments;
        } else {
            return false;
        }
    }


     /**
     * Get all employees documents of this organization
     *
     * @return array
     */
    public function employeeDocument($company_id){
        if(auth('sanctum')->user()->company_id == $company_id){
            $organizationDocuments = OrganizationDocument::where('company_id',$company_id)->where('is_organization','no')->get();
            return $organizationDocuments;
        } else {
            return false;
        }
    }


    /**
     * store the new document request to organization_document
     *
     * @return array
     */
    public function store($request){
        // create Organization Document data
        $organizationDocument = new OrganizationDocument;
        $organizationDocument->user_id = auth('sanctum')->user()->id;
        $organizationDocument->company_id = auth('sanctum')->user()->company_id;
        $organizationDocument->document_type = $request->document_type;
        if($request->hasFile('document')){
            //helper for uploading file
            $response = uploadImage($request->document,'images/organization/documents');//file to upload, where to upload
            $organizationDocument->document = $response;
        }
        $organizationDocument->uploaded_on = date('Y-m-d H:i:s');
        $organizationDocument->uploaded_by = auth('sanctum')->user()->name;
        if(auth('sanctum')->user()->roles->contains('name', 'admin')){
            $organizationDocument->is_organization = 'yes';
        }
        if($organizationDocument->save()){
            return $organizationDocument;
        }
    }
    
   
    /**
     * Get a document
     *
     * @return array
     */    
    public function show($id){
        $organizationDocument = OrganizationDocument::find($id);
        if ($organizationDocument) {
            return $organizationDocument;
        } else {
            return false;
        }
    }


     /**
     * update the document
     *
     * @return array
     */
    public function update($request,$id){
        // update document data
        $document = OrganizationDocument::find($id);
        if($document){
           
            if($document->save()){
                return $document;
            } else{
                return false;
            }
        } else{
            return false;
        }
        
    }

    /**
     * Destroy a  document
     *
     * @return array
     */    
    public function destroy($id){
        $document = OrganizationDocument::find($id);
        if($document){
            if(auth('sanctum')->user()->id == $document->user_id){
                $document->delete();
                return true;
            } else{
                return false;
            }
        } else{
            return false;
        }
    }

}