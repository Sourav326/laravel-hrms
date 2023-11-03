<?php
namespace App\Services;

use App\Models\Employee;
use App\Models\User;
use App\Models\Document;
use App\Models\EducationCertificate;

class EmployeeService {

     /**
     * Get all employees
     *
     * @return array
     */
    public function index(){
        $employees = Employee::where('created_by',auth('sanctum')->id())->get();
        return $employees;
    }

    
    /**
     * store the request to employees.
     *
     * @return array
     */
    public function store($request){
        // create user data
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role  = 'user';
        $user->password  = bcrypt($request->name);
        if($request->hasFile('profile_image')){
            //helper for uploading file
            $response = uploadImage($request->profile_image,'images/employees');//file to upload, where to upload
        }
        $user->profile_image = $response;
        
        if($user->save()){
            
            // create employee data
            $employee = new Employee;
            $employee->user_id = $user->id;
            $employee->created_by = auth('sanctum')->id();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->mobile = $request->mobile;
            $employee->emergency_mobile = $request->emergency_mobile;
            $employee->permanent_address = $request->permanent_address;
            $employee->temporary_address = $request->temporary_address;
            $employee->nationality = $request->nationality;
            $employee->marital_status = $request->marital_status;
            $employee->blood_type = $request->blood_type;
            $employee->gender = $request->gender;
            $employee->dob = $request->dob;
            $employee->birth_place = $request->birth_place;
            $employee->department = $request->department;
            $employee->job_position = $request->job_position;
            $employee->manager = $request->manager;
            $employee->work_email = $request->work_email;
            $employee->time_off_approver = $request->time_off_approver;
            $employee->timesheet_approver = $request->timesheet_approver;
            $employee->working_hours = $request->working_hours;
            $employee->timezone = $request->timezone;
            $employee->bank_name = $request->bank_name;
            $employee->bank_branch = $request->bank_branch;
            $employee->account_holder_name = $request->account_holder_name;
            $employee->account_type = $request->account_type;
            $employee->account_nmber = $request->account_nmber;
            $employee->ifsc = $request->ifsc;
            $employee->employee_code = $request->employee_code;
            $employee->pay_period = $request->pay_period;
            $employee->pay_rate = $request->pay_rate;
            $employee->pay_type = $request->pay_type;
            $employee->hours_worked = $request->hours_worked;
            $employee->overtime_hours = $request->overtime_hours;
            $employee->overtime_pay_rate = $request->overtime_pay_rate;
            $employee->overtime_pay = $request->overtime_pay;
            $employee->deductions = $request->deductions;
            $employee->federal_income_tax = $request->federal_income_tax;
            $employee->state_income_tax = $request->state_income_tax;
            $employee->local_income_tax = $request->local_income_tax;
            $employee->social_security = $request->social_security;
            $employee->medicare = $request->medicare;
            $employee->retirement_contribution = $request->retirement_contribution;
            $employee->health_insurance_premium = $request->health_insurance_premium;
            $employee->net_pay = $request->net_pay;
            $employee->save();
            
            
            //Upload documents
            if($request->hasFile('documents')){
                
                $document_type = $request->document_type;
                $document_number = $request->document_number;
                
                for($i = 0; $i<count($document_type);$i++){
                    
                    //helper for uploading file
                    $documentResponse = uploadImage($request->documents[$i],'images/employees/documents');//file to upload, where to upload
                    $documentSave = [
                        'user_id' => $user->id,
                        'document_type' => $document_type[$i],
                        'document_number' => $document_number[$i],
                        'document_url' => $documentResponse,
                    ];
                    Document::insert($documentSave);
                }          
            }
            
            // Upload Educational certificates
            if($request->hasFile('certificates')){
                $certificate_level = $request->certificate_level;
                $field_of_study = $request->field_of_study;
                $school_university = $request->school_university;
                
                for($i = 0; $i<count($certificate_level);$i++){
                    //helper for uploading file
                    $certificateResponse = uploadImage($request->certificates[$i],'images/employees/certificates');//file to upload, where to upload
                    $certificateSave = [
                        'user_id' => $user->id,
                        'certificate_level' => $certificate_level[$i],
                        'field_of_study' => $field_of_study[$i],
                        'school_university' => $school_university[$i],
                        'certificate_url' => $certificateResponse,
                    ];
                    EducationCertificate::insert($certificateSave);
                }
            }
            return $user;
        }
    }

