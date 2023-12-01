<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LeaveRequest;
use App\Services\LeaveService;

class LeaveController extends Controller
{
    public function applyLeave(LeaveRequest $request){
        //validate request data
        $validated = $request->validated();
        if($validated){
            $data = (new LeaveService())->applyLeave($request);
            if($data){
                return response()->json([
                    'success' => false,
                    'message'=>"Leave Applied successfully.",
                    'date' => $data
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Leave Not Applied."
                ],404);
            }
        }
    }


    public function newLeaveRequests(){
        $data = (new LeaveService())->newLeaveRequests();
        if($data == false){
            return response()->json([
                'success' => false,
                'message'=>"No new leave requests."
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Lew leave requests fetched successfully.",
                'date' => $data
            ],200);
        }
    }
}
