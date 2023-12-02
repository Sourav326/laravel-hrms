<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    EmployeeController,
    AuthController,
    DepartmentController,
    AttendanceController,
    CompanyController,
    LeaveController,
    LeaveTypeController,
    JobController,
    AnnouncementController,
    OrganizationDocumentController,
    DeductionController,
    DashboardController
};



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/




// Route for user login
Route::controller(AuthController::class)->group(function () {
    Route::post('/login','login');
    Route::post('/forget-password-mail','forgetPasswordMail');
    Route::post('/forget-password','forgetPassword');
});

// If user login
Route::middleware('ensureUserIsLogin')->group(function () {
    

    //Organization Documents
    Route::controller(OrganizationDocumentController::class)->group(function () {
        Route::post('/organization-documents','store');
        Route::get('/organization-documents/{id}','show');
        Route::put('/organization-documents/{id}','update');
        Route::delete('/organization-documents/{id}','destroy');
        Route::get('/organization-documents/organization/{company_id}','index');//organization all documents
        Route::get('/organization-documents/employee/{company_id}','employeeDocument');//all employees documents
        
        Route::post('/organization-documents/status/{id}','status');
    });



    // If admin login
    Route::middleware('ensureIsAdmin')->group(function () {


        // For dashboard
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/dashboard','index');
        });


        // For employees
        Route::controller(EmployeeController::class)->group(function () {
            Route::get('/employees','index');
            Route::post('/employee','store');
            Route::get('/employee/{id}','show');
            Route::put('/employee/{id}','update');
            Route::delete('/employee/{id}','destroy');
            Route::post('/employee/status/{id}','status');
        });
        
        // For departments
        Route::controller(DepartmentController::class)->group(function () {
            Route::get('/departments','index');
            Route::post('/department','store');
            Route::get('/department/{id}','show');
            Route::put('/department/{id}','update');
            Route::delete('/department/{id}','destroy');
            Route::post('/department/status/{id}','status');
        });
        
        // For attendance
        Route::controller(AttendanceController::class)->group(function () {
            Route::get('/attendances','index');
            Route::get('/today-attendance','todayAttendance');
            
        });

        //Leave types
        Route::controller(LeaveTypeController::class)->group(function () {
            Route::get('/leave-types','index');
            Route::post('/leave-type','store');
            Route::get('/leave-type/{id}','show');
            Route::put('/leave-type/{id}','update');
            Route::delete('/leave-type/{id}','destroy');
            Route::post('/leave-type/status/{id}','status');
        });


        //Deductions
        Route::controller(DeductionController::class)->group(function () {
            Route::get('/deductions','index');
            Route::post('/deductions','store');
            Route::get('/deductions/{id}','show');
            Route::put('/deductions/{id}','update');
            Route::delete('/deductions/{id}','destroy');
            Route::post('/deductions/status/{id}','status');
        });


        //Job
        Route::controller(JobController::class)->group(function () {
            Route::get('/jobs','index');
            Route::post('/jobs','store');
            Route::get('/jobs/{id}','show');
            Route::put('/jobs/{id}','update');
            Route::delete('/jobs/{id}','destroy');
            Route::post('/jobs/status/{id}','status');
        });

        

        //Announcements
        Route::controller(AnnouncementController::class)->group(function () {
            Route::get('/announcements','index');
            Route::post('/announcements','store');
            Route::get('/announcements/{id}','show');
            Route::put('/announcements/{id}','update');
            Route::delete('/announcements/{id}','destroy');
            Route::post('/announcements/status/{id}','status');
        });

        //Leave management
        Route::controller(LeaveController::class)->group(function () {
            Route::get('/new-leave-requests','newLeaveRequests');
        });
    });
    
    // If super admin login
    Route::middleware('ensureIsSuperadnmin')->group(function () {

        // For company
        Route::controller(CompanyController::class)->group(function () {
            Route::get('/companies','index');
            Route::post('/company','store');
            Route::get('/company/{id}','show');
            Route::put('/company/{id}','update');
            Route::delete('/company/{id}','destroy');
            Route::post('/company/status/{id}','status');
        });

    });


    // If user login
    Route::middleware('ensureIsUser')->group(function () {
        // User management
        Route::controller(AuthController::class)->group(function () {
            Route::post('/logout','logout');
            Route::post('/change-password','changePassword');
        });

        // user Leave management
        Route::controller(LeaveController::class)->group(function () {
            Route::post('/apply-leave','applyLeave');
        });
        
    });
    
});


// For attendance
Route::controller(AttendanceController::class)->group(function () {
    Route::post('/attendance/check-in','storeCheckIn');
    Route::post('/attendance/check-out','storeCheckOut');
    
});

