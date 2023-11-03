<?php
namespace App\Services;

use App\Models\User;
use App\Models\Otp;
use Illuminate\Support\Facades\Hash;

class AuthService {
    /**
     * change password of user.
     *
     * @return boolean
     */
    public function changePassword($request){
        if(Hash::check($request->current_password, auth('sanctum')->user()->password)){
            $user = User::find(auth('sanctum')->id());
            $user->password  = bcrypt($request->new_password);
            if($user->save()){
                return true;
            }
        } else {
            return false;
        }
    }

     /**
     * send mail with otp for forget password of user
     *
     * @return boolean
     */
    public function forgetPasswordMail($request){
        $user = User::where('email',$request->email)->first();
        if($user){
            //generate otp
            $generatedOtp = rand (100000,999999);
            $otp = Otp::updateOrCreate(
                ['user_id' =>  $user->id],
                ['otp' => $generatedOtp]
            );
            if($otp){
                //send email to the user
                return true;
            }
        }
    }

     /**
     * Forget password of user
     *
     * @return boolean
     */
    public function forgetPassword($request){
        $user = User::where('email',$request->email)->first();
        if($user){
            $otp = Otp::where(['user_id'=>$user->id,'otp'=>$request->otp])->first();
            if($otp){
                $user->password  = bcrypt($request->new_password);
                if($user->save()){
                    $otp->delete();
                    return true;
                }
            } else {
                return 2;
            }
        } else {
            return false;
        }
        
    }
}