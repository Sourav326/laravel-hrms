<?php
namespace App\Services;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Support\Carbon;

class AttendanceService {

     /**
     * Get all attendance of requested month
     *
     * @return array
     */
    public function index($request){
        $currentMonth = $request->month;
        $daysInMonth = Carbon::now()->month($currentMonth)->daysInMonth; // 28
        $attendances = Attendance::whereRaw('MONTH(attendance_date) = ?',[$currentMonth])
                        ->where('company_id',$request->company_id)
                        ->get();
        $data = [];
       
        foreach($attendances as $attendance){
            $totalWorkingDays = Attendance::whereRaw('MONTH(attendance_date) = ?',[$currentMonth])
                                    ->where('employee_id',$attendance->employee_id)
                                    ->where('company_id',$request->company_id)
                                    ->count();
            $a['employee_id'] = $attendance->employee->employee_id;
            $a['name'] = $attendance->employee->name;
            $a['job_position'] = $attendance->employee->job_position;
            $a['attendance_date'] = $attendance->attendance_date;
            $a['month_working_days'] = $daysInMonth;
            $a['holidays'] = 6;
            $a['total_leaves'] = 2;
            $a['total_working_days'] = $totalWorkingDays;
            $data[] = $a;
        }
        
        return $data;
    }

    
    /**
     * store the checkinrequest to attendance.
     *
     * @return array
     */
    public function storeCheckIn($request){
        // create attendance data
        $employee = Employee::where('employee_id',$request->employee_id)->first();
        $attendance_date = Carbon::createFromFormat('Y-m-d H:i:s', $request->date_time)->format('Y-m-d');
        
        $isAttendanceAvailable = Attendance::where('employee_id',$employee->id)->where('attendance_date',$attendance_date)->first();
       
        if($isAttendanceAvailable){
            return 0;
        } else {
            $attendance = new Attendance;
            $attendance->employee_id = $employee->id;
            $attendance->attendance_date = $attendance_date;
            $attendance->check_in = $request->date_time;
            $attendance->company_id = $employee->company_id;
            $attendance->is_checkin_checkout = '0';
            $attendance->status = 'full day';
            if($attendance->save()){
                return $attendance;
            }
        }
    }

    /**
     * store the checkout request to attendance.
     *
     * @return array
     */
    public function storeCheckOut($request){
        // create attendance data
        $employee = Employee::where('employee_id',$request->employee_id)->first();
        $attendance_date = Carbon::createFromFormat('Y-m-d H:i:s', $request->date_time)->format('Y-m-d');
        
        $isAttendanceAvailable = Attendance::where('employee_id',$employee->id)->where('attendance_date',$attendance_date)->where('is_checkin_checkout','0')->first();
       
        if($isAttendanceAvailable){
            $checkIn = Carbon::parse($isAttendanceAvailable->check_in);
            $checkOut = Carbon::parse($request->date_time);
            $mins     = $checkOut->diffInMinutes($checkIn, true);
            $workHours = date('H:i:s', mktime(0, $mins));
            $isAttendanceAvailable->check_out = $request->date_time;
            $isAttendanceAvailable->work_hours = $workHours;
            
            $hours = Carbon::parse('09:00:00')->diffInMinutes(Carbon::parse($workHours));
            $total_break_hours = date('H:i:s', mktime(0, $hours));
            $isAttendanceAvailable->total_break_hours = $total_break_hours;


            $isAttendanceAvailable->is_checkin_checkout = '1';
            if($isAttendanceAvailable->save()){
                return $isAttendanceAvailable;
            }
        } else {
            return 0;
        }

    }
    
   
    /**
     * Get today attendance
     *
     * @return array
     */    
    public function todayAttendance(){
        $company_id = auth('sanctum')->user()->company_id;
        $todayAttendance = Attendance::whereDate('created_at', Carbon::today())->where('company_id',$company_id)->get();
        if ($todayAttendance) {
            return $todayAttendance;
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