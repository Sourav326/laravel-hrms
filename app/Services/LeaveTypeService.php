<?php
namespace App\Services;

use App\Models\LeaveType;
use App\Models\User;

class LeaveTypeService {


    /**
     * Get all leave types
     *
     * @return array
     */
    public function index(){
        $leaveTypes = LeaveType::where('company_id',auth('sanctum')->user()->company_id)->where('status','1')->get();
        return $leaveTypes;
    }

    
    /**
     * store the leave request to leaves.
     *
     * @return array
     */
    public function store($request){
        $isLeaveTypeAvailable = LeaveType::where('company_id',$request->company_id)->where('type',$request->type)->first();
        if(!$isLeaveTypeAvailable){
            // create leave Type data
            $leaveType = new LeaveType;
            $leaveType->created_by = auth('sanctum')->id();
            $leaveType->company_id = $request->company_id;
            $leaveType->type = $request->type;
            $leaveType->annual_allocation = $request->annual_allocation;
            if($leaveType->save()){
                return $leaveType;
            }
        } else {
            return false;
        }
    }
    
   
    /**
     * Get a  leave type
     *
     * @return array
     */    
    public function show($id){
        $leaveType = LeaveType::find($id);
        if ($leaveType) {
            return $leaveType;
        } else {
            return false;
        }
    }


     /**
     * update the request to leave type
     *
     * @return array
     */
    public function update($request,$id){
        // update leave type data
        $leaveType = LeaveType::find($id);
        if($leaveType){
            $leaveType->company_id = $request->company_id;
            $leaveType->type = $request->type;
            $leaveType->annual_allocation = $request->annual_allocation;
            if($leaveType->save()){
                return $leaveType;
            } else{
                return false;
            }
        } else{
            return false;
        }
        
    }

    /**
     * Destroy a  leave type
     *
     * @return array
     */    
    public function destroy($id){
        $leaveType = LeaveType::find($id);
        if($leaveType){
        $leaveType->delete();
        return true;
        } else{
            return false;
        }
    }

     /**
     * Update leave type status
     *
     * @return array
     */    
    public function status($request,$id){
        $leaveType = LeaveType::find($id);
        if($leaveType){
            $leaveType->status = $request->status;
            $leaveType->save();
            return true;
        } else{
            return false;
        }
    }
}