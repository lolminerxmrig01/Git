<?php

namespace Modules\Staff\Auth\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;


class StaffLoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('staff')->check()) {
            $request->session()->regenerate('');
            return redirect()->route('staff.dashboardPage');
        }

        return back()->withErrors([
            'email' => 'خطا',
        ]);
    }
}
