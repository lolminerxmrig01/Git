<div class="js-table-container" data-select2-id="17">
    <div style="margin-top: 20px; margin-bottom: 20px;"></div>
    <div class="c-grid__row">
        <div class="c-grid__col">
            <div class="c-card">
                <div class="c-card__wrapper">
                    <div class="c-card__header c-card__header--table">
                        <div class="c-grid__col c-grid__col--lg-4">
                            <a href="{{ route('staff.brands.index') }}" class="c-ui-btn js-view-all-orders">بازگشت به صفحه مدیریت برندها</a>
                        </div>

                        {{--                                        {{ $brands->links('staffbrand::layouts.pagination.pagination') }}--}}

                        <div class="c-ui-paginator js-paginator" data-select2-id="16">
                            <div class="c-ui-paginator__total" data-rows="۶">
                                تعداد نتایج: <span name="total" data-id="{{ $brands->total() }}">{{ persianNum($brands->total()) }} مورد</span>
                            </div>
                            {{--                                            <div class="c-ui-paginator__select" data-select2-id="15">--}}
                            {{--                                                <div class="c-ui-paginator__select-label">تعداد نمایش</div>--}}
                            {{--                                                <div class="c-ui-paginator__select-pages">--}}
                            {{--                                                    <div class="field-wrapper ui-select ui-select__container">--}}

                            {{--                                                        <select class="c-ui-select c-ui-select--common c-ui-select--small--}}
                            {{--                                                        select2-hidden-accessible paginator-selected"--}}
                            {{--                                                            name="paginator-select-pages" tabindex="-1" id="paginator-top" aria-hidden="true">--}}
                            {{--                                                            <option value="10">۱۰</option>--}}
                            {{--                                                            <option value="20">۲۰</option>--}}
                            {{--                                                            <option value="50">۵۰</option>--}}
                            {{--                                                            <option value="100">۱۰۰</option>--}}
                            {{--                                                        </select>--}}

                            {{--                                                        <div class="js-select-options c-ui-paginator__dropdown-container"></div>--}}
                            {{--                                                    </div>--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                        </div>
                    </div>
                    <div class="c-card__body c-ui-table__wrapper">
                        <table class="c-ui-table js-search-table js-table-fixed-header c-join__table"
                               data-search-url="/ajax/product/search/">
                            <thead>
                            <tr class="c-ui-table__row">
                                <th class="c-ui-table__header"><span
                                        class="table-header-searchable uk-text-nowrap "> ردیف </span>
                                </th>
                                <th class="c-ui-table__header"><span
                                        class="table-header-searchable uk-text-nowrap ">لوگو برند</span>
                                </th>
                                <th class="c-ui-table__header"><span
                                        class="table-header-searchable uk-text-nowrap table-header-searchable--desc">نام برند</span>
                                </th>
                                <th class="c-ui-table__header"><span
                                        class="table-header-searchable uk-text-nowrap "> گروه کالایی </span>
                                </th>
                                <th class="c-ui-table__header"><span
                                        class="table-header-searchable uk-text-nowrap ">تعداد کالا</span>
                                </th>
                                <th class="c-ui-table__header"><span
                                        class="table-header-searchable uk-text-nowrap ">عملیات</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody id="tbody">
                            @foreach($brands as $key => $brand)
                                <tr name="row" id="{{$brand->id}}" class="c-ui-table__row c-ui-table__row--body c-join__table-row">
                                    <td class="c-ui-table__cell">
                                        <span class="c-wallet__body-card-row-item"> {{ persianNum($brands->firstItem() + $key) }} </span>
                                    </td>
                                    <td class="c-ui-table__cell" style="min-width: 90px">
                                        @if(count($brand->media))
                                            <img src="{{ $site_url . '/' . $brand->media()->first()->path . '/'.$brand->media()->first()->name }}" width="65" height="65">
                                        @endif
                                    </td>
                                    <td class="c-ui-table__cell c-ui-table__cell-desc c-ui--pt-15 c-ui--pb-15">
                                        <div class="uk-flex uk-flex-column">
                                            <a href="#" target="_blank">
                                                                <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                                                                {{ $brand->name }}
                                                                    @if($brand->type == 1)
                                                                        <span style="color: red; font-size: 11px;"> (ویژه) </span>
                                                                    @endif
                                                                </span>
                                                <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial"></span>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="c-ui-table__cell">
                                        <a href="#">
                                            <div class="uk-flex uk-flex-column">
                                                                  <span class="c- -card-row-item" style="line-height: 23px;">
                                                                      @foreach($brand->categories as $category)
                                                                          {{ $category->name }}&nbsp;<br>
                                                                      @endforeach
                                                                  </span>
                                            </div>
                                        </a>
                                    </td>

                                    <td class="c-ui-table__cell"><span class="c-wallet__body-card-row-item"> ۱ </span>
                                    </td>

                                    <td class="c-ui-table__cell">
                                        <div class="c-promo__actions">

                                            <button class="c-join__btn c-join__btn--icon-right c-join__btn--secondary-greenish restore-btn"
                                                    value="{{ $brand->id }}">بازگردانی</button>

                                            <button class="c-join__btn c-join__btn--icon-right c-join__btn--icon-delete
                                                              c-join__btn--primary js-remove-plp js-remove-product-list delete-btn"
                                                    value="{{ $brand->id }}">حذف کامل</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @include('staffbrand::layouts.modal')
                            </tbody>
                        </table>
                    </div>
                    <div class="c-card__footer" style="width: auto;">
                        <a href="{{ route('staff.brands.index') }}" class="c-ui-btn js-view-all-orders">بازگشت به صفحه مدیریت برندها</a>

                        {{ $brands->links('staffbrand::layouts.pagination.pagination') }}
                        <div class="c-ui-paginator js-paginator" data-select2-id="25">
                            <div class="c-ui-paginator__total" data-rows="۶">
                                تعداد نتایج: <span name="total" data-id="{{ $brands->total() }}">{{ persianNum($brands->total()) }} مورد</span>
                            </div>
                            {{--                                            <div class="c-ui-paginator__select" data-select2-id="24">--}}
                            {{--                                                <div class="c-ui-paginator__select-label">تعداد نمایش</div>--}}
                            {{--                                                <div class="c-ui-paginator__select-pages">--}}
                            {{--                                                    <div class="field-wrapper ui-select ui-select__container">--}}

                            {{--                                                        <select class="c-ui-select c-ui-select--common c-ui-select--small--}}
                            {{--                                                         select2-hidden-accessible paginator-selected"--}}
                            {{--                                                            name="paginator-select-pages" id="paginator-bottom"--}}
                            {{--                                                            tabindex="-1" aria-hidden="true">--}}
                            {{--                                                            <option value="10">۱۰</option>--}}
                            {{--                                                            <option value="20">۲۰</option>--}}
                            {{--                                                            <option value="50">۵۰</option>--}}
                            {{--                                                            <option value="100">۱۰۰</option>--}}
                            {{--                                                        </select>--}}


                            {{--                                                        <div class="js-select-options c-ui-paginator__dropdown-container"></div>--}}
                            {{--                                                    </div>--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
