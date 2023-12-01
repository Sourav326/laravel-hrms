<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\JobRequest;
use App\Http\Requests\UserStatusRequest;
use App\Services\JobService;

class JobController extends Controller
{
     /**
     * Get all jobs list
     */
    public function index(){
        $jobs = (new JobService())->index();
        if(count($jobs) > 0){
            return response()->json([
                'success' => true,
                'message' => "Get jobs successfully",
                'data' => $jobs
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message'=>"No jobs found"
            ],404);
        }
    }

    /**
     * store the job request in jobs
     */
    public function store(JobRequest $request){
        //validate request data
        $validated = $request->validated();
        if($validated){
            $data = (new JobService())->store($request);
            if($data){
                return response()->json([
                    'success' => false,
                    'message'=>"Job Added successfully.",
                    'date' => $data
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Job Not Added."
                ],404);
            }
        }
    }

     /**
     * Get job details
     */
    public function show($id){
        if($id){
            $job = (new JobService())->show($id);
            if($job){
                return response()->json([
                    'success' => true,
                    'message' => "Get job successfully",
                    'data' => $job
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Job not valid"
                ],404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Job not valid"
            ],404);
        }
    }

    /**
     * Update a job
     */
    public function update(JobRequest $request,$id){
        //validate request data
        $validated = $request->validated();
        if($validated){
            $data = (new JobService())->update($request,$id);
            if($data){
                return response()->json([
                    'success' => true,
                    'message' => "Job updated successfully",
                    'data' => $data
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Job not valid"
                ],404);
            }
        }
    }

     /**
     * Delete job
     */
    public function destroy($id){
        if($id){
            $response = (new JobService())->destroy($id);
            if($response){
                return response()->json([
                    'success' => true,
                    'message' => "Job deleted successfully",
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Job not valid"
                ],404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Job not valid"
            ],404);
        }
    }

     /**
     * Update job status
     */
    public function status(UserStatusRequest $request,$id){
        if($id){
            $response = (new JobService())->status($request,$id);
            if($response){
                return response()->json([
                    'success' => true,
                    'message' => "Job status updated",
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Job not valid"
                ],404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Job not valid"
            ],404);
        }
    }
}
