<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        $home = Auth::uer()->role == 'admin' ? '/admin/attendance/list' : '/attendance';
        Log::debug('OK');
        // return redirect($home);
        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended(
                        auth()->user()->is_admin ? route('admin.dashboard') : route('dashboard')
                    );
    }
}