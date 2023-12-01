<?php
namespace App\Services;

use App\Models\Department;

class DepartmentService {

     /**
     * Get all departments
     *
     * @return array
     */
    public function index(){
        $departments = Department::where('created_by',auth('sanctum')->id())->withCount('employees')->get();
        return $departments;
    }

    
    /**
     * store the request to department.
     *
     * @return array
     */
    public function store($request){
        // create department data
        $department = new Department;
        $department->created_by = auth('sanctum')->id();
        $department->department_name = $request->department_name;
        $department->manager = $request->manager;
        $department->parent_department = $request->parent_department;
        
        if($department->save()){
            return $department;
        }
    }
    
   
    /**
     * Get a  department
     *
     * @return array
     */    
    public function show($id){
        $department = Department::find($id);
        if ($department) {
            return $department;
        } else {
            return false;
        }
    }


     /**
     * update the request to department
     *
     * @return array
     */
    public function update($request,$id){
        // update department data
        $department = Department::find($id);
        if($department){
            $department->department_name = $request->department_name;
            $department->manager = $request->manager;
            $department->parent_department = $request->parent_department;
            if($department->save()){
                return $department;
            } else{
                return false;
            }
        } else{
            return false;
        }
        
    }

    /**
     * Destroy a  employee
     *
     * @return array
     */    
    public function destroy($id){
        $department = Department::find($id);
        if($department){
        $department->delete();
        return true;
        } else{
            return false;
        }
    }

     /**
     * Destroy a  employee
     *
     * @return array
     */    
    public function status($request,$id){
        $department = Department::find($id);
        if($department){
            $department->status = $request->status;
            $department->save();
            return true;
        } else{
            return false;
        }
    }
}