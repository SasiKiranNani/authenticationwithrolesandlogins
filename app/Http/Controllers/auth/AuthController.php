<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            $role = Auth()->user()->role;
            return $role == admin
                ? redirect('/admin/dashboard')
                : redirect('/user/dashboard');
        }

        return redirect()->back();
    }
}

