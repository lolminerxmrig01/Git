<?php

namespace Modules\Staff\Auth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class StaffController extends Controller
{
    public function index()
    {
        return redirect()->route('staff.loginPage');
    }

    public function loginPage()
    {
        return view('staffauth::login');
    }

    public function dashboardPage()
    {
        return view('staffauth::dashboard');
    }

    public function forgotPage()
    {
        return view('staffauth::forgot');
    }
}
