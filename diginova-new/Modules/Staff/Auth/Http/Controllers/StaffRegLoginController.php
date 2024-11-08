<?php

namespace Modules\Staff\Auth\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Staff\Auth\Models\Staff;
use Modules\Staff\Order\Models\ConsignmentHasProductVariants;
use Modules\Staff\Order\Models\Order;
use Modules\Staff\Peyment\Models\PeymentMethod;
use Modules\Staff\Product\Models\Product;
use Modules\Staff\Product\Models\ProductHasVariant;
use Modules\Staff\Setting\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Media;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class StaffRegLoginController extends Controller
{
    public function indexPage()
    {
      if (Auth::guard('staff')->check()) {
        return redirect()->route('staff.dashboardPage');
      }
      return redirect()->route('staff.loginPage');
    }

    public function loginPage()
    {
      if (Auth::guard('staff')->check()) {
        return redirect()->route('staff.dashboardPage');
      }
      return view('staffauth::login');
    }

    public function dashboardPage()
    {
        $peyment_methods = PeymentMethod::all();
        $settings = Setting::all();
        $products = Product::all();
        $consignments = ConsignmentHasProductVariants::all();

        $send_today_only = Order::whereHas('consignments', function (Builder $query){
          $query->where('delivery_at','<=' , Carbon::today());
        })->count();

        $send_tomorrow_only = Order::whereHas('consignments', function (Builder $query){
          $query->where('delivery_at','>' , Carbon::today());
        })->count();

        $delivery_order_delay = Order::whereHas('consignments', function (Builder $query){
          $query->whereDate('delivery_at','<' , Carbon::today());
        })->where('order_status_id', '!=', 1)->where('order_status_id', '!=', 7)->count();

        return view('staffauth::dashboard',
          compact('peyment_methods', 'settings', 'products', 'consignments',
           'send_tomorrow_only', 'send_today_only', 'delivery_order_delay'));
    }

    /**
     * login staff
     */
    public function confirm(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $remember = filled($request->remember) ?: false;

        if (Auth::guard('staff')->attempt($credentials, $remember)) {
//            $this->deleteUnusedMedia();
            $request->session()->regenerate();
            return redirect()->route('staff.dashboardPage');
          }

        return back()->withErrors([
            'wrongEmailPass' => 'نام کاربری یا رمز عبور اشتباه است لطفا دوباره تلاش نمایید',
        ]);
    }

    public function deleteUnusedMedia()
    {
        $unusedMedia = Media::where('status', null)
            ->where('created_at', '<', Carbon::now()
              ->subHours(1)
              ->toDateTimeString()
            )
            ->get();


        foreach ($unusedMedia as $media)
        {
          $imagePath = public_path($media->path . "/" . $media->name);
          if (file_exists($imagePath)) {
              unlink($imagePath);
          }
          $media->delete();
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('staff')->logout();

        return redirect()->route('staff.indexPage');
    }

    public function forgotPage(Request $request)
    {
      return view('staffauth::forgot');
    }

    public function forgot(Request $request)
    {

          $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:staff',
          ]);

          if ($validator->fails()) {
            return back()->withErrors([
                'wrongEmailPass' => 'کاربری با این ایمیل ثبت نام نکرده است',
            ]);
          }

          $token = Str::random(64);

          Staff::where('email', $request->email)->update([
            'remember_token' => $token,
            'created_at' => Carbon::now(),
          ]);

          if (Setting::where('name', 'fa_store_name')->exists()){
            $fa_store_name = Setting::where('name', 'fa_store_name')->first()->value;
          } else {
            $fa_store_name = 'دیجی نوا';
          }

          $email = $request->email;

          Mail::send('staffauth::verify', compact('token', 'fa_store_name', 'email'), function($message)
           use($request, $fa_store_name){
            $message->to($request->email);
            $message->subject('فراموشی رمز عبور' . ' ' . $fa_store_name);
          });

          return redirect()->route('staff.succcessfulSent');

    }

    public function succcessfulSent()
    {
      return view('staffauth::successful-sent');
    }

    public function resetPassword($token = null)
    {
      if ($token !== '' && !is_null($token) && Staff::where('remember_token', $token)->count()){
        $email = Staff::where('remember_token', $token)->first()->email;
      } else {
        return view('staffauth::token-failed');
      }
      return view('staffauth::reset', compact('email', 'token'));
    }

    public function updatePassword(Request $request)
    {

      $validator = Validator::make($request->all(), [
        'password' => 'required|min:6|confirmed',
        'password_confirmation' => 'required',
      ]);

      if ($validator->fails()) {
        return back()->withErrors([
          'wrongEmailPass' => 'کاربری با این ایمیل ثبت نام نکرده است',
        ]);
      }

      if ($request->rc !== '' && !is_null($request->rc) && Staff::where('remember_token', $request->rc)->exists() && $request->password == $request->password_confirmation)
      {
        Staff::where('remember_token', $request->rc)->update([
          'password' => Hash::make($request->password),
          'remember_token' => null,
        ]);
      }

      return redirect()->route('staff.loginPage');
    }

    public function changePassword()
    {
      return view('staffauth::change-password');
    }

    public function changeOldPassword(Request $request)
    {
        if(! Hash::check($request->changepassword['password_old'], Auth::guard('staff')->user()->password)) {
          return view('staffauth::change-password', ['status' => -1]);
        }

        Auth::guard('staff')->user()->update([
          'password' => Hash::make($request->changepassword['password']),
        ]);

        return view('staffauth::change-password', ['status' => 1]);
    }
}
