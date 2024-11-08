@extends('layouts.staff.master')
@section('title') مدیریت ویژگی‌ها | {{ $fa_store_name }}  @endsection
@section('head')
    <script src="{{ asset('mehdi/staff/js/tags.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>

    <!-- <script src="{{ asset('seller/js/tags3.js') }}"></script> -->
@endsection
@section('content')
    <main class="c-content-layout">
        <div class="uk-container uk-container-large">
            <div class="c-grid">
                <div class="c-content-page c-content-page--plain c-grid__row">
                    <div class="c-grid__col">
                        <div class="c-content-page__header">
                            <span class="c-content-page__header-action">
                                مدیریت ویژگی‌های کالا
                            </span>
                            <span class="c-content-page__header-desc">
                                برای مدیریت ویژگی‌های کالا ابتدا گروه های کالای خود را انتخاب کنید
                            </span>
                        </div>
                    </div>
                </div>
                <div class="c-grid__row">
                    <div class="c-grid__col">
                        <div class="c-card">
                            <div class="c-grid__col">
                                <div class="product-form">
                                    <div class="c-content-accordion js-accordion uk-accordion">
                                        <section class="c-content-accordion__row js-content-section uk-open" id="stepCategoryAccordion">
                                            <h2 style="font-size: 18px; margin-right: 33px; margin-top: -8px;">
                                                <div style="color: #606265;">مدیریت ویژگی‌های کالا</div>
                                            </h2>
                                            <div style="width: 100%;margin: -7px 0px 20px 0px !important;padding: 0px !important;background: #e2dddd;
                                                height: 1px;">
                                            </div>
                                            @include('staffattribute::layouts.index-content')
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
@endsection
@section('script')
<script>

  // اضافه کردن توکن به درخواست های ایجکس
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  // ایجکس دسته‌ها
  $(document).on('change', "input[name='category']", function (e) {
      $(this).closest("div").nextAll().remove();
      $(this).closest(".c-content-categories__list").find('li').removeClass('is-active');
      $(this).closest("li").addClass("is-active");

      var categorySelected = $("input[name='category']:checked").val();

      $.ajax({
          method: "POST",
          url: '{{route('staff.types.childCatsLoader')}}',
          data: {
              id: categorySelected,
          },
          success: function (response) {
              $('#categoriesContainerContent').append(response);
          },
      });

  });

  // ایجکس breadcrumb
  $(document).on('change', "input[type='radio']", function (e) {

      var bread_id = $("input[type='radio']:checked").val();

      $.ajax({
          method: "POST",
          url: '{{route('staff.types.breadcrumbLoader')}}',
          data: {
              id: bread_id,
          },
          success: function (response) {
              $('#breadcrumbs').replaceWith(response);
          },
      });

      if ($("input[type='radio']:checked").closest('li').hasClass('has-children')){
          $(".js-continue-btn").attr("disabled", true);
          $(".js-continue-btn").addClass('disabled');
      } else {
          $(".js-continue-btn").attr("disabled", false);
          $(".js-continue-btn").removeClass('disabled');
      }

  });

  // ایجکس سرچ
  $('#searchKeyword').on('keyup', function () {

      var searchValue = $(this).val();

      if (searchValue.length > 2) {
          $.ajax({
              type: 'post',
              url: '{{route('staff.attributes.ajaxsearch')}}',
              data: {
                  'search': searchValue
              },
              success: function (response) {
                  $(".c-content-categories__wrapper").each(function () {
                      $(this).remove();
                  });
                  $('.c-content-categories__container').append(response);
              }
          });
      }

      if (searchValue.length == 0) {
          $.ajax({
              type: 'post',
              url: '{{route('staff.attributes.mainCatLoader')}}',
              success: function (response) {
                  $('.c-content-categories__wrapper').replaceWith(response);
              }
          });
      }

  });

  // ریست کامل لیست دسته‌بندی‌ها
  $(document).on('click', ".reset-box", function (e) {
      $.ajax({
          type: 'post',
          url: '{{route('staff.types.mainCatLoader')}}',
          success: function (response) {
              $('.c-content-categories__wrapper').replaceWith(response);

              var c_section = '<div class="content-section"></div>';
              $(".content-section").replaceWith(c_section);
          }
      });

      $("#categoryStepNext").addClass('disabled');
      $(".appended-box").each(function () {
          $(this).remove();
      });

  });

  $(document).on('click', "#categoryStepNext", function (e) {
      var category_id = $("input[type='radio']:checked").val();

      var disable_status = $(".js-continue-btn").attr("disabled");
      if(typeof disable_status == 'undefined')
      {
          $.ajax({
              method: "post",
              url: '{{route('staff.attributes.getData')}}',
              data: {
                  category_id: category_id,
              },
              success: function (result) {
                  $(".content-section").replaceWith(result);
              },
          });
          var selectedCat = $("input:checked[type='radio']").val();
      }
  });

  // ایجکس فرم پاپ آپ
  $('.save-btn').on('click', function (e) {
      // e.preventDefault();

      var category_id = $("input[type='radio']:checked").val();
      var name = $("input[name='attr_name']").val();
      var desc = $("textarea[name='attr_desc']").val();

      // if (name && slug && en_name) {
      $.ajax({
          method: "post",
          url: '{{route('staff.attributes.storeGroup')}}',
          data: {
              name: name,
              description: desc,
              category_id: category_id,
          },
          success: function () {
              $("input[name='attr_name']").val('');
              $("#newAttributeRequestModal").hide();
              $('#attr-group').trigger("reset");
              $('.uk-input').val('');
              $('.uk-textarea').val('');
              $('.c-header__nav').show();

              $.ajax({
                  method: "post",
                  url: '{{route('staff.attributes.getData')}}',
                  data: {
                      category_id: category_id,
                  },
                  success: function (result) {
                      $(".content-section").replaceWith(result);
                  },
              });

          },

          error: function (response) {
              //
          }
      });
      // }
  });

  $(document).on('click', '.c-mega-campaigns__btns-green-plus', function () {
      $("#newAttributeRequestModal").addClass('uk-open');
      $("#newAttributeRequestModal").css('display', 'block');
      $('.c-header__nav').hide();
  });

  $(document).on('click', '.uk-close', function () {
      $('.c-header__nav').show();
  });

  $(document).on('click', '.no', function (){
      $('.c-header__nav').show();
  });

  $(document).on('click', '.delete-btn', function () {
      var id = $(this).val();

      $(".uk-modal-container").addClass('uk-open');
      $(".uk-modal-container").css('display', 'block');

      $(document).on('click', '.yes', function (){

          $('.c-header__nav').show();

          $.ajax({
              method: 'post',
              url: "{{ route('staff.attributes.deleteGroup') }}",
              data: {
                  'id': id,
              },
              success: function (){
                  $.toast({
                      heading: 'موفق!',
                      text: "گروه با موفقیت حذف شد",
                      bgColor: '#3DC3A1',
                      textColor: '#fff',
                  });

                  var category_id = $("input[type='radio']:checked").val();

                  $.ajax({
                      method: "post",
                      url: '{{route('staff.attributes.getData')}}',
                      data: {
                          category_id: category_id,
                      },
                      success: function (result) {
                          $(".content-section").replaceWith(result);
                      },
                  });

              },
          });

      });

  });

  $(document).on('change', 'input[name="status"]', function () {
      if($(this).is(':checked'))
      {
          var status = 1;
      }
      else{
          var status = 0;
      }
      var data_group_id = $(this).attr('data-group-id');

      $.ajax({
          method: 'post',
          url: "{{ route('staff.attributes.statusGroup') }}",
          data: {
              'status': status,
              'group_id' : data_group_id,
          },
          success: function (){
              var category_id = $("input[type='radio']:checked").val();

              $.ajax({
                  method: "post",
                  url: '{{route('staff.attributes.getData')}}',
                  data: {
                      category_id: category_id,
                  },
                  success: function (result) {
                      $(".content-section").replaceWith(result);
                  },
              });
          },
      });
  });

</script>
@endsection
