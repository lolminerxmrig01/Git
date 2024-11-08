@extends('layouts.staff.master')
@section('title') مدیریت جایگاه | {{ $fa_store_name }}  @endsection
@section('head')
<script src="{{ asset('mehdi/staff/js/indexAction.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/tableView.js') }}"></script>
@endsection
@section('content')
<main class="c-main">
    <div class="uk-container uk-container-large">
        <div class="c-grid ">
            <div class="c-grid__row">
                <div class="c-grid__col">
                    <input type="hidden" value="" name="has-warehouses">
                    <div class="c-card c-card--transparent">
                        <h1 class="c-card__title c-card__title--dark c-card__title--desc">
                          مدیریت جایگاه
                          <span>جایگاه را انتخاب کرده و فهرست‌های آن را مدیریت کنید</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="js-table-container" >
                <input name="page_type" value="index" hidden>
                <div style="margin-top: 20px; margin-bottom: 30px;"></div>
                <div class="c-grid__row">
                    <div class="c-grid__col">
                        <div class="c-card">
                            <div class="c-card__wrapper">
                                <div class="c-card__header c-card__header--table">
                                    <a href="#" target="_blank">
                                    </a>
                                    <div class="c-ui-paginator js-paginator" >
                                        <div class="c-ui-paginator__total" data-rows="۶">
                                            تعداد نتایج: <span name="total" data-id="{{ $nav_locations->total() }}">{{ persianNum($nav_locations->total()) }} مورد</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-card__body c-ui-table__wrapper">
                                      <table class="c-ui-table js-search-table js-table-fixed-header c-join__table" data-search-url="/ajax/product/search/">
                                          <thead>
                                          <tr class="c-ui-table__row"  style="text-align: right !important;">
                                              <th class="c-ui-table__header">
                                                <span class="table-header-searchable uk-text-nowrap ">
                                                    ردیف
                                                </span>
                                              </th>
                                              <th class="c-ui-table__header">
                                                <span class="table-header-searchable uk-text-nowrap table-header-searchable--desc">
                                                  عنوان جایگاه
                                                </span>
                                              </th>
                                              <th class="c-ui-table__header">
                                                <span class="table-header-searchable uk-text-nowrap ">
                                                  وضعیت
                                                </span>
                                              </th>
                                              <th class="c-ui-table__header">
                                                <span class="table-header-searchable uk-text-nowrap ">
                                                  عملیات
                                                </span>
                                              </th>
                                          </tr>
                                          </thead>
                                          <tbody id="tbody">
                                          @if ($nav_locations->count())
                                            @foreach($nav_locations as $key => $nav_location)
                                              <tr name="row" id="{{$nav_location->id}}" class="c-ui-table__row c-ui-table__row--body c-join__table-row">
                                                  <td class="c-ui-table__cell" style="max-width: 10% !important; width: 10% !important;">
                                                      <span class="c-wallet__body-card-row-item"> {{ persianNum($nav_locations->firstItem() + $key) }} </span>
                                                  </td>
                                                  <td class="c-ui-table__cell c-ui-table__cell-desc c-ui--pt-15 c-ui--pb-15" style="min-width: 50% !important; width: 50% !important;">
                                                      <div class="uk-flex uk-flex-column">
                                                          <a href="#">
                                                              <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                                                              {{ $nav_location->name }}
                                                              </span>
                                                              <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial"></span>
                                                          </a>
                                                      </div>
                                                  </td>

                                                <td class="c-ui-table__cell c-ui-table__cell--small-text">
                                                  <div class="c-ui-tooltip__anchor">
                                                    <div class="c-ui-toggle__group">
                                                      <label class="c-ui-toggle">
                                                        <input class="c-ui-toggle__origin js-toggle-active-product status" type="checkbox" name="status" {{ ($nav_location->status == 'active')? 'checked' : '' }} disabled>
                                                        <span class="c-ui-toggle__check"></span>
                                                      </label>
                                                    </div>
                                                  </div>
                                                </td>
                                                  <td class="c-ui-table__cell" style="max-width: 10% !important; width: 10% !important;">
                                                    <a class="c-join__btn c-join__btn--icon-right c-join__btn--secondary-greenish" href="{{ route('staff.navs.navs', $nav_location->id) }}" style="width: 120px;">مدیریت فهرست‌ها</a>
                                                  </td>
                                              </tr>
                                          @endforeach
                                          @endif

                                          </tbody>
                                      </table>
                                  </div>

                              <div class="c-card__footer" style="width: auto;">
                                  <div class="c-ui-paginator js-paginator"  style="visibility: hidden;"></div>
                                  <div class="c-ui-paginator js-paginator" >
                                        <div class="c-ui-paginator__total" data-rows="۶">
                                            تعداد نتایج: <span name="total" data-id="{{ $nav_locations->total() }}">{{ persianNum($nav_locations->total()) }} مورد</span>
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
