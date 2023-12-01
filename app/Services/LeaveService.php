<?php
namespace App\Services;

use App\Models\Leave;
use App\Models\User;
use DateTime;

class LeaveService {

    
    /**
     * store the leave request to leaves.
     *
     * @return array
     */
    public function applyLeave($request){
        // create leave data
        $leave = new Leave;
        $leave->user_id = auth('sanctum')->user()->id;
        $leave->apply_date = $request->apply_date;
        $leave->leave_from = $request->leave_from;
        $leave->leave_to = $request->leave_to;
        $leave->leave_type = $request->leave_type;
        $leave->leave_remark = $request->leave_remark;
        $leave->company_id = auth('sanctum')->user()->company_id;

        $from_date = new DateTime($request->leave_from);
        $to_date = new DateTime($request->leave_to);
        $day     = $from_date->diff($to_date);
        $leave->days    = $day->d + 1;
        if($leave->save()){
            return $leave;
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
     * Change employee
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


     /**
     * Get new leave requests
     *
     * @return array
     */ 
    public function newLeaveRequests(){
        $user = auth('sanctum')->user();
        $user_id = $user->id;
        $company_id = $user->company_id;
        $latest_leaves = Leave::where('company_id',$company_id)->latest()->get();
        if(count($latest_leaves) > 0){
            return $latest_leaves;
        } else{
            return false;
        }



    }
}