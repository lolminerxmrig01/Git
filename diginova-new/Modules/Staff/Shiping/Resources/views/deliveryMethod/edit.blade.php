@extends('layouts.staff.master')
@section('title') ویرایش روش  ارسال | {{ $fa_store_name }}  @endsection
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
              ویرایش روش ارسال
              <span>
                از این صفحه می‌توانید روش ارسال را مدیریت کنید.
            </span>
            </h1>
          </div>
        </div>
      </div>
      <div class="c-grid__row">
        <div class="c-grid__col">
          <div class="c-card">
            <h2 style="font-size: 18px; margin-right: 33px; margin-top: 28px; margin-bottom: -30px;">
              <div style="color: #606265;">اطلاعات روش ارسال</div>
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
                          <input type="text" class="c-content-input__origin c-content-input__origin"
                          name="method_name" value="{{ $delivery_method->name }}" dir="rtl"
                          style="text-align: right;border-color: #e6e9ed!important;">
                        </label>
                      </div>
                    </div>

                    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-4 c-grid__col--xs-gap">

                      <label for="" class="uk-form-label" style="color: #606265;margin-bottom: 7px;">
                        نوع کالا:
                        <span class="uk-form-label__required"></span>
                      </label>

                      <div class="field-wrapper ui-select ui-select__container ui-select__container--product"
                        style="text-align: right; border-color: #e6e9ed !important;">
                        <select name="method_product_weight" id="method_product_weight"
                        class="uk-input uk-input--select js-select-origin" multiple="multiple"
                         style="text-align: right; border-color: #e6e9ed !important;">

                          @php
                            if(isset($delivery_method->weights) && !is_null($delivery_method->weights)) {
                              foreach ($delivery_method->weights as $weight)
                                {
                                  $this_product_weights[] = $weight->id;
                              }
                            }
                          @endphp

                          @if(isset($weights) && !is_null($weights))
                            @foreach($weights as $weight)
                              <option value="{{ $weight->id }}" {{ (isset($this_product_weights) && in_array($weight->id, $this_product_weights))? 'selected' : '' }} >{{ $weight->name }}</option>
                            @endforeach
                          @endif

                        </select>
                        <span class="select-counter"></span>
                        <div class="js-select-options"></div>
                      </div>

                    </div>


                  </div>

                  <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm"></div>

                  <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm">
                    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-4 c-grid__col--xs-gap">
                      <div class="field-wrapper">
                        <label class="c-ui-form__label" for="product_page_title">نوع قیمت‌گذاری:</label>
                        <select id="method_cost_type" class="dropdown-control c-ui-select c-ui-select--common
                            c-ui-select--small select2-hidden-accessible c-ui-input--disabled"
                            name="method_cost_type" tabindex="-1" aria-hidden="true" style="width: 150px ​!important;"
                            {{ ($delivery_method->id == 1 || $delivery_method->id == 2) ? 'disabled' : '' }}>
                          @if(count($deliveryCostDetTypes))
                            @foreach($deliveryCostDetTypes as $key => $deliveryCostDetType)
                                <?php
                                  if( ($delivery_method->id !== 1 && $delivery_method->id !== 2) && ($key == 0 || $key == 1) ) {
                                    continue;
                                  }
                                ?>
                              <option class="option-control" value="{{ $deliveryCostDetType->id }}"
                                  {{ ($delivery_method->deliveryCostDetType->id == $deliveryCostDetType->id)? 'selected' : '' }}>
                                    {{ $deliveryCostDetType->name }}
                              </option>
                            @endforeach
                          @endif
                        </select>
                      </div>
                    </div>

                    @if($delivery_method->deliveryCostDetType->id == 3 || $delivery_method->deliveryCostDetType->id == 4)
                        <div class="uk-flex uk-flex-column delivery_cost-div" style="{{ ($delivery_method->deliveryCostDetType->id == 1)? 'display: none' : '' }}">
                          <div class=" c-grid__col c-grid__col--gap-small c-grid__col--flex-initial c-grid__col--xs-gap">
                            <div class="field-wrapper">
                              <label class="c-ui-form__label delivery_cost-lable" for="product_page_title">
                                @if($delivery_method->deliveryCostDetType->id == 4)
                                  هزینه ارسال:
                                @elseif($delivery_method->deliveryCostDetType->id == 3)
                                  حداقل هزینه ارسال:
                                @endif
                              </label>
                              <label class="c-content-input">
                                <input type="number" placeholder="" class="c-mega-campaigns-join-modal__body-table-input c-mega-campaigns-join-modal__body-table-input--xs js-number-input-wrapper delivery_cost" value="{{ $delivery_method->delivery_cost }}" name="delivery_cost" style="max-width: 124px !important;">
                                <span class="c-content-input__text c-content-input__text--overlay" style="left: 0 !important;right: unset !important;">ریال</span>
                              </label>
                            </div>
                          </div>
                        </div>
                    @endif

                  </div>

                </div>


                <div class="c-grid__row " style="margin-right: 15px; margin-top: 25px !important;">
                  <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--xs-gap" style="padding-right: 0px !important;width: 32%;">
                    <label class="c-ui-form__label" for="product_page_title">ارسال رایگان:</label>
                    <div class="field-wrapper field-wrapper--justify field-wrapper--background" style="border-radius: 8px;background-color: #f5f7fa;padding-left: 15px;padding-right: 15px;min-height: 40px;">
                      <label class="c-ui-checkbox c-ui-checkbox--small c-ui-checkbox--auto" >
                        <input type="checkbox" class="c-ui-checkbox__origin" name="has_free_delivery" value="1" {{ !is_null($delivery_method->free_shipping_min_cost)? 'checked' : '' }}>
                        <span class="c-ui-checkbox__check"></span>
                        <span class="c-ui-checkbox__label">ارسال رایگان برای خرید های بالاتر از مبلغی مشخص فعال باشد.</span>
                      </label>
                    </div>
                  </div>

                  <div class="uk-flex uk-flex-column" style="">
                    <div class=" c-grid__col c-grid__col--gap-small c-grid__col--flex-initial c-grid__col--xs-gap">
                      <div class="field-wrapper">
                        <label class="c-ui-form__label" for="product_page_title">حداقل ارزش سبد خرید:</label>
                        <label class="c-content-input">
                          <input type="number" placeholder="" class="c-mega-campaigns-join-modal__body-table-input c-mega-campaigns-join-modal__body-table-input--xs js-number-input-wrapper min_card_cost
                           {{ is_null($delivery_method->free_shipping_min_cost)? 'c-ui-input--disabled' : '' }}"
                                 value="{{ !is_null($delivery_method->free_shipping_min_cost)? $delivery_method->free_shipping_min_cost : '' }}"
                                 name="min_card_cost" style="max-width: 124px !important;"  {{ is_null($delivery_method->free_shipping_min_cost)? 'disabled' : '' }}>
                          <span class="c-content-input__text c-content-input__text--overlay" style="left: 0 !important;right: unset !important;">ریال</span>
                        </label>
                      </div>
                    </div>
                  </div>


                </div>

