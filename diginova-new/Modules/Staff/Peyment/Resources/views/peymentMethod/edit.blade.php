@extends('layouts.staff.master')
@section('title') ویرایش درگاه | {{ $fa_store_name }}  @endsection
@section('head')
<script src="{{ asset('mehdi/staff/js/tableView.js') }}"></script>
<style>
  .select2-selection__arrow {
    display: block !important;
  }

  .select2-selection--single {
    background-color: #fff;
    border: 1px solid #bbbaba;
    border-radius: 4px;
  }

  [data-icon=action-visibility-eye]:before {
    padding-top: 5px !important;
    color: #4fcce9;
  }

  .c-mega-campaigns-join-list__container-table-btn--view:before {
    color: #4fcce9 !important;
  }


  .select2-selection__rendered
  {
    border-color: #e6e9ed !important;
  }


  td {
    text-align: right !important;
  }

  th {
    text-align: right !important;
  }

</style>
@endsection
@section('content')
<main class="c-main">
  <div class="uk-container uk-container-large">
    <div class="c-grid">
      <div class="c-grid__row c-product-list--align-header">
        <div class="c-grid__col">
          <div class="c-card c-card--transparent">
            <h1 class="c-card__title c-card__title--dark c-card__title--desc">
                ویرایش درگاه
              <span>
                از این صفحه می‌توانید تنظیمات درگاه پرداخت را ویرایش کنید.
            </span>
            </h1>
          </div>
        </div>
      </div>
      <div class="c-grid__row">
        <div class="c-grid__col">
          <div class="c-card">
            <h2 style="font-size: 18px; margin-right: 33px; margin-top: 28px; margin-bottom: -30px;">
              <div style="color: #606265;">ویرایش درگاه  "{{ $peyment_method->name }}"</div>
            </h2>

            <div style="width: 100%;margin: -7px 0px 50px 0px !important;padding: 0px !important;
              background: #e2dddd;height: 1px;display: none;"></div>

            <div class="c-card__header"></div>

            <div class="c-card__body">
              <div class="c-grid__row c-grid__row--gap-lg">

                  <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-12 ">
                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm">

                      <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-4 c-grid__col--xs-gap">
                        <label for="" class="uk-form-label" style="color: #606265;margin-bottom: 7px;">
                          عنوان روش:
                          <span class="uk-form-label__required"></span>
                        </label>

                        <div class="field-wrapper">
                          <label class="c-content-input">
                            <input type="text" class="c-content-input__origin c-content-input__origin" name="name"
                             value="{{ $peyment_method->name }}" dir="rtl" style="text-align: right;border-color: #e6e9ed!important;">
                          </label>
                        </div>
                      </div>

                      <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-4 c-grid__col--xs-gap">
                        <div class="field-wrapper">
                          <label class="c-ui-form__label" for="status">وضعیت:</label>
                          <select id="status" class="dropdown-control c-ui-select c-ui-select--common c-ui-select--small select2-hidden-accessible"
                                  name="status" tabindex="-1" aria-hidden="true" style="width: 150px ​!important;">
                            <option value="active" {{ ($peyment_method->status == 'active') ? 'selected' : '' }} >فعال</option>
                            <option value="inactive" {{ ($peyment_method->status == 'inactive') ? 'selected' : '' }} >غیرفعال</option>
                          </select>
                        </div>
                      </div>

                    </div>
                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm"></div>
                  </div>

                  <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-12 ">
                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm">
                      <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-8 c-grid__col--xs-gap">
                        <label for="description" class="uk-form-label" style="color: #606265;margin-bottom: 7px;">
                          توضیحات:
                          <span class="uk-form-label__required"></span>
                        </label>

                        <div class="field-wrapper">
                          <label class="c-content-input">
                            <input type="text" class="c-content-input__origin c-content-input__origin"
                             name="description" value="{{ $peyment_method->description }}" dir="rtl"
                              style="text-align: right;border-color: #e6e9ed!important;">
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm"></div>
                  </div>

                {{-- شناسه پیکربندی --}}
                @if($peyment_method->en_name == 'asanpardakht')
                  <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-12 ">
                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm">
                      <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-4 c-grid__col--xs-gap">
                        <label for="iv" class="uk-form-label" style="color: #606265;margin-bottom: 7px;">
                          شناسه پیکربندی:
                          <span class="uk-form-label__required"></span>
                        </label>

                        <div class="field-wrapper">
                          <label class="c-content-input">
                            <input type="text" class="c-content-input__origin c-content-input__origin"
                            name="iv" value="{{ $peyment_method->iv }}" dir="rtl"
                            style="text-align: right;border-color: #e6e9ed!important;">
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm"></div>
                  </div>
                @endif

                {{-- کلید تراکنش --}}
                @if($peyment_method->en_name == 'asanpardakht'
                  || $peyment_method->en_name == 'irankish'
                  || $peyment_method->en_name == 'sadad')
                  <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-12 ">
                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm">
                      <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-4 c-grid__col--xs-gap">
                        <label for="key" class="uk-form-label" style="color: #606265;margin-bottom: 7px;">
                          کلید رمزنگاری:
                          <span class="uk-form-label__required"></span>
                        </label>

                        <div class="field-wrapper">
                          <label class="c-content-input">
                            <input type="text" class="c-content-input__origin c-content-input__origin" name="key"
                             value="{{ $peyment_method->key }}" dir="rtl"
                             style="text-align: right;border-color: #e6e9ed!important;">
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm"></div>
                  </div>
                @endif

                {{-- یوزرنیم و پسورد --}}
                @if($peyment_method->en_name == 'behpardakht' || $peyment_method->en_name == 'asanpardakht')
                  <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-12 ">
                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm">
                      <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-4 c-grid__col--xs-gap">
                        <label for="username" class="uk-form-label" style="color: #606265;margin-bottom: 7px;">
                          نام کاربری:
                          <span class="uk-form-label__required"></span>
                        </label>

                        <div class="field-wrapper">
                          <label class="c-content-input">
                            <input type="text" class="c-content-input__origin c-content-input__origin"
                             name="username" value="{{ $peyment_method->username }}" dir="rtl"
                              style="text-align: right;border-color: #e6e9ed!important;">
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm"></div>
                  </div>

                  <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-12 ">
                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm">
                      <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-4 c-grid__col--xs-gap">
                        <label for="password" class="uk-form-label" style="color: #606265;margin-bottom: 7px;">
                          کلمه عبور:
                          <span class="uk-form-label__required"></span>
                        </label>

                        <div class="field-wrapper">
                          <label class="c-content-input">
                            <input type="text" class="c-content-input__origin c-content-input__origin"
                             name="password" value="{{ $peyment_method->password }}" dir="rtl"
                              style="text-align: right;border-color: #e6e9ed!important;">
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm"></div>
                  </div>
                @endif

                {{-- ترمینال آیدی --}}
                @if($peyment_method->en_name == 'behpardakht' || $peyment_method->en_name == 'sepehr')
                  <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-12 ">
                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm">
                      <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-4 c-grid__col--xs-gap">
                        <label for="terminalId" class="uk-form-label" style="color: #606265;margin-bottom: 7px;">
                          ترمینال آیدی:
                          <span class="uk-form-label__required"></span>
                        </label>

                        <div class="field-wrapper">
                          <label class="c-content-input">
                            <input type="text" class="c-content-input__origin c-content-input__origin"
                            name="terminalId" value="{{ $peyment_method->terminalId }}"
                             dir="rtl" style="text-align: right;border-color: #e6e9ed!important;">
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm"></div>
                  </div>
                @endif

                {{-- مرچنت کد --}}
                @if($peyment_method->en_name !== 'behpardakht' && $peyment_method->en_name !== 'sepehr' &&  $peyment_method->en_name !== 'cod')
                  <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-12 ">
                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm">
                      <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-4 c-grid__col--xs-gap">
                        <label for="merchantId" class="uk-form-label" style="color: #606265;margin-bottom: 7px;">
                          مرچنت کد:
                          <span class="uk-form-label__required"></span>
                        </label>

                        <div class="field-wrapper">
                          <label class="c-content-input">
                            <input type="text" class="c-content-input__origin c-content-input__origin" name="merchantId"
                             value="{{ $peyment_method->merchantId }}" dir="rtl" style="text-align: right;border-color: #e6e9ed!important;">
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm"></div>
                  </div>
                @endif

                @if($peyment_method->en_name == 'pasargad')
                  <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-12 ">
                      <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm">
                          <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-4 c-grid__col--xs-gap">
                              <label for="merchantId" class="uk-form-label" style="color: #606265;margin-bottom: 7px;">
                                  certificate:
                                  <span class="uk-form-label__required"></span>
                              </label>

                              <div class="field-wrapper">
                                  <label class="c-content-input">
                                      <input type="text" class="c-content-input__origin c-content-input__origin" name="merchantId"
                                             value="{{ $peyment_method->certificate }}" dir="rtl" style="text-align: right;border-color: #e6e9ed!important;">
                                  </label>
                              </div>
                          </div>
                      </div>

                      <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm"></div>
                  </div>
                @endif

                {{-- گزینه‌های پرداخت درب منزل --}}
                @if($peyment_method->en_name == 'cod')
                  <div class="c-grid__row " style="margin-right: 15px; margin-top: 25px !important;">
                    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--xs-gap"
                     style="padding-right: 0px !important;width: 32%;">
                      <label class="c-ui-form__label" for="product_page_title">ارزش سبد خرید:</label>
                      <div class="field-wrapper field-wrapper--justify field-wrapper--background"
                       style="border-radius: 8px;background-color: #f5f7fa;padding-left: 15px;padding-right: 15px;min-height: 40px;">
                        <label class="c-ui-checkbox c-ui-checkbox--small c-ui-checkbox--auto">
                          <input type="checkbox" class="c-ui-checkbox__origin" name="has_free_peyment" value="1">
                          <span class="c-ui-checkbox__check"></span>
                          <span class="c-ui-checkbox__label">محدودیت در روش پرداخت در سبد خرید با قیمت بالا</span>
                        </label>
                      </div>
                    </div>

                    <div class="uk-flex uk-flex-column c-grid__col--lg-4" style="">
                      <div class=" c-grid__col c-grid__col--gap-small c-grid__col--flex-initial c-grid__col--xs-gap">
                        <div class="field-wrapper">
                          <label class="c-ui-form__label" for="product_page_title">حداکثر ارزش سبد خرید:</label>
                          <label class="c-content-input" style="">
                            <input type="number" placeholder="" class=" c-mega-campaigns-join-modal__body-table-input
                             js-number-input-wrapper min_card_cost c-ui-input--disabled" value=""
                              name="min_card_cost" disabled="" style="width: 92%;">
                            <span class="c-content-input__text c-content-input__text--overlay"
                             style="left: 10px !important;right: unset !important;">ریال</span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>

