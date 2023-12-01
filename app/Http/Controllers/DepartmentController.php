<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DepartmentService;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\UserStatusRequest;

class DepartmentController extends Controller
{
    /**
     * Get all department list
     */
    public function index(){
        $departments = (new DepartmentService())->index();
        if(count($departments) > 0){
            return response()->json([
                'success' => true,
                'message' => "Get departments successfully",
                'data' => $departments
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message'=>"No departments found"
            ],404);
        }
    }

     /**
     * Store a department
     */
    public function store(CompanyRequest $request){
        //validate request data
        $validated = $request->validated();
        
        if($validated){
            $data = (new DepartmentService())->store($request);
            if($data){
                return response()->json([
                    'success' => true,
                    'message' => "Department created successfully",
                    'data' => $data
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Department not created"
                ],404);
            }
        }
    }


     /**
     * Get department details
     */
    public function show($id){
        if($id){
            $department = (new DepartmentService())->show($id);
            if($department){
                return response()->json([
                    'success' => true,
                    'message' => "Get department successfully",
                    'data' => $department
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Department not valid"
                ],404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Department not valid"
            ],404);
        }
    }

    /**
     * Update a department
     */
    public function update(DepartmentRequest $request,$id){
        //validate request data
        $validated = $request->validated();
        if($validated){
            $data = (new DepartmentService())->update($request,$id);
            if($data){
                return response()->json([
                    'success' => true,
                    'message' => "Department updated successfully",
                    'data' => $data
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Department not valid"
                ],404);
            }
        }
    }

     /**
     * Delete department
     */
    public function destroy($id){
        if($id){
            $response = (new DepartmentService())->destroy($id);
            if($response){
                return response()->json([
                    'success' => true,
                    'message' => "Department deleted successfully",
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Department not valid"
                ],404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Department not valid"
            ],404);
        }
    }

     /**
     * Update department status
     */
    public function status(UserStatusRequest $request,$id){
        if($id){
            $response = (new DepartmentService())->status($request,$id);
            if($response){
                return response()->json([
                    'success' => true,
                    'message' => "Department status updated",
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Department not valid"
                ],404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Department not valid"
            ],404);
        }
    }
}
