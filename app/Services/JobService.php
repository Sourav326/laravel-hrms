<?php
namespace App\Services;

use App\Models\Job;
use DateTime;

class JobService {

     /**
     * Get all posted jobs
     *
     * @return array
     */
    public function index(){
        $jobs = Job::where('company_id',auth('sanctum')->user()->company_id)->get();
        return $jobs;
    }


    /**
     * store the new job request to jobs.
     *
     * @return array
     */
    public function store($request){
        // create job data
        $job = new Job;
        $job->company_id = auth('sanctum')->user()->company_id;
        $job->user_id = auth('sanctum')->user()->id;
        $job->designation = $request->designation;
        $job->no_of_positions = $request->no_of_positions;
        $job->department = $request->department;
        $job->expected_compensation = $request->expected_compensation;
        $job->requested_by = $request->requested_by;
        $job->requested_by_department = $request->requested_by_department;
        $job->requested_by_designation = $request->requested_by_designation;
        $job->posted_on = new DateTime($request->posted_on);
        $job->expected_by = new DateTime($request->expected_by);
        $job->publish_on_website = $request->publish_on_website;
        $job->status = $request->status;
        if($job->save()){
            return $job;
        }
    }
    
   
    /**
     * Get a  job
     *
     * @return array
     */    
    public function show($id){
        $job = Job::find($id);
        if ($job) {
            return $job;
        } else {
            return false;
        }
    }


     /**
     * update the request to job
     *
     * @return array
     */
    public function update($request,$id){
        // update leave type data
        $job = Job::find($id);
        if($job){
            $job->designation = $request->designation;
            $job->no_of_positions = $request->no_of_positions;
            $job->department = $request->department;
            $job->expected_compensation = $request->expected_compensation;
            $job->requested_by = $request->requested_by;
            $job->requested_by_department = $request->requested_by_department;
            $job->requested_by_designation = $request->requested_by_designation;
            $job->expected_by = new DateTime($request->expected_by);
            $job->publish_on_website = $request->publish_on_website;
            $job->status = $request->status;
            if($job->save()){
                return $job;
            } else{
                return false;
            }
        } else{
            return false;
        }
        
    }

    /**
     * Destroy a  job
     *
     * @return array
     */    
    public function destroy($id){
        $job = Job::find($id);
        if($job){
        $job->delete();
        return true;
        } else{
            return false;
        }
    }

     /**
     * Update job status
     *
     * @return array
     */    
    public function status($request,$id){
        $job = Job::find($id);
        if($job){
            $job->status = $request->status;
            $job->save();
            return true;
        } else{
            return false;
        }
    }
}