<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmployeeService;
use App\Services\DepartmentService;
use App\Services\AnnouncementService;

class DashboardController extends Controller
{
    /**
     * Get all dashboard data
     */
    public function index(Request $request){
        $totalEmployees = (new EmployeeService())->index($request);
        $totalDepartments = (new DepartmentService())->index();
        $attendance = [
            'checked_in' => 1,
            'not_checked_in' => 0,
            'on_leave' => 0,
            'holiday' => 0,
            'checked_out' => 0,
        ];
        $announcements = (new AnnouncementService())->index();
        $birthdays = (new EmployeeService())->birthdays();
        $data = [
            'totalEmployees' => count($totalEmployees),
            'totalDepartments' => count($totalDepartments),
            'attendance' => $attendance,
            'announcements' => $announcements,
            'birthdays' => $birthdays,
        ];
       
            return response()->json([
                'success' => true,
                'message' => "Get dashboard data successfully",
                'data' => $data
            ],200);
    }
}
