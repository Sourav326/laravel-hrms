<?php
namespace App\Services;

use App\Models\Company;
use App\Models\User;

class CompanyService {

    
    /**
     * store the request to companies.
     *
     * @return array
     */
    public function store($request){
        // create department data
        $company = new Company;
        $company->name = $request->name;
        $company->prefix = $request->prefix;
        if($company->save()){
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password  = bcrypt($request->name);
            $user->company_id = $company->id;
            $user->is_company_superadmin = '1';
            $user->save();
            $user->roles()->attach(2);//for admin role id is 2
            return $company;
        }
    }
    
   
    /**
     * Get a  department
     *
     * @return array
     */    
    public function show($id){
        $company = Company::find($id);
        if ($company) {
            return $company;
        } else {
            return false;
        }
    }


     /**
     * update the request to department
     *
     * @return array
     */
    public function update($request,$id){
        // update department data
        $department = company::find($id);
        if($department){
            $department->department_name = $request->department_name;
            $department->manager = $request->manager;
            $department->parent_department = $request->parent_department;
            if($department->save()){
                return $department;
            } else{
                return false;
            }
        } else{
            return false;
        }
        
    }

    /**
     * Destroy a  employee
     *
     * @return array
     */    
    public function destroy($id){
        $department = Department::find($id);
        if($department){
        $department->delete();
        return true;
        } else{
            return false;
        }
    }

     /**
     * Destroy a  employee
     *
     * @return array
     */    
    public function status($request,$id){
        $department = Department::find($id);
        if($department){
            $department->status = $request->status;
            $department->save();
            return true;
        } else{
            return false;
        }
    }
}