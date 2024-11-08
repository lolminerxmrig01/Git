@extends('layouts.staff.master')
@section('title') مدیریت فهرست ها | {{ $fa_store_name }}  @endsection
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
                مدیریت فهرست‌ها
                <span>
                از این بخش می‌توانید فهرست‌های
                {{ '"' .$nav_location->name . '"' }}
                را مدیریت کنید.
              </span>
              </h1>
            </div>
          </div>
        </div>

        <div class="js-table-container">

          <div class="content-section">
            <div class="c-grid__row" style="margin-top:30px">
              <div class="c-grid__col">
                <div class="c-card">
                  <div class="c-card__wrapper">
                    <div class="c-card__header c-card__header--table">
                      <a target="_blank">
                        <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">ایجاد فهرست
                          جدید
                        </div>
                      </a>
                      <div class="c-ui-paginator js-paginator" data-select2-id="25" style="visibility: hidden;"></div>
                      <div class="c-ui-paginator js-paginator">
                        <div class="c-ui-paginator__total" data-rows="۶">
                          تعداد نتایج: <span name="total" data-id="5">{{ persianNum($navs->total()) }} مورد</span>
                        </div>
                      </div>
                    </div>
                    <div class="c-card__body c-ui-table__wrapper">
                      <table class="c-ui-table  js-search-table js-table-fixed-header c-join__table">
                        <thead>
                        <tr class="c-ui-table__row">
                          <th class="c-ui-table__header">
                            <span class="table-header-searchable uk-text-nowrap "></span>
                          </th>
                          <th class="c-ui-table__header">
                            <span class="table-header-searchable uk-text-nowrap table-header-searchable--desc">عنوان فهرست</span>
                          </th>
                          <th class="c-ui-table__header">
                            <span class="table-header-searchable uk-text-nowrap ">لینک به آدرس</span>
                          </th>
                          <th class="c-ui-table__header"><span
                              class="table-header-searchable uk-text-nowrap ">نوع فهرست</span>
                          </th>
                          <th class="c-ui-table__header"><span
                              class="table-header-searchable uk-text-nowrap ">وضعیت</span>
                          </th>
                          <th class="c-ui-table__header"><span
                              class="table-header-searchable uk-text-nowrap ">عملیات</span></th>
                        </tr>
                        </thead>
                        <tbody id="tbody">
                        @php
                          $i = 1;
                        @endphp
                        @if(count($navs))
                          @foreach($navs->sortBy('position') as $key => $nav)
                            <tr name="row db-row" id="item-{{ $nav->id }}" data-id="{{ $nav->id }}" class="c-ui-table__row c-ui-table__row--body
                             c-join__table-row row db-row">

                              <td class="c-ui-table__cell" style="padding-right: 0px; padding-left: 23px;">
                                <div class="c-content-upload__drag-handler c-content-upload__drag-handler--outer">
                                  <span class="c-content-upload__drag-handler c-content-upload__drag-handler--up js-sort-up"></span>
                                  <span class="c-content-upload__drag-handler c-content-upload__drag-handler--bg"></span>
                                  <span class="c-content-upload__drag-handler c-content-upload__drag-handler--down js-sort-down"></span>
                                </div>
                              </td>

                              <td class="c-ui-table__cell c-ui-table__cell--small-text" style="text-align: center; min-width: 200px;">
                                <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                                    {{ $nav->name }}
                                </span>
                              </td>

                              <td class="c-ui-table__cell c-ui-table__cell--text-blue">
                                @if(!is_null($nav->link))
                                  <a class="c-join__promotion-link" href="" target="_blank" style="font-weight: bold">{{ $nav->link }}</a>
                                  <a class="c-join__promotion-copy-btn js-copy-btn" href="#" data-link="{{ $nav->link }}">کپی لینک</a>
                                @endif
                              </td>

                              <td class="c-ui-table__cell c-ui-table__cell-desc" style="text-align: center;">
                              <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                                  {{ ($nav->type == 'common')? 'معمولی' : 'دارای مگا‌منو' }}
                              </span>
                              </td>

                              <td class="c-ui-table__cell c-ui-table__cell--small-text">
                                <div class="c-ui-tooltip__anchor">
                                  <div class="c-ui-toggle__group">
                                    <label class="c-ui-toggle">
                                      <input class="c-ui-toggle__origin js-toggle-active-product" type="checkbox" name="status"
                                       {{ ($nav->status == 'active')? 'checked' : '' }} data-nav-id="{{$nav->id}}">
                                      <span class="c-ui-toggle__check"></span>
                                    </label>
                                  </div>

                                  <input type="hidden" value="0" class="js-active-input">
                                </div>
                              </td>


                              <td class="c-ui-table__cell">
                                <div class="c-promo__actions">
                                  <a class="c-join__btn c-join__btn--secondary-greenish" href="{{ route('staff.navs.navItems', $nav->id) }}">
                                    ویرایش فهرست
                                  </a>
                                  <button class="c-join__btn c-join__btn--icon-right c-join__btn--icon-delete c-join__btn--primary js-remove-plp
                                   js-remove-product-list delete-btn" value="{{ $nav->id }}">حذف</button>
                                </div>

                                <div uk-modal="esc-close: true; bg-close: true;" class="uk-modal-container uk-modal-container--message
                                 js-common-modal-notification" style="display: none;">
                                  <div class="uk-modal-dialog uk-modal-dialog--flex">
                                    <button class="uk-modal-close-default uk-close uk-icon" type="button" uk-close=""></button>
                                    <div class="uk-modal-body">
                                      <div class="c-modal-notification">
                                        <div class="c-modal-notification__content c-modal-notification__content--limited">
                                          <h2 class="c-modal-notification__header">هشدار</h2>
                                          <p class="c-modal-notification__text">
                                            با حذف این فهرست، تمامی منو های آن حذف خواهد شد. آیا از حذف آن اطمینان دارید؟
                                          </p>
                                          <div class="c-modal-notification__actions">
                                            <button class="c-modal-notification__btn no uk-modal-close">
                                              خیر
                                            </button>
                                            <button class="c-modal-notification__btn c-modal-notification__btn--secondary yes uk-modal-close">
                                              بله
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </td>
                            </tr>

                            @php
                              $i++;
                            @endphp
                          @endforeach
                        @endif
                        </tbody>
                      </table>
                    </div>

                    <div class="c-card__footer" style="width: auto;">
                      <a target="_blank">
                        <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">ایجاد فهرست
                          جدید
                        </div>
                      </a>
                      <div class="c-ui-paginator js-paginator" data-select2-id="25" style="visibility: hidden;"></div>

                      <div class="c-ui-paginator js-paginator" data-select2-id="25">
                        <div class="c-ui-paginator__total" data-rows="۶">
                          تعداد نتایج: <span name="total" data-id="2">{{ persianNum($navs->total()) }} مورد</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      @include('staffnav::layouts.createNavModal')

      <div id="pageLoader" class="c-content-loader c-content-loader--fixed">
        <div class="c-content-loader__logo"></div>
        <div class="c-content-loader__spinner"></div>
      </div>
    </div>
  </main>

  <div uk-modal="esc-close: true; bg-close: true;"
       class="uk-modal-container uk-modal-container--message js-common-modal-notification uk-modal"
       style="display: none;">
    <div class="uk-modal-dialog uk-modal-dialog--flex">
      <button class="uk-modal-close-default uk-close uk-icon" type="button" uk-close=""></button>

      <div class="uk-modal-body">
        <div class="c-modal-notification">
          <div class="c-modal-notification__content c-modal-notification__content--limited">
            <h2 class="c-modal-notification__header">هشدار</h2>

            <p class="c-modal-notification__text">
              با حذف ویژگی مورد نظر ، این ویژگی از فیلتر محصولات دسته
              انتخابی به صورت کامل حذف شده و قابل بازیابی نمی‌باشد. آیا از حذف کامل آن اطمینان دارید؟
            </p>
            <div class="c-modal-notification__actions">
              <button class="c-modal-notification__btn no uk-modal-close">خیر</button>
              <button
                class="c-modal-notification__btn c-modal-notification__btn--secondary yes uk-modal-close">
                بله
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="uk-flex uk-flex-column values-td select-unit" style="display: none;">

    <select name="attr_unit[]" class="uk-input uk-input--select attr_input_tag js-select-origin select2-hidden-accessible"
     tabindex="-1" aria-hidden="true" aria-invalid="false">
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

