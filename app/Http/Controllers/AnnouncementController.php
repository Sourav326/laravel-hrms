<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AnnouncementRequest;
use App\Http\Requests\UserStatusRequest;
use App\Services\AnnouncementService;

class AnnouncementController extends Controller
{
     /**
     * Get all announcements list
     */
    public function index(){
        $jobs = (new AnnouncementService())->index();
        if(count($jobs) > 0){
            return response()->json([
                'success' => true,
                'message' => "Get announcements successfully",
                'data' => $jobs
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message'=>"No announcements found"
            ],404);
        }
    }

    /**
     * store the announcement request in announcements
     */
    public function store(AnnouncementRequest $request){
        //validate request data
        $validated = $request->validated();
        if($validated){
            $data = (new AnnouncementService())->store($request);
            if($data){
                return response()->json([
                    'success' => false,
                    'message'=>"Announcement Added successfully.",
                    'date' => $data
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Announcement Not Added."
                ],404);
            }
        }
    }

     /**
     * Get announcement details
     */
    public function show($id){
        if($id){
            $job = (new AnnouncementService())->show($id);
            if($job){
                return response()->json([
                    'success' => true,
                    'message' => "Get announcement successfully",
                    'data' => $job
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Announcement not valid"
                ],404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Announcement not valid"
            ],404);
        }
    }

    /**
     * Update a announcement
     */
    public function update(AnnouncementRequest $request,$id){
        //validate request data
        $validated = $request->validated();
        if($validated){
            $data = (new AnnouncementService())->update($request,$id);
            if($data){
                return response()->json([
                    'success' => true,
                    'message' => "Announcement updated successfully",
                    'data' => $data
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Announcement not valid"
                ],404);
            }
        }
    }

     /**
     * Delete announcement
     */
    public function destroy($id){
        if($id){
            $response = (new AnnouncementService())->destroy($id);
            if($response){
                return response()->json([
                    'success' => true,
                    'message' => "Announcement deleted successfully",
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Announcement not valid"
                ],404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Announcement not valid"
            ],404);
        }
    }

     /**
     * Update announcement status
     */
    public function status(UserStatusRequest $request,$id){
        if($id){
            $response = (new AnnouncementService())->status($request,$id);
            if($response){
                return response()->json([
                    'success' => true,
                    'message' => "Announcement status updated",
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Announcement not valid"
                ],404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Announcement not valid"
            ],404);
        }
    }
}
