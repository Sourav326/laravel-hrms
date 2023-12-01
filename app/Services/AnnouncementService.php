<?php
namespace App\Services;

use App\Models\Announcement;
use DateTime;

class AnnouncementService {

     /**
     * Get all posted announcements
     *
     * @return array
     */
    public function index(){
        $announcements = Announcement::where('company_id',auth('sanctum')->user()->company_id)->get();
        return $announcements;
    }


    /**
     * store the new Announcement request to announcements.
     *
     * @return array
     */
    public function store($request){
        // create announcement data
        $announcement = new Announcement;
        $announcement->company_id = auth('sanctum')->user()->company_id;
        $announcement->user_id = auth('sanctum')->user()->id;
        $announcement->comment = $request->comment;
        $announcement->is_scheduled = $request->is_scheduled;
        $announcement->status = $request->status;
        $announcement->date = $request->date;
        $announcement->time = $request->time;
        if($announcement->save()){
            return $announcement;
        }
    }
    
   
    /**
     * Get a  Announcement
     *
     * @return array
     */    
    public function show($id){
        $announcement = Announcement::find($id);
        if ($announcement) {
            return $announcement;
        } else {
            return false;
        }
    }


     /**
     * update the request to Announcement
     *
     * @return array
     */
    public function update($request,$id){
        // update announcement data
        $announcement = Announcement::find($id);
        if($announcement){
            $announcement->comment = $request->comment;
            $announcement->is_scheduled = $request->is_scheduled;
            $announcement->status = $request->status;
            $announcement->date = $request->date;
            $announcement->time = $request->time;
            if($announcement->save()){
                return $announcement;
            } else{
                return false;
            }
        } else{
            return false;
        }
        
    }

    /**
     * Destroy a  announcement
     *
     * @return array
     */    
    public function destroy($id){
        $announcement = Announcement::find($id);
        if($announcement){
        $announcement->delete();
        return true;
        } else{
            return false;
        }
    }

     /**
     * Update announcement status
     *
     * @return array
     */    
    public function status($request,$id){
        $announcement = Announcement::find($id);
        if($announcement){
            $announcement->status = $request->status;
            $announcement->save();
            return true;
        } else{
            return false;
        }
    }
}