<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class FacebookController extends Controller
{
    public function facebookpage(){
        return Socialite::driver("facebook")->redirect();
    }

    public function facebookcallback(){
        try {
            $user = Socialite::driver("facebook")->user();

            $finduser = User::where("facebook_id", $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect("/user/dashboard");
            }else{
                $newUser = User::create([
                    "name" => $user->name,
                    "email" => $user->email,
                    "facebook_id" => $user->id,
                    "password" => encrypt("123456dummy"),
                    'role' => 'user',
                ]);
                Auth::login($newUser);
                return redirect()->intended("user/dashboard");
            }

        } catch (Exception $e) {
            return redirect('login')->with('error', $e->getMessage());
        }
    }
}