{{--                <div class="c-grid__row " style="margin-right: 15px; margin-top: 25px !important;">--}}
{{--                  <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--xs-gap" style="padding-right: 0px !important;width: 32%;">--}}
{{--                    <label class="c-ui-form__label" for="product_page_title">محدودیت:</label>--}}
{{--                    <div class="field-wrapper field-wrapper--justify field-wrapper--background" style="border-radius: 8px;background-color: #f5f7fa;padding-left: 15px;padding-right: 15px;min-height: 40px;">--}}
{{--                      <label class="c-ui-checkbox c-ui-checkbox--small c-ui-checkbox--auto" id="productIsFakeLabel">--}}
{{--                        <input type="checkbox" class="c-ui-checkbox__origin" name="has_state_limit" value="1" {{ count($delivery_method->states)? 'checked' : '' }}>--}}
{{--                        <span class="c-ui-checkbox__check"></span>--}}
{{--                        <span class="c-ui-checkbox__label">تعیین محدودیت برای استان</span>--}}
{{--                      </label>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}

{{--                <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-12 c-grid__col--xs-gap method_states_div" style=" {{ !count($delivery_method->states)? 'display: none' : '' }}">--}}

{{--                  <label for="" class="uk-form-label" style="color: #606265;margin-bottom: 7px; margin-top: 20px;">--}}
{{--                    استان:--}}
{{--                    <span class="uk-form-label__required"></span>--}}
{{--                  </label>--}}

{{--                  <div class="field-wrapper ui-select ui-select__container ui-select__container--product" style="text-align: right; border-color: #e6e9ed !important;">--}}
{{--                    <select name="method_states" class="uk-input uk-input--select js-select-origin method_states" multiple="multiple" style="text-align: right; border-color: #e6e9ed !important;">--}}
{{--                      @php--}}
{{--                        if(isset($delivery_method->states) && !is_null($delivery_method->states)) {--}}
{{--                          foreach ($delivery_method->states as $state)--}}
{{--                            {--}}
{{--                              $this_states[] = $state->id;--}}
{{--                          }--}}
{{--                        }--}}
{{--                      @endphp--}}

{{--                      @if(isset($states) && !is_null($states))--}}
{{--                        @foreach($states->where('type', 'state') as $state)--}}
{{--                          <option value="{{ $state->id }}" {{ (isset($this_states) && in_array($state->id, $this_states))? 'selected' : '' }} >{{ $state->name }}</option>--}}
{{--                        @endforeach--}}
{{--                      @endif--}}

{{--                    </select>--}}
{{--                    <span class="select-counter"></span>--}}
{{--                    <div class="js-select-options"></div>--}}
{{--                  </div>--}}

{{--                </div>--}}

              </div>
            </div>

            @if(!count($values))
              <div class="c-grid__row c-grid__row--gap-lg" style="margin-bottom: 30px; margin-top: 30px !important;">
                <a class="c-ui-btn c-ui-btn--next mr-a save-form" style=" margin-left: 40px !important;" data-value="top">ذخیره</a>
              </div>
            @else
              <div style="margin-top: 40px"></div>
            @endif

          </div>
        </div>
      </div>
    </div>

    @if(count($values))
    <div class="js-table-container">
      <div class="content-section">
          @include('staffdelivery::layouts.deliveryMethod.edit.table')
      </div>
    </div>
    @endif

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

  var intra_provinces = $("input[name='intra_province']").map(function(){return $(this).val();}).get();

  var neighboring_provinces = $("input[name ='neighboring_provinces']").map(function(){return $(this).val();}).get();

  var extra_provinces = $("input[name ='extra_province']").map(function(){return $(this).val();}).get();

  var uploaded_icon_id = $("#iconImageTempId").val();


  if ($("input[name='has_free_delivery']").is(':checked')){
    var has_free_delivery = 1;
  }

  if ($("input[name='has_state_limit']").is(':checked')){
    var has_state_limit = 1;
  }

  var method_name = $("input[name='method_name']").val();
  var method_product_weight = $("#method_product_weight").val();
  var method_cost_type = $("#method_cost_type").val();
  var delivery_cost = $("input[name='delivery_cost']").val();
  var min_card_cost = $("input[name='min_card_cost']").val();
  var method_states = $(".method_states").val();
  var save_type = $(".save-form").data('value');

  $.ajax({
    method: "post",
    url: '{{route('staff.delivery.storeDeliveryMethod')}}',
    data: {
      method_id: {{ $delivery_method->id }},
      name: method_name,
      weights: method_product_weight,
      cost__det_type: method_cost_type,
      delivery_cost: delivery_cost,
      has_free_delivery: has_free_delivery,
      min_card_cost: min_card_cost,
      has_state_limit: has_state_limit,
      states: method_states,
      save_type: save_type,
      intra_provinces: intra_provinces,
      extra_provinces: extra_provinces,
      neighboring_provinces: neighboring_provinces,
    },


    success: function () {
        $(window).scrollTop(0);

        UIkit.notification({
          message: 'اطلاعات ذخیره شد',
          status: 'success',
          pos: 'top-left',
          timeout: 9000
        });

        window.location.href = "{{ route('staff.delivery.index') }}";
    },

    error: function (errors) {
      Promotion.displayError(errors.responseJSON.data.errors);
    }

  });

});

function initIconUpload() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  let $iconUpload = $('#iconUpload');
  let $previewImg = $('#iconUploadPreview');
  let $errorsSection = $('#iconUploadErrors');
  window.UIkit.upload($iconUpload, {
    url: "{{ route('staff.delivery.UploadImage') }}",
    beforeSend: function () {
      $errorsSection.html('');
    },
    beforeSend: e => e.headers = { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
    beforeAll: function () {
      $iconUpload.addClass('loading');
      $errorsSection.html('');
    },
    load: function () {
    },
    error: function () {
    },
    complete: function () {
      let result = JSON.parse(arguments[0].response);
      if (typeof result.status === 'undefined') {
        return;
      }
      $errorsSection.html('');
      $errorsSection.addClass('hidden');
      /**
       * @param result
       * @param result.data.errors errors related to image validation
       * @param result.data.error_server error related to cloud upload
       */
      if (typeof result.data.errors !== 'undefined') {
        $.each(result.data.errors, function (messageKey, messageText) {
          let $div = $('<div/>');
          $div.html(messageText);
          $errorsSection.append($div);
        });
        $errorsSection.removeClass('hidden');
        $iconUpload.removeClass('loading');
        return;
      }

      if (typeof result.data.error_server !== 'undefined') {
        let $div = $('<div/>');
        $div.html(result.data.error_server);
        $errorsSection.append($div);
        $errorsSection.removeClass('hidden');
        $iconUpload.removeClass('loading');
        return;
      }

      $iconUpload.removeClass('empty loading');
      $previewImg.attr('src', result.data.url);
      $('#iconImageTempId').val(result.data.id);
    },
    loadStart: function () {
    },
    progress: function () {
    },
    loadEnd: function () {
    },
    completeAll: function () {
    }
  });

}

initIconUpload();

$('.delete-icon').on('click', function (e) {
  // e.preventDefault();

  var nav_id = $("input[name='nav_id']").val();


  $.ajax({
    method: "post",
    url: '{{route('staff.delivery.deleteIcon')}}',
    data: {
      method_id: {{ $delivery_method->id }},
    },
    success: function () {
      $('#iconImageTempId').val('');

      UIkit.notification({
        message: 'آیکون حذف شد.',
        status: 'success',
        pos: 'top-left',
        timeout: 3000
      });

        window.location.href = "{{ route('staff.delivery.edit', ['id' => $delivery_method->id]) }}";

    },

    error: function (errors) {
      Promotion.displayError(errors.responseJSON.data.errors);
    }
  });

});

$(document).on('change', "input[name='has_free_delivery']", function (){
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

$(document).on('change', "#method_cost_type", function (){
  if ($(this).val() == 4) {
    $(".delivery_cost-div").show();
    $(".delivery_cost-lable").text('هزینه ارسال:');
  }
  else if($(this).val() == 3) {
    $(".delivery_cost-div").show();
    $(".delivery_cost-lable").text('حداقل هزینه ارسال:');
  }
  else if($(this).val() == 1 || $(this).val() == 2){

    $(".delivery_cost-div").hide();
    $(".delivery_cost").val('');

    $.ajax({
      method: 'post',
      url: '{{ route('staff.delivery.contentLoader', ['id'=> $delivery_method->id]) }}',
      data: {

      },
      success: function (response){
        $(".content-section").replaceWith(response);
      }
    });

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
