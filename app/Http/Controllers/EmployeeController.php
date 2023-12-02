<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmployeeService;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\UserStatusRequest;
use App\Models\User;


class EmployeeController extends Controller
{
     /**
     * Get all employees list.
     */
    public function index(Request $request){
        $employees = (new EmployeeService())->index($request);
        if(count($employees) > 0){
            return response()->json([
                'success' => true,
                'message' => "Get employees successfully",
                'data' => $employees
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message'=>"No employees found"
            ],404);
        }
    }

     /**
     * Store a employee.
     */
    public function store(EmployeeStoreRequest $request){
        //validate request data
        $validated = $request->validated();
        if($validated){
            $data = (new EmployeeService())->store($request);
            if($data){
                return response()->json([
                    'success' => true,
                    'message' => "Employees created successfully",
                    'data' => $data
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Employees not created"
                ],404);
            }
        }
    }

     /**
     * Get employee details.
     */
    public function show($id){
        if($id){
            $user = (new EmployeeService())->show($id);
            if($user){
                return response()->json([
                    'success' => true,
                    'message' => "Get employee successfully",
                    'data' => $user
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Employee not valid"
                ],404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Employee not valid"
            ],404);
        }
    }

     /**
     * Update a employee.
     */
    public function update(EmployeeStoreRequest $request,$id){
        //validate request data
        $validated = $request->validated();
        if($validated){
            $data = (new EmployeeService())->update($request,$id);
            if($data){
                return response()->json([
                    'success' => true,
                    'message' => "Employees updated successfully",
                    'data' => $data
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Employees not created"
                ],404);
            }
        }
    }

     /**
     * Delete employee.
     */
    public function destroy($id){
        if($id){
            $response = (new EmployeeService())->destroy($id);
            if($response){
                return response()->json([
                    'success' => true,
                    'message' => "Employee deleted successfully",
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Employee not valid"
                ],404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Employee not valid"
            ],404);
        }
    }

     /**
     * update user status.
     */
    public function status(UserStatusRequest $request,$id){
        if($id){
            $response = (new EmployeeService())->status($request,$id);
            if($response){
                return response()->json([
                    'success' => true,
                    'message' => "Employee status updated",
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Employee not valid"
                ],404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Employee not valid"
            ],404);
        }
    }

}
