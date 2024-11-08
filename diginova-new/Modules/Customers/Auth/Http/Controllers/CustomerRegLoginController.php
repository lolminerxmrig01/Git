<?php

namespace Modules\Customers\Auth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\Customers\Auth\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\VerifyAccount;

class CustomerRegLoginController extends Controller
{
    public function regLoginPage(Request $request)
    {
        session()->put('previous_url_page', session()->previousUrl());
        session()->forget('has_password');
        session()->forget('c_mobile');

        return view('customerauth::login-register');
    }

    public function check(Request $request)
    {
        if (session('c_mobile'))
            $request->email_phone = session('c_mobile');

        if(is_numeric($request->email_phone))
        {
            $request->email_phone = ltrim($request->email_phone, 0);

            $mobile_validator = Validator::make($request->all(), [
                'email_phone' => 'required|unique:customers,mobile',
            ]);

            if ($mobile_validator->fails('unique')) {
                if(Customer::where('mobile', $request->email_phone)->first()->password !== null)
                {
                    if ($request->loginWithSms){
                        session()->put('has_password', 'true');
                        session()->put('c_mobile', $request->email_phone);

                        VerifyAccount::updateOrCreate(['mobile' => $request->email_phone],[
                            'account_type' => 'customer',
                            'token' => rand(10000, 99999),
                        ]);

                        $token = VerifyAccount::where('mobile', $request->email_phone)->first()->token;

                        Log::info('کد فعالسازی:' . $token);
                        
                        session()->put('verify_code', 'true');
                        return redirect()->route('customer.confirmPage');
                    }
                    Log::info('این شماره پسورد داره');
                    session()->put('c_mobile', $request->email_phone);
                    session()->forget('c_email');
                    session()->put('verify_code');
                    return redirect()->route('customer.confirmPage');
                }
                else
                {
                    Log::info('این شماره پسورد نداره');
                    session()->put('c_mobile', $request->email_phone);
                    VerifyAccount::updateOrCreate(['mobile' => $request->email_phone],
                        ['account_type' => 'customer',
                            'token' => rand(10000, 99999),
                        ]);

                    $token = VerifyAccount::where('mobile', $request->email_phone)->first()->token;
                    Log::info('شماره موبایل:' . $request->email_phone);
                    Log::info('کد فعالسازی:' . $token);
                    session()->put('verify_code', 'true');
                    return redirect()->route('customer.confirmPage');
                }
            }
            else
            {
                Log::info('این شماره قبلا ثبت نام نکرده');

                VerifyAccount::updateOrCreate(['mobile' => $request->email_phone],
                ['account_type' => 'customer',
                    'token' => rand(10000, 99999),
                ]);

                $token = VerifyAccount::where('mobile', $request->email_phone)->first()->token;
                Log::info('شماره موبایل:' . $request->email_phone);
                Log::info('کد فعالسازی:' . $token);
                session()->put('verify_code', true);
                session()->put('c_mobile', $request->email_phone);
                session()->forget('c_email');
                session()->put('newUser', 'true');
                return redirect()->route('customer.confirmPage');
            }
        }
        else
        {
            Log::info('ایمیل وارد شده');
            $email_validator = Validator::make($request->all(), [
                'email_phone' => 'required|email|unique:customers,email',
            ]);

            if ($email_validator->fails('unique'))
            {
                Log::info('ایمیل قبلا ثبت نام کرده');
                session()->forget('c_mobile');
                session()->put('c_email', $request->email_phone);
                return redirect()->route('customer.confirmPage');
            }
            else
            {
                Log::info('ایمیل قبلا ثبت نام نکرده');
                return view('customerauth::login-register')
                    ->withErrors(['email_validator' => 'حساب کاربری برای این ایمیل وجود ندارد. برای ایجاد حساب کاربری
                     جدید لطفا شماره تماس خود را وارد نمایید.']);
            }
        }
    }

    public function confirmPage()
    {
        if (session('verify_code') !== null)
        {
            session()->forget('verify_code');
            return view('customerauth::confirm-sms');
        }

        return view('customerauth::confirm');
    }

    public function confirm(Request $request)
    {
        $credentials['password'] = $request->password;
        if(session('c_mobile') !== null){
            $credentials['mobile'] = session('c_mobile');
        } elseif (session('c_email') !== null) {
            $credentials['email'] = session('c_email');
        }
        if (Auth::guard('customer')->attempt($credentials)) {
            session()->forget('c_mobile');
            session()->forget('c_email');
            $request->session()->regenerate();

          return redirect()->route('front.indexPage');
        }
        
        return back()->withErrors([
            'wrongEmailPass' => 'اطلاعات کاربری نادرست است',
        ]);
    }

    public function confirmSms(Request $request)
    {
        $customer_mobile = session('c_mobile');
        $customerVerify = VerifyAccount::where('mobile', $customer_mobile)->first();
        $customer = Customer::where('mobile', $customer_mobile)->select('id')->first();

        if ($customerVerify && ($customerVerify->token ==  $request->code)){
            Customer::updateOrCreate(['mobile' => $customer_mobile]);
            $customer = Customer::where('mobile', $customer_mobile)->select('id')->first();
            Auth::guard('customer')->loginUsingId($customer->id, true);
            if (session('newUser')){
              return redirect()->route('customer.welcomme');
            }
            else{
              return redirect()->route('front.indexPage');
            }
        }

        return view('customerauth::confirm-sms')
        ->withErrors(['wrongSmsCode' => 'کد وارد شده اشتباه است']);
    }

    public function forgotPage()
    {
        return view('customerauth::forgot-password');
    }

    public function forgot(Request $request)
    {
        return view('customerauth::forgot-sent');
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('front.indexPage');
    }

    public function welcome()
    {
        return view('customerauth::welcome');
    }
}
