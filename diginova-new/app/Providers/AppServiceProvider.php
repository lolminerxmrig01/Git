<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Modules\Staff\Peyment\Models\PeymentMethod;
use Modules\Staff\Setting\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Modules\Staff\Shiping\Models\DeliveryMethodValue;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $settings = Setting::all();
        $paymentMethod = PeymentMethod::all();
        $deliveryMethodValue = DeliveryMethodValue::all();

        view()->share('settings', $settings);

        $this->setViewData($settings);

        if ($deliveryMethodValue->count()) {
          $this->setPostPishtazConfigs($deliveryMethodValue);
          $this->setPostSefareshiConfigs($deliveryMethodValue);
        }

        $this->setMailConfigs($settings);
        $this->setPaymentConfigs($paymentMethod, $settings);
        $this->setAppCofig($settings);
    }

    public function setAppCofig($settings) {
        $app_url = $settings->where('name', 'site_url')->first();

        env('APP_URL', $app_url);
        config()->set(['url' => $app_url]);
    }

    public function setViewData($settings)
    {
      if ($settings->count()) {
          view()->share('fa_store_name', $settings->where('name', 'fa_store_name')->first()->value);
          view()->share('site_url', $settings->where('name', 'site_url')->first()->value);
          view()->share('product_code_prefix', strtolower($settings->where('name', 'product_code_prefix')->first()->value));
          view()->share('product_title_prefix', strtolower($settings->where('name', 'product_title_prefix')->first()->value));
          view()->share('site_title', $settings->where('name', 'site_title')->first()->value);
          view()->share('site_index_status', $settings->where('name', 'site_index_status')->first()->value);

          view()->share('header_logo', ($settings->where('name', 'header_logo')->count() && $settings->where('name', 'header_logo')->first()->media()->count())? $settings->where('name', 'header_logo')->first()->media()->first() : null);
          view()->share('favicon_image', ($settings->where('name', 'favicon_image')->count() && $settings->where('name', 'favicon_image')->first()->media()->count())? $settings->where('name', 'favicon_image')->first()->media()->first() : null);
          view()->share('symbol_image', ($settings->where('name', 'symbol_image')->count() && $settings->where('name', 'symbol_image')->first()->media()->count())? $settings->where('name', 'symbol_image')->first()->media()->first() : null);
      } else {
          view()->share('fa_store_name', 'دیجی نوا');
          view()->share('site_url', 'localhost');
          view()->share('product_code_prefix', 'dnp');
          view()->share('product_title_prefix', 'مشخصات، قیمت و خرید');
          view()->share('site_title', 'دیجی نوا');
          view()->share('site_index_status', 'false');

          view()->share('header_logo', null);
          view()->share('favicon_image', null);
          view()->share('symbol_image', null);
      }
        view()->share('customer', auth()->guard('customer')->user());
    }

    public function setPostPishtazConfigs($deliveryMethodValue)
    {
      config()->set([
        'postPishtaz.maliat' => $deliveryMethodValue->where('id', 1)->first()->intra_province,
        'postPishtaz.bime' => $deliveryMethodValue->find(2)->intra_province,
        'postPishtaz.inSideKarmozd' => $deliveryMethodValue->find(3)->intra_province,
        'postPishtaz.outSideKarmozd' => $deliveryMethodValue->find(4)->intra_province,
        'postPishtaz.cod' => $deliveryMethodValue->find(5)->intra_province,
        'postPishtaz.haghsabt' => $deliveryMethodValue->find(6)->intra_province,

        'postPishtaz.pishtaz.tariff.500.insidePart' => $deliveryMethodValue->find(7)->intra_province,
        'postPishtaz.pishtaz.tariff.500.edgePart' => $deliveryMethodValue->find(7)->neighboring_provinces,
        'postPishtaz.pishtaz.tariff.500.outsidePart' => $deliveryMethodValue->find(7)->extra_province,

        'postPishtaz.pishtaz.tariff.1000.insidePart' => $deliveryMethodValue->find(8)->intra_province,
        'postPishtaz.pishtaz.tariff.1000.edgePart' => $deliveryMethodValue->find(8)->neighboring_provinces,
        'postPishtaz.pishtaz.tariff.1000.outsidePart' => $deliveryMethodValue->find(8)->extra_province,

        'postPishtaz.pishtaz.tariff.2000.insidePart' => $deliveryMethodValue->find(9)->intra_province,
        'postPishtaz.pishtaz.tariff.2000.edgePart' => $deliveryMethodValue->find(9)->neighboring_provinces,
        'postPishtaz.pishtaz.tariff.2000.outsidePart' => $deliveryMethodValue->find(9)->extra_province,

        'postPishtaz.pishtaz.tariff.3000.insidePart' => $deliveryMethodValue->find(10)->intra_province,
        'postPishtaz.pishtaz.tariff.3000.edgePart' => $deliveryMethodValue->find(10)->neighboring_provinces,
        'postPishtaz.pishtaz.tariff.3000.outsidePart' => $deliveryMethodValue->find(10)->extra_province,

        'postPishtaz.pishtaz.tariff.higher.insidePart' => $deliveryMethodValue->find(11)->intra_province,
        'postPishtaz.pishtaz.tariff.higher.edgePart' => $deliveryMethodValue->find(11)->neighboring_provinces,
        'postPishtaz.pishtaz.tariff.higher.outsidePart' => $deliveryMethodValue->find(11)->extra_province,
      ]);
    }

    public function setPostSefareshiConfigs($deliveryMethodValue)
    {
        config()->set([
          'postSefareshi.maliat' => $deliveryMethodValue->find(12)->intra_province,
          'postSefareshi.bime' => $deliveryMethodValue->find(13)->intra_province,
          'postSefareshi.inSideKarmozd' => $deliveryMethodValue->find(14)->intra_province,
          'postSefareshi.outSideKarmozd' => $deliveryMethodValue->find(15)->intra_province,
          'postSefareshi.cod' => $deliveryMethodValue->find(16)->intra_province,
          'postSefareshi.haghsabt' => $deliveryMethodValue->find(17)->intra_province,

          'postSefareshi.sefareshi.tariff.500.insidePart' => $deliveryMethodValue->find(18)->intra_province,
          'postSefareshi.sefareshi.tariff.500.edgePart' => $deliveryMethodValue->find(18)->neighboring_provinces,
          'postSefareshi.sefareshi.tariff.500.outsidePart' => $deliveryMethodValue->find(18)->extra_province,

          'postSefareshi.sefareshi.tariff.1000.insidePart' => $deliveryMethodValue->find(19)->intra_province,
          'postSefareshi.sefareshi.tariff.1000.edgePart' => $deliveryMethodValue->find(19)->neighboring_provinces,
          'postSefareshi.sefareshi.tariff.1000.outsidePart' => $deliveryMethodValue->find(19)->extra_province,

          'postSefareshi.sefareshi.tariff.2000.insidePart' => $deliveryMethodValue->find(20)->intra_province,
          'postSefareshi.sefareshi.tariff.2000.edgePart' => $deliveryMethodValue->find(20)->neighboring_provinces,
          'postSefareshi.sefareshi.tariff.2000.outsidePart' => $deliveryMethodValue->find(20)->extra_province,

          'postSefareshi.sefareshi.tariff.3000.insidePart' => $deliveryMethodValue->find(21)->intra_province,
          'postSefareshi.sefareshi.tariff.3000.edgePart' => $deliveryMethodValue->find(21)->neighboring_provinces,
          'postSefareshi.sefareshi.tariff.3000.outsidePart' => $deliveryMethodValue->find(21)->extra_province,

          'postSefareshi.sefareshi.tariff.higher.insidePart' => $deliveryMethodValue->find(22)->intra_province,
          'postSefareshi.sefareshi.tariff.higher.edgePart' => $deliveryMethodValue->find(22)->neighboring_provinces,
          'postSefareshi.sefareshi.tariff.higher.outsidePart' => $deliveryMethodValue->find(22)->extra_province,

          'kavenegar.apikey' => Setting::where('name', 'apikey')->exists()
            ? Setting::where('name', 'apikey')->first()->value
            : '',
        ]);
    }

    public function setMailConfigs($settings)
    {
      config()->set([
        'mail.mailers.smtp.host' => $settings->where('name', 'mail_server')->first()->value,
        'mail.mailers.smtp.port' => $settings->where('name', 'mail_port')->first()->value,
        'mail.mailers.smtp.username' => $settings->where('name', 'mail_username')->first()->value,
        'mail.mailers.smtp.password' => $settings->where('name', 'mail_password')->first()->value,
        'mail.mailers.smtp.address' => $settings->where('name', 'mail_address')->first()->value,
      ]);

      env('MAIL_HOST', $settings->where('name', 'mail_server')->first()->value);
      env('MAIL_PORT', $settings->where('name', 'mail_port')->first()->value);
      env('MAIL_USERNAME', $settings->where('name', 'mail_username')->first()->value);
      env('MAIL_PASSWORD', $settings->where('name', 'mail_password')->first()->value);
      env('MAIL_FROM_ADDRESS', $settings->where('name', 'mail_address')->first()->value);
    }

    public function setPaymentConfigs($paymentMethod, $settings)
    {
      if ($paymentMethod->count()) {

        $site_url = $settings->where('name', 'site_url')->first()
            ? $settings->where('name', 'site_url')->first()->value
            : env('APP_URL');

        config()->set([
          // asanpardakht
          'payment.drivers.asanpardakht.key' => $paymentMethod->where('en_name', 'asanpardakht')->first()->key,
          'payment.drivers.asanpardakht.iv' => $paymentMethod->where('en_name', 'asanpardakht')->first()->iv,
          'payment.drivers.asanpardakht.username' => $paymentMethod->where('en_name', 'asanpardakht')->first()->username,
          'payment.drivers.asanpardakht.password' => $paymentMethod->where('en_name', 'asanpardakht')->first()->password,
          'payment.drivers.asanpardakht.merchantId' => $paymentMethod->where('en_name', 'asanpardakht')->first()->merchantId,
          'payment.drivers.asanpardakht.description' => $paymentMethod->where('en_name', 'asanpardakht')->first()->description,
          'payment.drivers.asanpardakht.callbackUrl' => $site_url . '/payment-order',

          // behpardakht
          'payment.drivers.behpardakht.terminalId' => $paymentMethod->where('en_name', 'behpardakht')->first()->terminalId,
          'payment.drivers.behpardakht.username' => $paymentMethod->where('en_name', 'behpardakht')->first()->username,
          'payment.drivers.behpardakht.password' => $paymentMethod->where('en_name', 'behpardakht')->first()->password,
          'payment.drivers.behpardakht.description' => $paymentMethod->where('en_name', 'behpardakht')->first()->description,
          'payment.drivers.behpardakht.callbackUrl' => $site_url . '/payment-order',

          // idpay
          'payment.drivers.idpay.merchantId' => $paymentMethod->where('en_name', 'idpay')->first()->merchantId,
          'payment.drivers.idpay.description' => $paymentMethod->where('en_name', 'idpay')->first()->description,
          'payment.drivers.idpay.callbackUrl' => $site_url . '/payment-order',

          // irankish
          'payment.drivers.irankish.merchantId' => $paymentMethod->where('en_name', 'irankish')->first()->merchantId,
          'payment.drivers.irankish.sha1Key' => $paymentMethod->where('en_name', 'irankish')->first()->key,
          'payment.drivers.irankish.description' => $paymentMethod->where('en_name', 'irankish')->first()->description,
          'payment.drivers.irankish.callbackUrl' => $site_url . '/payment-order',

          // nextpay
          'payment.drivers.nextpay.merchantId' => $paymentMethod->where('en_name', 'nextpay')->first()->merchantId,
          'payment.drivers.nextpay.description' => $paymentMethod->where('en_name', 'nextpay')->first()->description,
          'payment.drivers.nextpay.callbackUrl' => $site_url . '/payment-order',

          // parsian
          'payment.drivers.parsian.merchantId' => $paymentMethod->where('en_name', 'parsian')->first()->merchantId,
          'payment.drivers.parsian.description' => $paymentMethod->where('en_name', 'parsian')->first()->description,
          'payment.drivers.parsian.callbackUrl' => $site_url . '/payment-order',

          // pasargad
          'payment.drivers.pasargad.merchantId' => $paymentMethod->where('en_name', 'pasargad')->first()->merchantId,
          'payment.drivers.pasargad.terminalCode' => $paymentMethod->where('en_name', 'pasargad')->first()->terminalId,
          'payment.drivers.pasargad.callbackUrl' => $site_url . '/payment-order',

          // payir
          'payment.drivers.payir.merchantId' => $paymentMethod->where('en_name', 'payir')->first()->merchantId,
          'payment.drivers.payir.description' => $paymentMethod->where('en_name', 'payir')->first()->description,
          'payment.drivers.payir.callbackUrl' => $site_url . '/payment-order',

          // payping
          'payment.drivers.payping.merchantId' => $paymentMethod->where('en_name', 'payping')->first()->merchantId,
          'payment.drivers.payping.description' => $paymentMethod->where('en_name', 'payping')->first()->description,
          'payment.drivers.payping.callbackUrl' => $site_url . '/payment-order',

          // paystar
          'payment.drivers.paystar.merchantId' => $paymentMethod->where('en_name', 'paystar')->first()->merchantId,
          'payment.drivers.paystar.description' => $paymentMethod->where('en_name', 'paystar')->first()->description,
          'payment.drivers.paystar.callbackUrl' => $site_url . '/payment-order',

          // poolam
          'payment.drivers.poolam.merchantId' => $paymentMethod->where('en_name', 'poolam')->first()->merchantId,
          'payment.drivers.poolam.description' => $paymentMethod->where('en_name', 'poolam')->first()->description,
          'payment.drivers.poolam.callbackUrl' => $site_url . '/payment-order',

          // sadad
          'payment.drivers.sadad.terminalId' => $paymentMethod->where('en_name', 'sadad')->first()->terminalId,
          'payment.drivers.sadad.merchantId' => $paymentMethod->where('en_name', 'sadad')->first()->merchantId,
          'payment.drivers.sadad.key' => $paymentMethod->where('en_name', 'sadad')->first()->key,
          'payment.drivers.sadad.description' => $paymentMethod->where('en_name', 'sadad')->first()->description,
          'payment.drivers.sadad.callbackUrl' => $site_url . '/payment-order',

          // saman
          'payment.drivers.saman.merchantId' => $paymentMethod->where('en_name', 'saman')->first()->merchantId,
          'payment.drivers.saman.description' => $paymentMethod->where('en_name', 'saman')->first()->description,
          'payment.drivers.saman.callbackUrl' => $site_url . '/payment-order',

          // sepehr
          'payment.drivers.sepehr.terminalId' => $paymentMethod->where('en_name', 'sepehr')->first()->terminalId,
          'payment.drivers.sepehr.description' => $paymentMethod->where('en_name', 'sepehr')->first()->description,
          'payment.drivers.sepehr.callbackUrl' => $site_url . '/payment-order',

          // yekpay
          'payment.drivers.yekpay.merchantId' => $paymentMethod->where('en_name', 'yekpay')->first()->merchantId,
          'payment.drivers.yekpay.description' => $paymentMethod->where('en_name', 'yekpay')->first()->description,
          'payment.drivers.yekpay.callbackUrl' => $site_url . '/payment-order',

          // zarinpal
          'payment.drivers.zarinpal.mode' => ($paymentMethod->where('en_name', 'zarinpal')->first()->options == 'zarin_gate')? 'zaringate' : 'normal',
//          'payment.drivers.zarinpal.merchantId' => $paymentMethod->where('en_name', 'zarinpal')->first()->merchantId,
          'payment.drivers.zarinpal.description' => $paymentMethod->where('en_name', 'zarinpal')->first()->description,
          'payment.drivers.zarinpal.callbackUrl' => $site_url . '/payment-order',

          // zibal
//          'payment.drivers.zibal.merchantId' => $paymentMethod->where('en_name', 'zibal')->first()->merchantId,
          'payment.drivers.zibal.description' => $paymentMethod->where('en_name', 'zibal')->first()->description,
          'payment.drivers.zibal.callbackUrl' => $site_url . '/payment-order',
        ]);
      }
    }
}
