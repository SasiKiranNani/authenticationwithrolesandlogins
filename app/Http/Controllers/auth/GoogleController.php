<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleController extends Controller
{
    public function googlepage()
    {
        return Socialite::driver("google")->redirect();
    }

    public function googlecallback()
    {
        try {
            $user = Socialite::driver("google")->user();
            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/user/dashboard');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('123456dummy'),
                    'role' => 'user',
                ]);
                Auth::login($newUser);
                return redirect()->intended('user-dashboard');
            }
        } 
        catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
