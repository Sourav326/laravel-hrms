<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LeaveTypeRequest;
use App\Services\LeaveTypeService;
use App\Http\Requests\UserStatusRequest;

class LeaveTypeController extends Controller
{
     /**
     * Get all leave type list
     */
    public function index(){
        $departments = (new LeaveTypeService())->index();
        if(count($departments) > 0){
            return response()->json([
                'success' => true,
                'message' => "Get leave types successfully",
                'data' => $departments
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message'=>"No Leave types found"
            ],404);
        }
    }

    /**
     * Add leave type
     */
    public function store(LeaveTypeRequest $request){
        //validate request data
        $validated = $request->validated();
        if($validated){
            $data = (new LeaveTypeService())->store($request);
            if($data == false){
                return response()->json([
                    'success' => false,
                    'message'=>"Leave type must be unique"
                ],404);
            } else if($data){
                return response()->json([
                    'success' => false,
                    'message'=>"Leave type created successfully.",
                    'date' => $data
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Leave type not created."
                ],404);
            }
        }
       
    }


     /**
     * Get leave type details
     */
    public function show($id){
        if($id){
            $leaveType = (new LeaveTypeService())->show($id);
            if($leaveType){
                return response()->json([
                    'success' => true,
                    'message' => "Get leave type successfully",
                    'data' => $leaveType
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Leave type not valid"
                ],404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Leave type not valid"
            ],404);
        }
    }

    /**
     * Update a leave type
     */
    public function update(LeaveTypeRequest $request,$id){
        //validate request data
        $validated = $request->validated();
        if($validated){
            $data = (new LeaveTypeService())->update($request,$id);
            if($data){
                return response()->json([
                    'success' => true,
                    'message' => "Leave type updated successfully",
                    'data' => $data
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Leave type not valid"
                ],404);
            }
        }
    }

     /**
     * Delete leave type
     */
    public function destroy($id){
        if($id){
            $response = (new LeaveTypeService())->destroy($id);
            if($response){
                return response()->json([
                    'success' => true,
                    'message' => "Leave type deleted successfully",
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Leave type not valid"
                ],404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Leave type not valid"
            ],404);
        }
    }

     /**
     * Update leave type status
     */
    public function status(UserStatusRequest $request,$id){
        if($id){
            $response = (new LeaveTypeService())->status($request,$id);
            if($response){
                return response()->json([
                    'success' => true,
                    'message' => "Leave type status updated",
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Leave type not valid"
                ],404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Leave type not valid"
            ],404);
        }
    }
}
