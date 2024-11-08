<!DOCTYPE html>
<html dir="rtl">

@include('layouts.customer.head', ['layout' => 'front'])

<?php $banner1 = \Modules\Staff\Slider\Models\Slider::find(1) ?>

<body class="t-index {{ $banner1 && $banner1->status  == 'active' && $banner1->images()->exists() ? 'has-top-banner' : '' }}">

    @include('layouts.customer.header')

    @yield('content')

    @yield('source')

    @include('layouts.customer.footer')

</body>

</html>
