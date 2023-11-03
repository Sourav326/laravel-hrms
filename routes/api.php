<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    EmployeeController,
    AuthController
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route for user login
Route::controller(AuthController::class)->group(function () {
    Route::post('/login','login');
    Route::post('/forget-password-mail','forgetPasswordMail');
    Route::post('/forget-password','forgetPassword');
});

// If user login
Route::middleware('ensureUserIsLogin')->group(function () {

    // If admin login
    Route::middleware('ensureIsAdmin')->group(function () {
        // For employees
        Route::controller(EmployeeController::class)->group(function () {
            Route::get('/employees','index');
            Route::post('/employee','store');
            Route::get('/employee/{id}','show');
            Route::put('/employee/{id}','update');
            Route::delete('/employee/{id}','destroy');
        });
    });
    
    // User management
    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout','logout');
        Route::post('/change-password','changePassword');
    });

});


