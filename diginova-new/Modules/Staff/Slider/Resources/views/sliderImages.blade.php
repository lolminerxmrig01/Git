@extends('layouts.staff.master')
@section('title') انتخاب تصویر اسلایدر | {{ $fa_store_name }}  @endsection
@section('head')
  <script type="text/javascript" src="{{ asset('mehdi/staff/js/jquery-latest.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('mehdi/staff/js/jquery-ui.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('mehdi/staff/css/tagify.css') }}">
  <script src="{{ asset('mehdi/staff/js/jQuery.tagify.min.js') }}"></script>
  <script src="{{ asset('mehdi/staff/js/tagify.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('mehdi/staff/css/venobox.min.css') }}">
  <script src="{{ asset('mehdi/staff/js/venobox.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('mehdi/staff/css/dragsort.css') }}"
   media="print" onload="this.media='all'">
  <script src="{{ asset('mehdi/staff/js/dragsort.js') }}"></script>

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
                انتخاب تصاویر برای بنرها و اسلایدرها
                <span>
                برای بنرها و اسلایدرها تصاویر مناسب انتخاب کنید.
              </span>
              </h1>
            </div>
          </div>
        </div>

        <div class="js-table-container">
          <div class="c-grid__row" style="margin-top:30px">
            <div class="c-grid__col">
              <div class="c-card">
                <div class="c-card__wrapper">
                  <div class="c-card__header c-card__header--table">
                    @if(($slider->type == "slider") || ($slider->type == "slider-r"))
                      <a target="_blank">
                        <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">ایجاد ردیف
                          جدید
                        </div>
                      </a>
                    @endif
                    <div class="c-ui-paginator js-paginator" data-select2-id="25" style="visibility: hidden;"></div>
                    <div class="c-ui-paginator js-paginator">
                      <div class="c-ui-paginator__total" data-rows="۶">
                        تعداد نتایج: <span name="total" data-id="5">{{ persianNum($slider_images->total()) }} مورد</span>
                      </div>
                    </div>
                  </div>
                  <div class="c-card__body c-ui-table__wrapper">
                    <table class="c-ui-table  js-search-table js-table-fixed-header c-join__table">
                      <thead>
                      <tr class="c-ui-table__row">
                        <th class="c-ui-table__header">
                          <span class="table-header-searchable uk-text-nowrap ">ردیف</span>
                        </th>
                        <th class="c-ui-table__header">
                          <span class="table-header-searchable uk-text-nowrap table-header-searchable--desc">راهنما</span>
                        </th>
                        <th class="c-ui-table__header">
                          <span class="table-header-searchable uk-text-nowrap ">عنوان</span>
                        </th>
                        <th class="c-ui-table__header"><span
                            class="table-header-searchable uk-text-nowrap ">اندازه استاندارد</span>
                        </th>
                        <th class="c-ui-table__header"><span
                            class="table-header-searchable uk-text-nowrap ">لینک به آدرس</span>
                        </th>
                        <th class="c-ui-table__header"><span
                            class="table-header-searchable uk-text-nowrap ">تگ جایگزین (Alt)</span>
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
                      @foreach($slider_images->sortBy('position') as $key => $item)

                        <tr name="row db-row" id="item-{{ $item->id }}" data-id="{{ $item->id }}"
                          class="c-ui-table__row c-ui-table__row--body c-join__table-row row db-row">

                          <input name="media_id" hidden>

                          <td class="c-ui-table__cell" style="padding-right: 0px; padding-left: 23px;">
                            <div class="c-content-upload__drag-handler c-content-upload__drag-handler--outer">
                              <span class="c-content-upload__drag-handler c-content-upload__drag-handler--up js-sort-up"></span>
                              <span class="c-content-upload__drag-handler c-content-upload__drag-handler--bg"></span>
                              <span class="c-content-upload__drag-handler c-content-upload__drag-handler--down js-sort-down"></span>
                            </div>
                          </td>

                          <td class="c-ui-table__cell" style="min-width: 90px">
                            <img src="{{ asset("mehdi/staff/images/slider/" . substr($slider->name, 0, strrpos($slider->name, '(')-1) . ".png") }}"
                             width="85%" height="85%">
                          </td>

                          <td class="c-ui-table__cell c-ui-table__cell--small-text" style="text-align: center; min-width: 200px;">
                              <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                                  {{ $slider->name }}
                              </span>
                          </td>

                          <td class="c-ui-table__cell c-ui-table__cell--small-text">
                              <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                                  {{ $slider->size . ' px' }}
                              </span>
                          </td>

                          <td class="c-ui-table__cell c-ui-table__cell-desc c-ui--pt-15 c-ui--pb-15" style="text-align: right;">
                            <input type="text" name="link" value="{{ $item->link }}" class="c-content-input__origin
                             js-attribute-old-value link {{ (($item->type == 'required_multiple')|| ($item->type == 'multiple'))? 'c-ui-input--disabled' : '' }}" {{ (($item->type == 'required_multiple') || ($item->type == 'multiple'))? 'disabled' : '' }}>
                          </td>

                          <td class="c-ui-table__cell c-ui-table__cell--small-text">
                            <input type="text" name="img_alt" value="{{ $item->alt }}" class="c-content-input__origin
                             js-attribute-old-value img_alt {{ (($item->type == 'required_multiple') || ($item->type == 'multiple'))? 'c-ui-input--disabled' : '' }}" {{ (($item->type == 'required_multiple') || ($item->type == 'multiple'))? 'disabled' : '' }}>
                          </td>

                          <td class="c-ui-table__cell c-ui-table__cell--small-text">
                            <div class="c-ui-tooltip__anchor">
                              <div class="c-ui-toggle__group">
                                <label class="c-ui-toggle">
                                  <input class="c-ui-toggle__origin js-toggle-active-product status" type="checkbox"
                                   name="status" {{ ($item->status == 'active')? 'checked' : '' }} {{ (($item->type == 'required_single') || ($item->type == 'required_multiple'))? 'disabled' : '' }}>
                                  <span class="c-ui-toggle__check"></span>
                                </label>
                              </div>
                            </div>
                          </td>

                          <td class="c-ui-table__cell">
                            <div class="c-promo__actions" style="width: auto; min-width: 15%; margin: auto;">

                              <label class="c-RD-profile__upload-btn" style="margin-top: 5px;border: 1px solid #e6e6e6;height: 37px;width: 37px;">
                                <input name="sliderImage" data-id="{{ $item->id }}" type="file"
                                  class="js-profile-business-info-logo" accept="image">
                                <input name="sliderImageId" type="hidden"
                                  value="{{ ($item->media()->exists())? $item->media->first()->id : '' }}">
                              </label>

                              <a href="{{ ($item->media()->exists())? $site_url . '/' . $item->media->first()->path . '/'. $item->media->first()->name : '' }}"
                                 class="venobox o-spacing-m-t-1 js-campaign-actions js-archive-badge c-product-config-archive-badge
                                   uk-flex uk-flex-center uk-flex-middle uk-padding-remove vbox-item" data-icon="action-visibility-eye" data-variant-id="" data-hide="{is_archived: true}" data-value="1" data-is-archived="false" data-tooltip-type="normal" data-tooltip-position="br" data-tooltip-has-before-element="true" style="float: right;margin-top: 5px !important;margin-right: 5px;">
                                <span data-tooltip-body="" style="min-height:20px; width: auto;">شاهده تصویر</span>
                              </a>

                              @if($i == 1)
                                <button type="button" class="c-content-upload__btn c-content-upload__btn--remove remove-btn" style="float: right;margin-top: 5px !important;margin-right: 5px;opacity: 43%;" disabled=""></button>
                              @else
                                <button class="c-content-upload__btn c-content-upload__btn--remove remove-btn" style="float: right;margin-top: 5px !important;margin-right: 5px;"></button>
                              @endif
                            </div>
                          </td>
                        </tr>

                        @php
                          $i++;
                        @endphp
                      @endforeach

                      </tbody>
                    </table>
                  </div>

                  <div class="c-card__footer" style="width: auto;">

                    @if(($slider->type == "slider") || ($slider->type == "slider-r"))
                      <a target="_blank">
                        <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">ایجاد ردیف
                          جدید
                        </div>
                      </a>
                    @endif
                    <div class="c-ui-paginator js-paginator" data-select2-id="25" style="visibility: hidden;"></div>

                    <div class="c-ui-paginator js-paginator" data-select2-id="25">
                      <div class="c-ui-paginator__total" data-rows="۶">
                        تعداد نتایج: <span name="total" data-id="2">{{ persianNum($slider_images->total()) }} مورد</span>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="c-grid__row">
        <div class="c-grid__col">
          <div class="c-card">
            <div class="edit-form-section c-card__footer c-card__footer--products">
              <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6 c-grid__col--xs-gap"
                   style="width: 40%; float: left; display: contents;">
                <a class="c-ui-btn c-ui-btn--next mr-a" style="margin-left: 68px;max-width: 100px;" id="submit-form">ذخیره
                </a>
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

  <div uk-modal="esc-close: true; bg-close: true;"
       class="uk-modal-container uk-modal-container--message js-common-modal-notification uk-modal"
       style="display: none;">
    <div class="uk-modal-dialog uk-modal-dialog--flex">
      <button class="uk-modal-close-default uk-close uk-icon" type="button" uk-close=""></button>

      <div class="uk-modal-body">
        <div class="c-modal-notification">
          <div class="c-modal-notification__content c-modal-notification__content--limited">
            <h2 class="c-modal-notification__header">هشدار</h2>

            <p class="c-modal-notification__text">با حذف ویژگی مورد نظر ، این ویژگی از فیلتر محصولات دسته
              انتخابی به صورت کامل حذف شده و قابل بازیابی نمی‌باشد. آیا از حذف کامل آن اطمینان دارید؟</p>
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

    // ایجکس آپلود عکس
    $(document).on("change", "input[name='sliderImage']", function () {
      var form_data = new FormData();
      var input_image = $(this).prop("files")[0];

      form_data.append("image", input_image);

      var row_id = $(this).data('id');
      form_data.append("row_id", row_id);

      var old_img = $(this).closest('tr').find("input[name='sliderImageId']").val();
      if (old_img) {
        form_data.append("old_img", old_img);
      }

      $(this).closest('tr').addClass('active_row');

      $.ajax({
        url: '{{route('staff.sliders.UploadImage')}}',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {

          if (response !== null) {
            var media_id = response;
            $('.active_row').find("input[name='media_id']").val(media_id);
          }

          $(window).scrollTop(0);

          UIkit.notification({
            message: 'تصویر ذخیره شد',
            status: 'success',
            pos: 'top-left',
            timeout: 3000
          });

          {{--      window.location.href = "{{ route('staff.sliders.sliderImages', ['id' => $slider->id] ) }}";--}}
        },
      });

    });

    $(document).ready(function(){
      $('.venobox').venobox();
    });

    // ایجکس فرم اصلی
    $('#submit-form').on('click', function (e) {
      // e.preventDefault();

      var slider_links = $("input[name='link']").map(function(){return $(this).val();}).get();

      var images_alt = $("input[name ='img_alt']").map(function(){return $(this).val();}).get();

      var status = $("input[name='status']").map(function(){
        if($(this).is(':checked')){return 'active';}else{return 'inactive';}
      }).get();

      var deleted_rows = $("input[name='deleted_row']").map(function(){return $(this).val();}).get();

      var position = $("tbody").sortable('serialize');

      var slider_id = {{ $slider->id }};

      var media_ids = $("input[name='media_id']").map(function(){return $(this).val();}).get();

      $.ajax({
        method: "post",
        url: '{{route('staff.sliders.updateSliderImagesRow')}}',
        data: {
          positions:position,
          deleted_rows:deleted_rows,
          slider_links: slider_links,
          images_alt: images_alt,
          status: status,
          slider_id: slider_id,
          media_ids: media_ids,
        },

        success: function () {
          $(window).scrollTop(0);

          UIkit.notification({
            message: 'اطلاعات با موفقیت ذخیره شد',
            status: 'success',
            pos: 'top-left',
            timeout: 3000
          });

          window.location.href = "{{ route('staff.sliders.sliderImages', ['id' => $slider->id] ) }}";
        },

      });

    });


    $('tbody').sortable({
      handle: '.c-content-upload__drag-handler',
    });

    $(document).on('click', '.c-mega-campaigns__btns-green-plus', function () {
      var slider_name = "{{ $slider->name }}";
      var slider_size = "{{ $slider->size . ' px' }}";
      var slider_image = "{{ asset("mehdi/staff/images/slider/" . substr($slider->name, 0, strrpos($slider->name, '(')-1) . ".png") }}";

      var tr = '<tr name="row" id="item-new" data-id="" class="c-ui-table__row c-ui-table__row--body c-join__table-row row">' +
        '<td class="c-ui-table__cell" style="padding-right: 0px; padding-left: 23px;"><input name="media_id" hidden>' +
        '<div class="c-content-upload__drag-handler c-content-upload__drag-handler--outer">' +
        ' <span class="c-content-upload__drag-handler c-content-upload__drag-handler--up js-sort-up">' +
        '</span> <span class="c-content-upload__drag-handler c-content-upload__drag-handler--bg"></span>' +
        ' <span class="c-content-upload__drag-handler c-content-upload__drag-handler--down js-sort-down"></span>' +
        '</div></td><td class="c-ui-table__cell" style="min-width: 90px"> <img src="' + slider_image + '" width="85%" height="85%">' +
        '</td>' +
        '<td class="c-ui-table__cell c-ui-table__cell--small-text" style="text-align: center; min-width: 200px;"> ' +
        '<span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">' + slider_name + '</span>' +
        '</td>' +
        '<td class="c-ui-table__cell c-ui-table__cell--small-text"> ' +
        '<span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">' + slider_size + '</span>' +
        '</td>' +
        '<td class="c-ui-table__cell c-ui-table__cell-desc c-ui--pt-15 c-ui--pb-15" style="text-align: right;"> ' +
        '<input type="text" name="link" value="" class="c-content-input__origin js-attribute-old-value link">' +
        '</td>' +
        '<td class="c-ui-table__cell c-ui-table__cell--small-text"> ' +
        '<input type="text" name="img_alt" value="" class="c-content-input__origin js-attribute-old-value img_alt">' +
        '</td>' +
        '<td class="c-ui-table__cell c-ui-table__cell--small-text">' +
        '<div class="c-ui-tooltip__anchor"><div class="c-ui-toggle__group"> ' +
        '<label class="c-ui-toggle"> <input class="c-ui-toggle__origin js-toggle-active-product status" type="checkbox" name="status" checked> ' +
        '<span class="c-ui-toggle__check"></span> </label>' +
        '</div></div>' +
        '</td>' +
        '<td class="c-ui-table__cell"><div class="c-promo__actions" style="width: auto; min-width: 15%; margin: auto;">' +
        '<label class="c-RD-profile__upload-btn" style="margin-top: 5px;border: 1px solid #e6e6e6;height: 37px;width: 37px;">' +
        ' <input name="sliderImage" data-media-id="" data-id="" type="file" class="js-profile-business-info-logo sliderImage" accept="image">' +
        ' <input name="sliderImageId" type="hidden" value=""> </label>' +
        '<a href="" class="venobox o-spacing-m-t-1 js-campaign-actions js-archive-badge c-product-config-archive-badge uk-flex uk-flex-center uk-flex-middle uk-padding-remove vbox-item" data-icon="action-visibility-eye" data-variant-id="" data-hide="{is_archived: true}" data-value="1" data-is-archived="false" data-tooltip-type="normal" data-tooltip-position="br" data-tooltip-has-before-element="true" style="float: right;margin-top: 5px !important;margin-right: 5px;"> ' +
        '<span data-tooltip-body="" style="min-height:20px; width: auto;">شاهده تصویر</span> </a>' +
        '<button class="c-content-upload__btn c-content-upload__btn--remove remove-btn" style="float: right;margin-top: 5px !important;margin-right: 5px;"></button>' +
        '</div>' +
        '</td>' +
        '</tr>';

      $("#tbody").append(tr);

      $('.venobox').venobox();


    });

    $(document).on('click', '.remove-btn', function () {
      $(this).closest("tr").addClass('hide-tr');

      if ($(document).find('.hide-tr').hasClass('db-row'))
      {
        var deleted_id = $(".hide-tr").attr('data-id');
        var deleted_row = '<input name="deleted_row" value="' + deleted_id + '" hidden>';
        $('.c-main').append(deleted_row);
        $(".hide-tr").remove();
      }
      else {
        $(".hide-tr").remove();
      }
    });

  </script>
@endsection
