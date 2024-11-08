@extends('layouts.staff.master')
@section('title') مدیریت روش‌های پرداخت | {{ $fa_store_name }}  @endsection
@section('head')
<script src="{{ asset('mehdi/staff/js/indexAction.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/tableView.js') }}"></script>
<style>
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
        <div class="c-grid " data-select2-id="13">
                <div class="c-grid__row">
                    <div class="c-grid__col">
                        <input type="hidden" value="" name="has-warehouses">
                        <div class="c-card c-card--transparent">
                            <h1 class="c-card__title c-card__title--dark c-card__title--desc">روش پرداخت
                              <span>از این بخش می‌توانید روش‌های پرداخت را مدیریت و ویرایش کنید.</span>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="js-table-container" data-select2-id="17">
                    <input name="page_type" value="index" hidden>
                    <div style="margin-top: 20px; margin-bottom: 30px;"></div>
                    <div class="c-grid__row">
                        <div class="c-grid__col">
                            <div class="c-card">
                                <div class="c-card__wrapper">
                                    <div class="c-card__header c-card__header--table">
                                        <a href="#" target="_blank">
                                        </a>

                                        <div class="c-ui-paginator js-paginator" data-select2-id="16">
                                            <div class="c-ui-paginator__total" data-rows="۶">
                                                تعداد نتایج: <span name="total" data-id="{{ $peyment_methods->total() }}">
                                                  {{ persianNum($peyment_methods->total()) }} مورد
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-card__body c-ui-table__wrapper">
                                          <table class="c-ui-table js-search-table js-table-fixed-header c-join__table"
                                            data-search-url="/ajax/product/search/">
                                              <thead>
                                              <tr class="c-ui-table__row"  style="text-align: right !important;">
                                                  <th class="c-ui-table__header">
                                                    <span class="table-header-searchable uk-text-nowrap ">
                                                        ردیف
                                                    </span>
                                                  </th>
                                                  <th class="c-ui-table__header">
                                                      <span class="table-header-searchable uk-text-nowrap ">
                                                          آیکون
                                                      </span>
                                                  </th>
                                                  <th class="c-ui-table__header">
                                                    <span class="table-header-searchable uk-text-nowrap table-header-searchable--desc">
                                                      عنوان درگاه
                                                    </span>
                                                  </th>
                                                  <th class="c-ui-table__header">
                                                    <span class="table-header-searchable uk-text-nowrap ">
                                                      توضیحات
                                                    </span>
                                                  </th>
                                                  <th class="c-ui-table__header">
                                                      <span class="table-header-searchable uk-text-nowrap ">
                                                        وضعیت
                                                      </span>
                                                  </th>
                                                  <th class="c-ui-table__header" style="text-align: center !important;">
                                                    <span class="table-header-searchable uk-text-nowrap ">
                                                      عملیات
                                                    </span>
                                                  </th>
                                              </tr>
                                              </thead>
                                              <tbody id="tbody">
                                              @if ($peyment_methods->count())
                                                @foreach($peyment_methods as $key => $peyment_method)
                                                  <tr name="row" id="{{ $peyment_method->id }}" class="c-ui-table__row c-ui-table__row--body c-join__table-row">
                                                      <td class="c-ui-table__cell" style="max-width: 10% !important; width: 10% !important;">
                                                          <span class="c-wallet__body-card-row-item">
                                                            {{ persianNum($peyment_methods->firstItem() + $key) }}
                                                          </span>
                                                      </td>
                                                    <td class="c-ui-table__cell" style="min-width: 90px">
                                                      <img src="{{ asset("mehdi/staff/images/bank/" . $peyment_method->en_name . ".png") }}"
                                                       width="85%" height="85%">
                                                    </td>
                                                    <td class="c-ui-table__cell c-ui-table__cell-desc c-ui--pt-15 c-ui--pb-15"
                                                      style="min-width: 15% !important; width: 15% !important;">
                                                        <div class="uk-flex uk-flex-column">
                                                            <a href="#">
                                                                <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                                                                  {{ $peyment_method->name }}
                                                                </span>
                                                                <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial"></span>
                                                            </a>
                                                        </div>
                                                    </td>

                                                    <td class="c-ui-table__cell c-ui-table__cell-desc c-ui--pt-15 c-ui--pb-15"
                                                      style="min-width: 50% !important; width: 50% !important;">
                                                      {{ $peyment_method->description }}
                                                    </td>

                                                    <td class="c-ui-table__cell c-ui-table__cell--small-text">
                                                      <div class="c-ui-tooltip__anchor">
                                                        <div class="c-ui-toggle__group">
                                                          <label class="c-ui-toggle">
                                                            <input class="c-ui-toggle__origin js-toggle-active-product status" type="checkbox"
                                                             data-peyment-id="{{ $peyment_method->id }}" name="status"
                                                             {{ ($peyment_method->status == 'active')? 'checked' : '' }}>
                                                            <span class="c-ui-toggle__check"></span>
                                                          </label>
                                                        </div>
                                                      </div>
                                                    </td>
                                                    <td class="c-ui-table__cell" style="max-width: 10% !important; width: 10% !important;">
                                                      <a class="c-join__btn c-join__btn--icon-right c-join__btn--icon-edit c-join__btn--secondary-greenish"
                                                       href="{{ route('staff.peyment.edit', $peyment_method->en_name) }}"
                                                       style="width: 115px !important;">ویرایش</a>
                                                    </td>
                                                  </tr>
                                              @endforeach
                                              @endif
                                              </tbody>
                                          </table>
                                      </div>

                                  <div class="c-card__footer" style="width: auto;">
                                      <div class="c-ui-paginator js-paginator" data-select2-id="25" style="visibility: hidden;"></div>
                                      <div class="c-ui-paginator js-paginator" data-select2-id="25">
                                            <div class="c-ui-paginator__total" data-rows="۶">
                                                تعداد نتایج:
                                                <span name="total" data-id="{{ $peyment_methods->total() }}">
                                                  {{ persianNum($peyment_methods->total()) }} مورد
                                                </span>
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
</main>
@endsection

@section('script')
<script>

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).on('change', 'input[name="status"]', function () {
  if ($(this).is(':checked')) {
    var status = 'active';
  } else {
    var status = 'inactive';
  }
  var peyment_id = $(this).data('peyment-id');

  $.ajax({
    method: 'post',
    url: "{{ route('staff.peyment.status') }}",
    data: {
      'status': status,
      'peyment_id': peyment_id,
    },
    success: function () {
      window.location.href = "{{ route('staff.peyment.index') }}";
    },
    error: function (errors) {
      Promotion.displayError(errors.responseJSON.data.errors);
      setTimeout(function(){
        window.location.href = "{{ route('staff.peyment.index') }}";
      }, 2000);
    }
  });

});

</script>
@endsection