$(document).on('click', '.c-mega-campaigns__btns-green-plus', function () {
  $("#newAttributeRequestModal").addClass('uk-open');
  $("#newAttributeRequestModal").css('display', 'block');
  $('.c-header__nav').hide();
});

$(document).on('click', '.delete-btn', function () {

  $(this).closest('.c-ui-table__cell').find('.uk-modal-container').addClass('uk-open');
  $(this).closest('.c-ui-table__cell').find('.uk-modal-container').css('display', 'block');
  $('.c-header__nav').hide();

  $(document).on('click', '.yes', function () {

    $('.c-header__nav').show();


    var nav_id = $(this).closest('.c-ui-table__cell').find('.delete-btn').val();
    var nav_location = {{ $nav_location->id }};

    $.ajax({
      method: 'post',
      url: "{{route('staff.navs.deleteNav')}}",
      data: {
        'id': nav_id,
        'nav_location': nav_location,
      },
      success: function (result) {
        $(".content-section").replaceWith(result);
        $(window).scrollTop(0);
        UIkit.notification({
          message: 'فهرست حذف شد',
          status: 'success',
          pos: 'top-left',
          timeout: 3000
        });
      },
    });

  });

  $(document).on('click', '.uk-modal-close-default', function () {
    $('.c-header__nav').show();
  });

  $(document).on('click', '.no', function () {
    $('.c-header__nav').show();
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
    url: '../../upload-image',
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
  $('.c-header__nav').show();
});

$(document).on('click', '.no', function (){
  $('.c-header__nav').show();
});

// ایجکس فرم پاپ آپ
$('.save-btn').on('click', function (e) {
  // e.preventDefault();

  var nav_type = $("input[name='nav_type']:checked").val();
  var location_id = $("input[name='location_id']").val();
  var nav_name = $("input[name='nav_name']").val();
  var nav_link = $("input[name='nav_link']").val();
  var uploaded_icon_id = $("#iconImageTempId").val();

  $.ajax({
    method: "post",
    url: '{{route('staff.navs.storeNav')}}',
    data: {
      nav_type: nav_type,
      location_id: location_id,
      nav_name: nav_name,
      nav_link: nav_link,
      uploaded_icon_id: uploaded_icon_id,
    },
    success: function () {
      $("#newAttributeRequestModal").hide();
      $('#newNanRequestForm').trigger("reset");
      $('.uk-input').val('');
      $('#iconUploadPreview').attr('src', '');
      $('#iconImageTempId').val('');
      $('#iconUpload').addClass('empty');
      $('.c-header__nav').show();

      $.ajax({
        method: "post",
        url: '{{route('staff.navs.reloadNavsTable')}}',
        data: {
          location_id: location_id,
        },
        success: function (result) {
            $(".content-section").replaceWith(result);
            $(window).scrollTop(0);
            UIkit.notification({
              message: 'فهرست ایجاد شد',
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
  var nav_id = $(this).attr('data-nav-id');

  $.ajax({
    method: 'post',
    url: "{{ route('staff.navs.statusNav') }}",
    data: {
      'status': status,
      'nav_id' : nav_id,
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
      url: '{{route('staff.navs.navChangePosition')}}',
    })
  }
});

</script>
@endsection