    /**
     * Get a  employee
     *
     * @return array
     */    
    public function show($id){
        $user = User::with('employee', 'documents', 'certificates')->find($id);
        if ($user) {
            return $user;
        } else {
            return false;
        }
    }


     /**
     * store the request to employees.
     *
     * @return array
     */
    public function update($request){
        // create user data
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role  = 'user';
        $user->password  = bcrypt($request->name);
        if($request->hasFile('profile_image')){
            //helper for uploading file
            $response = uploadImage($request->profile_image,'images/employees');//file to upload, where to upload
        }
        $user->profile_image = $response;
        
        if($user->save()){
            
            // create employee data
            $employee = new Employee;
            $employee->user_id = $user->id;
            $employee->created_by = auth('sanctum')->id();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->mobile = $request->mobile;
            $employee->emergency_mobile = $request->emergency_mobile;
            $employee->permanent_address = $request->permanent_address;
            $employee->temporary_address = $request->temporary_address;
            $employee->nationality = $request->nationality;
            $employee->marital_status = $request->marital_status;
            $employee->blood_type = $request->blood_type;
            $employee->gender = $request->gender;
            $employee->dob = $request->dob;
            $employee->birth_place = $request->birth_place;
            $employee->department = $request->department;
            $employee->job_position = $request->job_position;
            $employee->manager = $request->manager;
            $employee->work_email = $request->work_email;
            $employee->time_off_approver = $request->time_off_approver;
            $employee->timesheet_approver = $request->timesheet_approver;
            $employee->working_hours = $request->working_hours;
            $employee->timezone = $request->timezone;
            $employee->bank_name = $request->bank_name;
            $employee->bank_branch = $request->bank_branch;
            $employee->account_holder_name = $request->account_holder_name;
            $employee->account_type = $request->account_type;
            $employee->account_nmber = $request->account_nmber;
            $employee->ifsc = $request->ifsc;
            $employee->employee_code = $request->employee_code;
            $employee->pay_period = $request->pay_period;
            $employee->pay_rate = $request->pay_rate;
            $employee->pay_type = $request->pay_type;
            $employee->hours_worked = $request->hours_worked;
            $employee->overtime_hours = $request->overtime_hours;
            $employee->overtime_pay_rate = $request->overtime_pay_rate;
            $employee->overtime_pay = $request->overtime_pay;
            $employee->deductions = $request->deductions;
            $employee->federal_income_tax = $request->federal_income_tax;
            $employee->state_income_tax = $request->state_income_tax;
            $employee->local_income_tax = $request->local_income_tax;
            $employee->social_security = $request->social_security;
            $employee->medicare = $request->medicare;
            $employee->retirement_contribution = $request->retirement_contribution;
            $employee->health_insurance_premium = $request->health_insurance_premium;
            $employee->net_pay = $request->net_pay;
            $employee->save();
            
            
            //Upload documents
            if($request->hasFile('documents')){
                
                $document_type = $request->document_type;
                $document_number = $request->document_number;
                
                for($i = 0; $i<count($document_type);$i++){
                    
                    //helper for uploading file
                    $documentResponse = uploadImage($request->documents[$i],'images/employees/documents');//file to upload, where to upload
                    $documentSave = [
                        'user_id' => $user->id,
                        'document_type' => $document_type[$i],
                        'document_number' => $document_number[$i],
                        'document_url' => $documentResponse,
                    ];
                    Document::insert($documentSave);
                }          
            }
            
            // Upload Educational certificates
            if($request->hasFile('certificates')){
                $certificate_level = $request->certificate_level;
                $field_of_study = $request->field_of_study;
                $school_university = $request->school_university;
                
                for($i = 0; $i<count($certificate_level);$i++){
                    //helper for uploading file
                    $certificateResponse = uploadImage($request->certificates[$i],'images/employees/certificates');//file to upload, where to upload
                    $certificateSave = [
                        'user_id' => $user->id,
                        'certificate_level' => $certificate_level[$i],
                        'field_of_study' => $field_of_study[$i],
                        'school_university' => $school_university[$i],
                        'certificate_url' => $certificateResponse,
                    ];
                    EducationCertificate::insert($certificateSave);
                }
            }
            return $user;
        }
    }






    /**
     * Destroy a  employee
     *
     * @return array
     */    
    public function destroy($id){
        $user = User::find($id);
        if($user){
        $user->employee()->delete();
        $user->documents()->delete();
        $user->certificates()->delete();
        $user->delete();
        return true;
        } else{
            return false;
        }
    }
}