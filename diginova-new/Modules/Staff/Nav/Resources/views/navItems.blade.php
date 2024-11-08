@extends('layouts.staff.master')
@section('title') مدیریت منوها | {{ $fa_store_name }}  @endsection
@section('head')
  <script src="{{ asset('mehdi/staff/js/tableView.js') }}"></script>
  <script src="{{ asset('mehdi/staff/js/jquery-ui.min.js') }}"></script>
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
                مدیریت منو‌‌‌‌‌ها
                <span>
                  از این صفحه می‌توانید منو ها یا مگامنو ها را مدیریت کنید.
              </span>
              </h1>
            </div>
          </div>
        </div>

        <div class="c-grid__row">
          <div class="c-grid__col">
            <div class="c-card">
              <h2 style="font-size: 18px;margin-right: 33px;margin-top: 28px;margin-bottom: -30px;">
                <div style="color: #606265;">اطلاعات فهرست</div>
              </h2>
              <div style="width: 100%;margin: -7px 0px 50px 0px !important;padding: 0px !important;background: #e2dddd;height: 1px;display: none;"></div>
              <div class="c-card__header"></div>
              <div class="c-card__body">
                <div class="c-grid__row c-grid__row--gap-lg">
                  <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-12 ">
                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm">
                      <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-4 c-grid__col--xs-gap">
                        <label for="" class="uk-form-label" style="color: #606265;margin-bottom: 7px;">
                          نام فهرست:
                          <span class="uk-form-label__required"></span>
                        </label>

                        <div class="field-wrapper">
                          <label class="c-content-input">
                            <input name="nav_id" class="nav_id" value={{ $nav->id }}"" hidden="">
                            <input type="text" class="c-content-input__origin c-content-input__origin" name="nav_name" value="{{ $nav->name }}" dir="rtl" style="text-align: right;border-color: #e6e9ed!important;">
                          </label>
                        </div>
                      </div>
                      <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-4 c-grid__col--xs-gap">

                        <label for="" class="uk-form-label" style="color: #606265;margin-bottom: 7px;">
                          لینک به آدرس: (اختیاری)
                          <span class="uk-form-label__required"></span>
                        </label>

                        <div class="field-wrapper">
                          <label class="c-content-input">
                            <input type="text" class="c-content-input__origin c-content-input__origin" name="nav_link" value="{{ $nav->link }}" dir="rtl" style="text-align: right;border-color: #e6e9ed!important;">
                          </label>
                        </div>
                      </div><div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-2 c-grid__col--xs-gap" data-select2-id="5">

                        <div class="field-wrapper" data-select2-id="4">
                          <label class="c-ui-form__label" for="product_page_title">وضعیت:</label>
                          <select id="product-status" class="dropdown-control c-ui-select c-ui-select--common c-ui-select--small select2-hidden-accessible c-ui-input--disabled" name="nav_status" tabindex="-1" aria-hidden="true" style="width: 150px ​!important;" disabled>
                            <option class="option-control" value="1" {{ ($nav->type == 'common')? 'selected' : '' }}>معمولی</option>
                            <option class="option-control" value="0" {{ ($nav->type == 'megamenu')? 'selected' : '' }}>دارای مگا‌منو</option>
                          </select>
                        </div>
                      </div>

                    </div>

                    <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm"></div>

                    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6 c-grid__col--row-attr">

                      <label class="c-ui-form__label" for="product_page_title">
                        آیکون فهرست: (اختیاری)
                        @if($nav->media()->exists())
                          <a class="c-ui-btn c-ui-btn--next mr-a delete-icon-nav"  style="margin-left: 21px;width: 59px !important;height: 20px !important;min-width: 45px !important;border-radius: 5px;font-size: 10px;box-shadow: unset;font-weight: bold;" id="submit-form">حذف آیکون</a>
                        @endif
                      </label>

                      <div class="field-wrapper">

                        <div id="iconUpload" class="c-content-modal__uploads-label {{ (!$nav->media()->exists())? 'empty' : '' }}">
                          <span uk-form-custom="" class="uk-form-custom">
                              <input id="brandLogoFile" type="file" class="hidden">
                          </span>

                          <label for="brandLogoFile" class="c-content-modal__uploads-preview">
                            <img src="{{ ($nav->media()->exists())? $site_url . '/' . $nav->media()->first()->path . '/' . $nav->media()->first()->name : '' }}" id="iconUploadPreview" class="c-content-modal__uploads-img" alt="">
                            <span class="c-content-upload__img-loader js-img-loader">
                                <span class="progress__wrapper">
                                    <span class="progress"></span>
                                </span>
                            </span>
                          </label>

                          <span class="c-content-modal__list c-content-modal__uploads-tooltips">
                              <span class="c-content-modal__uploads-text">آیکون منو را در نسبت ۱ در ۱ بارگذاری کنید.</span>
                          </span>

                        </div>

                        <input type="hidden" name="logo_id" class="force-validation" id="iconImageTempId" value="">
                        <div class="c-content-modal__errors-full" id="iconUploadErrors"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="c-grid__row c-grid__row--gap-lg">
                  <a class="c-ui-btn c-ui-btn--next mr-a save-nav" style="margin-left: 21px;" id="submit-form">ذخیره
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="js-table-container">
          <div class="content-section">
            @if($nav->type == 'megamenu')
              @include('staffnav::layouts.megamenu-body')
            @else
              @include('staffnav::layouts.menu-body')
            @endif
          </div>
        </div>


      </div>

      @include('staffnav::layouts.createItemModal')


      <div id="pageLoader" class="c-content-loader c-content-loader--fixed">
        <div class="c-content-loader__logo"></div>
        <div class="c-content-loader__spinner"></div>
      </div>
    </div>
  </main>

  <div class="uk-flex uk-flex-column values-td select-unit" style="display: none;">

    <select name="attr_unit[]" class="uk-input uk-input--select attr_input_tag js-select-origin select2-hidden-accessible" tabindex="-1" aria-hidden="true" aria-invalid="false">
      @if(isset($units) && count($units))
        @foreach($units as $unit)
          <option value="{{ $unit->id }}">{{ $unit->name }}</option>
        @endforeach
      @endif
    </select>
  </div>