{{--                  <div class="c-grid__row " style="margin-right: 15px; margin-top: 25px !important;">--}}
{{--                    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--xs-gap"--}}
{{--                    style="padding-right: 0px !important;width: 32%;">--}}
{{--                      <label class="c-ui-form__label" for="product_page_title">محدودیت:</label>--}}
{{--                      <div class="field-wrapper field-wrapper--justify field-wrapper--background"--}}
{{--                      style="border-radius: 8px;background-color: #f5f7fa;padding-left: 15px;padding-right: 15px;min-height: 40px;">--}}
{{--                        <label class="c-ui-checkbox c-ui-checkbox--small c-ui-checkbox--auto" id="productIsFakeLabel">--}}
{{--                          <input type="checkbox" class="c-ui-checkbox__origin" name="has_state_limit" value="1"--}}
{{--                           {{ count($peyment_method->states)? 'checked' : '' }}>--}}
{{--                          <span class="c-ui-checkbox__check"></span>--}}
{{--                          <span class="c-ui-checkbox__label">تعیین محدودیت برای استان و یا شهر</span>--}}
{{--                        </label>--}}
{{--                      </div>--}}
{{--                    </div>--}}
{{--                  </div>--}}

                  <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-12 c-grid__col--xs-gap method_states_div"
                   style=" {{ !count($peyment_method->states)? 'display: none' : '' }}">
                    <label for="" class="uk-form-label" style="color: #606265;margin-bottom: 7px; margin-top: 20px;">
                      استان یا شهر:
                      <span class="uk-form-label__required"></span>
                    </label>

                    <div class="field-wrapper ui-select ui-select__container ui-select__container--product"
                      style="text-align: right; border-color: #e6e9ed !important;">
                      <span class="select-counter"></span>
                      <div class="js-select-options"></div>
                    </div>

                  </div>
                @endif

                {{-- زرین گیت --}}
                @if($peyment_method->en_name == 'zarinpal')
                  <div class="c-grid__row " style="margin-right: 15px;">
                    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--xs-gap"
                      style="padding-right: 0px !important;width: 32%;">
                      <label class="c-ui-form__label" for="product_page_title">زرین گیت:</label>
                      <div class="field-wrapper field-wrapper--justify field-wrapper--background"
                        style="border-radius: 8px;background-color: #f5f7fa;padding-left: 15px;padding-right: 15px;min-height: 40px;">
                        <label class="c-ui-checkbox c-ui-checkbox--small c-ui-checkbox--auto">
                          <input type="checkbox" class="c-ui-checkbox__origin" name="zarin_gate_status"
                            {{ ($peyment_method->options == 'zarin_gate')? 'checked' : '' }}>
                          <span class="c-ui-checkbox__check"></span>
                          <span class="c-ui-checkbox__label">درگاه مستقیم (زرین گیت) فعال باشد</span>
                        </label>
                      </div>
                    </div>
                  </div>
                @endif
              </div>
            </div>

            <div class="c-grid__row c-grid__row--gap-lg" style="margin-bottom: 30px; margin-top: 30px !important;">
              <a class="c-ui-btn c-ui-btn--next mr-a save-form" style=" margin-left: 40px !important;" data-value="top">ذخیره</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div id="pageLoader" class="c-content-loader c-content-loader--fixed">
    <div class="c-content-loader__logo"></div>
    <div class="c-content-loader__spinner"></div>
  </div>
  </div>
</main>
@endsection
@section('script')
<script>

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(".save-form").on('click', function (e) {

  if ($("input[name='zarin_gate_status']").is(':checked')){ var zarin_gate_status = 'active'; } else { var zarin_gate_status = 'inactive';}

  if ($("input[name='iv']").length) { var iv = $("input[name='iv']").val(); } else { var iv = null; }
  if ($("input[name='key']").length) { var key = $("input[name='key']").val(); } else { var key = null; }
  if ($("input[name='username']").length) { var username = $("input[name='username']").val(); } else { var username = null; }
  if ($("input[name='password']").length) { var password = $("input[name='password']").val(); } else { var password = null; }
  if ($("input[name='terminalId']").length) { var terminalId = $("input[name='terminalId']").val(); } else { var terminalId = null; }
  if ($("input[name='merchantId']").length) { var merchantId = $("input[name='merchantId']").val(); } else { var merchantId = null; }
  if ($("input[name='certificate']").length) { var certificate = $("input[name='certificate']").val(); } else { var certificate = null; }

  var name = $("input[name='name']").val();
  var status = $("select[name='status']").val();
  var description = $("input[name='description']").val();

  $.ajax({
    method: "post",
    url: '{{route('staff.peyment.storePeymentMethod')}}',
    data: {
      en_name: '{{ $peyment_method->en_name }}',
      name: name,
      status: status,
      description: description,

      iv: iv,
      key: key,
      username: username,
      password: password,
      terminalId: terminalId,
      merchantId: merchantId,
      certificate: certificate,
      zarin_gate_status: zarin_gate_status,
    },

    success: function () {
        $(window).scrollTop(0);

        UIkit.notification({
          message: 'اطلاعات ذخیره شد',
          status: 'success',
          pos: 'top-left',
          timeout: 9000
        });

        window.location.href = "{{ route('staff.peyment.index') }}";
    },

    error: function (errors) {
      Promotion.displayError(errors.responseJSON.data.errors);
    }

  });

});

$(document).on('change', "input[name='has_free_peyment']", function (){
  if ($(this).is(":checked")) {
    $(".min_card_cost").removeAttr('disabled');
    $(".min_card_cost").removeClass('disabled');
    $(".min_card_cost").removeClass('c-ui-input--disabled');
  } else {
    $(".min_card_cost").attr('disabled', true);
    $(".min_card_cost").addClass('disabled');
    $(".min_card_cost").addClass('c-ui-input--disabled');
    $(".min_card_cost").val('');
  }
});

$(document).on('change', "input[name='has_state_limit']", function (){
  console.log('eeeeeeeee');
  if ($(this).is(":checked")) {
    $(".method_states_div").show();
  } else {
    $(".method_states_div").hide();
  }
});

$('.js-select-origin').each(function () {
  const $this = $(this);
  const isMultiSelect = $this.attr('multiple');
  const $placeholder = $this.attr('data-placeholder') || '';
  const inProductStep = $this.hasClass('js-in-product');

  $this.select2({
    placeholder: $placeholder,
    closeOnSelect: !isMultiSelect,
    allowClear: (isMultiSelect && inProductStep),
    sorter: function (data) {
      return data.sort(function (a, b) {
        a = $(a).prop('selected');
        b = $(b).prop('selected');
        return b - a;
      });
    }
  }).on('select2:opening', function () {
    $('body').addClass('ui-select');
  }).on('select2:select', function () {
    let $sortedOptions = $('li.select2-results__option').sort(function (a, b) {
      return ($(b).attr('aria-selected') === 'true') - ($(a).attr('aria-selected') === 'true');
    });
    $('.select2-results__options').prepend($sortedOptions);
  }).on('select2:unselect', function () {
    let $sortedOptions = $('li.select2-results__option').sort(function (a, b) {
      return ($(b).attr('aria-selected') === 'true') - ($(a).attr('aria-selected') === 'true');
    });
    $('.select2-results__options').prepend($sortedOptions);
  }).on('change', function () {
    if (isMultiSelect && inProductStep) {
      let $selectionsContainerWidth = $this.siblings('.select2-container').find('ul.select2-selection__rendered').width() - 77;
      const $selections = $this.siblings('.select2-container').find('li.select2-selection__choice');

      $selections.removeClass('hidden');
      $selections.each(function () {
        $selectionsContainerWidth -= $(this).outerWidth(true);
        if ($selectionsContainerWidth < 0) {
          $(this).addClass('hidden');
        }
      });

      let $selectionsCount = $this.siblings('.select2-container').find('li.select2-selection__choice.hidden').length;
      let $counter = $this.siblings('.select-counter');

      if ($selectionsCount > 0) {
        $counter.css('display', 'flex');
      } else {
        $counter.css('display', 'none');
      }
      $counter.text($selectionsCount.toLocaleString('fa-IR'));
    }
    $(this).trigger('blur');
  }).on('select2:close', function () {
    $(this).valid();
    $('body').removeClass('ui-select');
  });

  if (isMultiSelect && inProductStep) {
    let $selectionsContainerWidth = $this.siblings('.select2-container').find('ul.select2-selection__rendered').width() - 77;
    const $selections = $this.siblings('.select2-container').find('li.select2-selection__choice');

    $selections.removeClass('hidden');
    $selections.each(function () {
      $selectionsContainerWidth -= $(this).outerWidth(true);
      if ($selectionsContainerWidth < 0) {
        $(this).addClass('hidden');
      }
    });

    let $counter = $this.siblings('.select-counter');
    let $selectionsCount = $this.siblings('.select2-container').find('li.select2-selection__choice.hidden').length;

    if ($selectionsCount > 0) {
      $counter.text($selectionsCount.toLocaleString('fa-IR'));
      $counter.css('display', 'flex');
    }
  }

});

</script>
@endsection
