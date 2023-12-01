<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AttendanceService;
use App\Http\Requests\AttendanceRequest;
use App\Http\Requests\GetAttendanceRequest;
use Illuminate\Support\Carbon;
use App\Models\Attendance;

class AttendanceController extends Controller
{
  
     /**
     * Get month wise attendance list.
     */
    public function index(GetAttendanceRequest $request){
        
        //validate request data
        $validated = $request->validated(); 
        if($validated){
            $attendances = (new AttendanceService())->index($request);
            if(count($attendances) > 0){
                return response()->json([
                    'success' => true,
                    'message' => "Get attendance successfully",
                    'data' => $attendances
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"No attendance found"
                ],404);
            }
        }

    }

     /**
     * checkin a employee
     */
    public function storeCheckIn(AttendanceRequest $request){
        //validate request data
        $validated = $request->validated();
        if($validated){
            $data = (new AttendanceService())->storeCheckIn($request);
            if($data){
                return response()->json([
                    'success' => false,
                    'message'=>"Employee successfully checkin",
                    'date' => $data
                ],404);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Employee already checkin"
                ],404);
            }
        }
    }


     /**
     * checkout a employee
     */
    public function storeCheckOut(AttendanceRequest $request){
        //validate request data
        $validated = $request->validated();
        if($validated){
            $data = (new AttendanceService())->storeCheckOut($request);
            if($data){
                return response()->json([
                    'success' => false,
                    'message'=>"Employee successfully check out",
                    'date' => $data
                ],404);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Employee not checkin"
                ],404);
            }
        }
    }


     /**
     * Get today attendance
     */
    public function todayAttendance(){
        // if($validated){
            $data = (new AttendanceService())->todayAttendance();
            if(count($data) > 0){
                return response()->json([
                    'success' => true,
                    'message' => "Today attendance fetched successfully",
                    'data' => $data
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"No attendance found"
                ],404);
            }
        // }
    }
}