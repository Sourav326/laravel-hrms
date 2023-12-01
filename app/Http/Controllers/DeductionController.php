<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DeductionService;
use App\Http\Requests\DeductionRequest;
use App\Http\Requests\UserStatusRequest;

class DeductionController extends Controller
{
     /**
     * Get all deductions
     */
    public function index(){
        $deductions = (new DeductionService())->index();
        if(count($deductions) > 0){
            return response()->json([
                'success' => true,
                'message' => "Get deductions successfully",
                'data' => $deductions
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message'=>"No deductions found"
            ],404);
        }
    }

    /**
     * Add deduction
     */
    public function store(DeductionRequest $request){
        //validate request data
        $validated = $request->validated();
        if($validated){
            $data = (new DeductionService())->store($request);
            if($data == false){
                return response()->json([
                    'success' => false,
                    'message'=>"Deduction must be unique"
                ],404);
            } else if($data){
                return response()->json([
                    'success' => false,
                    'message'=>"Deduction  created successfully.",
                    'date' => $data
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Deduction not created."
                ],404);
            }
        }
       
    }


     /**
     * Get deduction details
     */
    public function show($id){
        if($id){
            $deduction = (new DeductionService())->show($id);
            if($deduction){
                return response()->json([
                    'success' => true,
                    'message' => "Get deduction successfully",
                    'data' => $deduction
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Deduction not valid"
                ],404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Deduction not valid"
            ],404);
        }
    }

    /**
     * Update a deduction
     */
    public function update(DeductionRequest $request,$id){
        //validate request data
        $validated = $request->validated();
        if($validated){
            $data = (new DeductionService())->update($request,$id);
            if($data){
                return response()->json([
                    'success' => true,
                    'message' => "deduction updated successfully",
                    'data' => $data
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Deduction not valid"
                ],404);
            }
        }
    }

     /**
     * Delete deduction
     */
    public function destroy($id){
        if($id){
            $response = (new DeductionService())->destroy($id);
            if($response){
                return response()->json([
                    'success' => true,
                    'message' => "Deduction deleted successfully",
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Deduction not valid"
                ],404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Deduction not valid"
            ],404);
        }
    }

     /**
     * Update deduction status
     */
    public function status(UserStatusRequest $request,$id){
        if($id){
            $response = (new DeductionService())->status($request,$id);
            if($response){
                return response()->json([
                    'success' => true,
                    'message' => "Deduction status updated",
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Deduction not valid"
                ],404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Deduction not valid"
            ],404);
        }
    }
}
