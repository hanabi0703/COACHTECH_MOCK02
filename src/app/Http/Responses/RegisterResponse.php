<?php

namespace App\Http\Response;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $home = Auth::uer()->role == 'admin' ? '/admin/attendance/list' : '/attendance';
        Log::debug($home);
        return redirect($home);
    }
}
