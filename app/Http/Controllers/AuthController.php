<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ForgetPasswordEmailRequest;
use App\Http\Requests\ForgetPasswordRequest;
use App\Services\AuthService;

class AuthController extends Controller
{

     /**
     * For login the user.
     */
    public function login(LoginRequest $request){
         //validate request data
         $validated = $request->validated();
         if($validated){
             if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                 $user = Auth::user();
                 $user['token'] = $user->createToken('MyApp')->plainTextToken;
                 return response()->json([
                     'success' => true,
                     'message' => "Login successfully",
                     'data' => $user
                 ],200);
             } else {
                 return response()->json([
                     'success' => false,
                     'message'=>"Email or password not valid"
                 ],404);
             }
         } else {
            return response()->json([
                'success' => false,
                'message'=>"Something went wrong, during login"
            ],404);
        }

    }

    /**
     * For logout the user.
     */
    public function logout(Request $request){
        $user = auth('sanctum')->user();
        if($user->tokens()->delete()){
            return response()->json([
                'success' => true,
                'message' => "Logout successfully",
                'data' => $user
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message'=>"Something went wrong, during logout"
            ],404);
        }
    }

    /**
     * For change password of user.
     */
    public function changePassword(ChangePasswordRequest $request){
        $validated = $request->validated();
        if($validated){
            $response = (new AuthService())->changePassword($request);
            if($response){
                return response()->json([
                    'success' => true,
                    'message' => "Password changed successfully",
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"current password not valid"
                ],404);
            }
        }
        
    }

    //send forget password mail with otp
    public function forgetPasswordMail(ForgetPasswordEmailRequest $request){
        $validated = $request->validated();
        if($validated){
            $response = (new AuthService())->forgetPasswordMail($request);
            if($response){
                return response()->json([
                    'success' => true,
                    'message' => "Mail send successfully",
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Some issue in sending mail"
                ],404);
            }
        }
    }

    /**
     * Forget password of user.
     */
    public function forgetPassword(ForgetPasswordRequest $request){
        $validated = $request->validated();
        if($validated){
            $response = (new AuthService())->forgetPassword($request);
            if($response){
                $message = match ($response) {
                    false => 'User not available',
                    true => 'Password updated successfully',
                    2 => 'Wrong Otp',
                };
                return response()->json([
                    'success' => true,
                    'message' => $message,
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message'=>"Some issue in password updation"
                ],404);
            }
        } 
    }
}
