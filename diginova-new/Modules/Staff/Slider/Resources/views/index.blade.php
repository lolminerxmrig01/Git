@extends('layouts.staff.master')
@section('title') مدیریت اسلایدرها | {{ $fa_store_name }}  @endsection
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
                            مدیریت اسلایدرها
                            <span>
                                از این صفحه می‌توانید اسلایدرها را مدیریت کنید
                            </span>
                        </h1>
                    </div>
                </div>
            </div>
            @if ($slider_groups->count())
                <div class="js-table-container">
                    <input name="page_type" value="index" hidden>
                    <div style="margin-top: 20px; margin-bottom: 30px;"></div>
                    <div class="c-grid__row">
                        <div class="c-grid__col">
                            <div class="c-card">
                                <div class="c-card__wrapper">
                                    <div class="c-card__header c-card__header--table">
                                        <div class="c-join__btn c-join__btn--icon-right " style="padding-right: 15px; padding-left: 15px !important;"></div>

                                        <div class="c-ui-paginator js-paginator">
                                            <div class="c-ui-paginator__total" data-rows="۶">
                                                تعداد نتایج: <span name="total" data-id="{{ $slider_groups->total() }}">{{ persianNum($slider_groups->total()) }} مورد</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-card__body c-ui-table__wrapper">
                                        <table class="c-ui-table js-search-table js-table-fixed-header c-join__table" data-search-url="/ajax/product/search/">
                                            <thead>
                                            <tr class="c-ui-table__row"  style="text-align: right !important;">
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap "> ردیف </span>
                                                </th>
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap table-header-searchable--desc">راهنما</span>
                                                </th>
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap ">عنوان بنر/اسلایدر</span>
                                                </th>
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap ">موقعیت در صفحه</span>
                                                </th>
                                                <th class="c-ui-table__header"><span
                                                    class="table-header-searchable uk-text-nowrap ">نام دسته</span>
                                                </th>
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap ">عملیات</span>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbody">
                                            @foreach($slider_groups as $key => $slider_group)
                                                <tr name="row" id="{{$slider_group->id}}" class="c-ui-table__row c-ui-table__row--body c-join__table-row">
                                                    <td class="c-ui-table__cell" style="max-width: 10% !important; width: 10% !important;">
                                                        <span class="c-wallet__body-card-row-item"> {{ persianNum($slider_groups->firstItem() + $key) }} </span>
                                                    </td>
                                                    <td class="c-ui-table__cell" style="max-width: 10% !important; width: 10% !important;">
                                                        @if($slider_group->id == 1)
                                                          <img src="{{ asset('mehdi/staff/images/slider/Home1.png') }}" width="85%" height="85%">
                                                        @elseif(!is_null($slider_group->category_id))
                                                          <img src="{{ asset('mehdi/staff/images/slider/Main.png') }}" width="85%" height="85%">
                                                        @elseif($slider_group->id == 2)
                                                          <img src="{{ asset('mehdi/staff/images/slider/Home2.png') }}" width="85%" height="85%">
                                                        @endif
                                                    </td>
                                                    <td class="c-ui-table__cell c-ui-table__cell-desc c-ui--pt-15 c-ui--pb-15"
                                                        style="min-width: 50% !important; width: 50% !important;">
                                                        <div class="uk-flex uk-flex-column">
                                                            <a href="#">
                                                                <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                                                                {{ $slider_group->name }}
                                                                </span>
                                                                <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial"></span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td class="c-ui-table__cell c-ui-table__cell--text-blue" style="width: 35% !important;">
                                                      @if(!is_null($slider_group->category_id))
                                                        <a class="c-join__promotion-link" href="{{ $site_url . '/main/' .  $slider_group->category->slug }}" target="_blank">{{ $site_url . '/main/' .  $slider_group->category->slug }}</a>
                                                      @else
                                                        <a class="c-join__promotion-link" href="{{ $site_url }}" target="_blank">{{ $site_url }}</a>
                                                      @endif
                                                    </td>
                                                    <td class="c-ui-table__cell" style="min-width: 130px !important; !important; width: 130px !important;">
                                                      @if(!is_null($slider_group->category_id))
                                                        {{ $slider_group->category->name }}
                                                      @else
                                                        __
                                                      @endif
                                                    </td>
                                                    <td class="c-ui-table__cell" style="max-width: 10% !important; width: 10% !important;">
                                                      <a class="c-join__btn c-join__btn--icon-right c-join__btn--secondary-greenish"
                                                       href="{{ route('staff.sliders.sliders', $slider_group->id) }}" style="width: 120px;">مدیریت لیست</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="c-card__footer" style="width: auto;">
                                      <div class="c-ui-paginator js-paginator" style="visibility: hidden;"></div>
                                      <div class="c-ui-paginator js-paginator">
                                            <div class="c-ui-paginator__total" data-rows="۶">
                                                تعداد نتایج: <span name="total" data-id="{{ $slider_groups->total() }}">
                                                    {{ persianNum($slider_groups->total()) }} مورد
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection
