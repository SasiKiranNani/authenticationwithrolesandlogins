<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\JsonResponse;

class CustomLoginResponse implements LoginResponseContract
{
    /**
     * Create a response after a successful login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        // Redirect based on the user type or role
        $redirectTo = $request->user()->hasRole('admin') 
            ? '/admin/dashboard' 
            : '/user/dashboard';
        
        // Handle AJAX requests
        if ($request->wantsJson()) {
            return new JsonResponse(['redirect' => $redirectTo], 200);
        }

        return redirect()->intended($redirectTo);
    }
}