@endsection
@section('script')
<script>

// اضافه کردن توکن به درخواست های ایجکس
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


$(document).on('click', '.add-megamenu', function () {
  $("#newAttributeRequestModal").addClass('uk-open');
  $("#newAttributeRequestModal").css('display', 'block');
  $(".c-header__nav js-header-nav c-header__nav--sticky").css('display', 'none !important');
  $('.c-header__item').hide();
});


$(document).on('click', '.delete-btn', function () {

  $(this).closest('.c-ui-table__cell').find('.uk-modal-container').addClass('uk-open');
  $(this).closest('.c-ui-table__cell').find('.uk-modal-container').css('display', 'block');
  $('.c-header__item').hide();

  $(document).on('click', '.yes', function () {

    $('.c-header__item').show();

    var item_id = $(this).closest('.c-ui-table__cell').find('.delete-btn').val();

    $.ajax({
      method: 'post',
      url: "{{route('staff.navs.deleteItem')}}",
      data: {
        'id': item_id,
        'nav_id': {{ $nav->id }},
      },
      success: function (result) {
        $(".content-section").replaceWith(result);
        $(window).scrollTop(0);
        UIkit.notification({
          message: 'منو حذف شد',
          status: 'success',
          pos: 'top-left',
          timeout: 3000
        });
      },
    });

  });

  $(document).on('click', '.uk-modal-close-default', function () {
    $('.c-header__item').show();
  });

  $(document).on('click', '.no', function () {
    $('.c-header__item').show();
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
    url: "{{ route('staff.navs.UploadImage') }}",
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


$(document).on('click', '.uk-close', function () {
  $('.c-header__item').show();
});


$(document).on('click', '.no', function (){
  $('.c-header__item').show();
});


// ایجکس فرم پاپ آپ
$('.save-btn').on('click', function (e) {
  // e.preventDefault();

  var megamenu_name = $("input[name='megamenu_name']").val();
  var megamenu_link = $("input[name='megamenu_link']").val();
  var uploaded_icon_id = $("#iconImageTempId").val();

  $.ajax({
    method: "post",
    url: '{{route('staff.navs.storeMegaMenu')}}',
    data: {
      nav_id: {{ $nav->id }},
      megamenu_name: megamenu_name,
      megamenu_link: megamenu_link,
      uploaded_icon_id: uploaded_icon_id,
    },
    success: function () {
      $("#newAttributeRequestModal").hide();
      $('#newNanRequestForm').trigger("reset");
      $('.uk-input').val('');
      $('#iconUploadPreview').attr('src', '');
      $('#iconImageTempId').val('');
      $('#iconUpload').addClass('empty');
      $('.c-header__item').show();

      $.ajax({
        method: "post",
        url: '{{route('staff.navs.reloadMegamenuTable')}}',
        data: {
            nav_id: {{ $nav->id }},
        },
        success: function (result) {
            $(".content-section").replaceWith(result);
            $(window).scrollTop(0);
            UIkit.notification({
              message: 'مگا‌منو ایجاد شد',
              status: 'success',
              pos: 'top-left',
              timeout: 3000
            });
        },
      });

    },

    error: function (errors) {
      Promotion.displayError(errors.responseJSON.data.errors);
    }
  });

});


$(document).on('change', 'input[name="status"]', function () {
  if($(this).is(':checked'))
  {
    var status = 'active';
  }
  else{
    var status = 'inactive';
  }
  var item_id = $(this).attr('data-item-id');

  $.ajax({
    method: 'post',
    url: "{{ route('staff.navs.statusNav') }}",
    data: {
      'status': status,
      'nav_id' : item_id,
    },
  });
});


$('tbody').sortable({
  handle: '.c-content-upload__drag-handler',
  axis: 'y',
  update: function (event, ui) {
    var data = $("tbody").sortable('serialize');
    $.ajax({
      data: data,
      type: 'post',
      url: '{{route('staff.navs.itemChangePosition')}}',
    })
  }
});

// آپدیت بخش بالای صفحه
$('.save-nav').on('click', function (e) {
  // e.preventDefault();

  var nav_id = $("input[name='nav_id']").val();
  var nav_name = $("input[name='nav_name']").val();
  var nav_link = $("input[name='nav_link']").val();
  var uploaded_icon_id = $("#iconImageTempId").val();

  $.ajax({
    method: "post",
    url: '{{route('staff.navs.updateNav')}}',
    data: {
      nav_id: nav_id,
      nav_name: nav_name,
      nav_link: nav_link,
      uploaded_icon_id: uploaded_icon_id,
    },
    success: function () {
      $('#iconImageTempId').val('');

      UIkit.notification({
        message: 'فهرست ذخیره شد',
        status: 'success',
        pos: 'top-left',
        timeout: 3000
      });
      window.location.href = "{{ route('staff.navs.navItems', ['id' => $nav->id] ) }}";

    },

    error: function (errors) {
      Promotion.displayError(errors.responseJSON.data.errors);
    }
  });

});


$(document).on('click', '.add-menu', function () {
  var tr = '<tr name="row" id="item-new" data-id="xxxxxx" class="c-ui-table__row c-ui-table__row--body c-join__table-row row">' +
    '<td class="c-ui-table__cell" style="padding-right: 0px; padding-left: 23px;">' +
    '<div class="c-content-upload__drag-handler c-content-upload__drag-handler--outer">' +
    ' <span class="c-content-upload__drag-handler c-content-upload__drag-handler--up js-sort-up">' +
    '</span> <span class="c-content-upload__drag-handler c-content-upload__drag-handler--bg"></span>' +
    ' <span class="c-content-upload__drag-handler c-content-upload__drag-handler--down js-sort-down"></span>' +
    '</div></td>' +
    '<td class="c-ui-table__cell c-ui-table__cell--small-text" style="text-align: center; min-width: 200px;"> ' +
    '<span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">' +
    ' <input type="text" class="c-content-input__origin c-content-input__origin menu_name" name="menu_name" value="" dir="rtl" style="text-align: right;">' +
    ' </span></td>' +
    '<td class="c-ui-table__cell c-ui-table__cell--small-text" style="text-align: center; min-width: 200px;"> ' +
    '<span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial"> ' +
    '<input type="text" class="c-content-input__origin c-content-input__origin menu_link" name="menu_link" value="" dir="rtl" style="text-align: right;">' +
    ' </span></td><td class="c-ui-table__cell c-ui-table__cell--small-text"><div class="c-ui-tooltip__anchor"><div class="c-ui-toggle__group">' +
    ' <label class="c-ui-toggle"> <input class="c-ui-toggle__origin js-toggle-active-product" type="checkbox" name="menu_style" data-item-id="">' +
    ' <span class="c-ui-toggle__check"></span> </label></div></div></td><td class="c-ui-table__cell">' +
    '<div class="c-promo__actions"> <button class="c-join__btn c-join__btn--icon-right c-join__btn--icon-delete c-join__btn--primary js-remove-plp js-remove-product-list remove-btn">حذف</button>' +
    '</div></td></tr>';

  $("#tbody").append(tr);
});


$(document).on('click', '.remove-btn', function (){
  $(this).closest('tr').remove();
})

// ایجکس فرم اصلی
$('#save-menus').on('click', function (e) {
  // e.preventDefault();

  var parent_id = {{ $nav->id }};

  var menu_name = $("input[name='menu_name']").map(function(){return $(this).val();}).get();

  var menu_link = $("input[name ='menu_link']").map(function(){return $(this).val();}).get();

  var menu_style = $("input[name='menu_style']").map(function(){
    if($(this).is(':checked'))
    {
      return 'bold';
    }
    else {
      return '';
    }
  }).get();

  var position = $("tbody").sortable('serialize');

  var deleted_rows = $("input[name='deleted_row']").map(function(){return $(this).val();}).get();

  $.ajax({
    method: "post",
    url: '{{route('staff.navs.storeMenus')}}',
    data: {
      deleted_rows: deleted_rows,

      positions: position,
      parent_id: parent_id,
      menu_names: menu_name,
      menu_links: menu_link,
      menu_styles: menu_style,
    },

    success: function () {
      UIkit.notification({
        message: 'فهرست ذخیره شد',
        status: 'success',
        pos: 'top-left',
        timeout: 9000
      });

      $(window).scrollTop(0);

      window.location.href = "{{ route('staff.navs.navItems', ['id' => $nav->id] ) }}";
    },
  });

});


$(document).on('click', '.delete-btn', function (){
  var deleted_id = $(this).val();
  var deleted_row = '<input name="deleted_row" value="' + deleted_id + '" hidden>';
  $('.c-main').append(deleted_row);
  $(this).closest('tr').remove();
})


$('.delete-icon-nav').on('click', function (e) {
  // e.preventDefault();

  var nav_id = $("input[name='nav_id']").val();


  $.ajax({
    method: "post",
    url: '{{route('staff.navs.deleteIcon')}}',
    data: {
      nav_id: nav_id,
    },
    success: function () {
      $('#iconImageTempId').val('');

      UIkit.notification({
        message: 'آیکون حذف شد.',
        status: 'success',
        pos: 'top-left',
        timeout: 3000
      });

      window.location.href = "{{ route('staff.navs.navItems', ['id' => $nav->id] ) }}";

    },

    error: function (errors) {
      Promotion.displayError(errors.responseJSON.data.errors);
    }
  });

});


</script>
@endsection
