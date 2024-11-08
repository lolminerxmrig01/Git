<div class="content-section">
    <div class="c-grid__row">
        <div class="c-grid__col">
            <div class="c-card" data-select2-id="136">
                <div class="c-grid__col">
                    <div class="product-form">
                        <div class="c-grid__row">
                            <div class="c-card">
                                <div class="c-card__wrapper">
                                    <div class="c-card__header c-card__header--table">
                                        <a>
                                            <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">
                                                ایجاد گروه تنوع جدید
                                            </div>
                                        </a>
                                        <div class="c-ui-paginator js-paginator" data-select2-id="16">
                                            <div class="c-ui-paginator__total" data-rows="۶">
                                                تعداد نتایج: <span name="total" data-id="{{ $variant_groups->count() }}">{{ persianNum($variant_groups->count()) }} مورد</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-card__body c-ui-table__wrapper">
                                        <table class="c-ui-table js-search-table js-table-fixed-header c-join__table" >
                                            <thead>
                                            <tr class="c-ui-table__row">
                                                <th class="c-ui-table__header">
                                                    <span class="table-header-searchable uk-text-nowrap "></span>
                                                </th>
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap "> عنوان گروه تنوع </span>
                                                </th>
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap table-header-searchable--desc"> تعداد تنوع‌ها </span>
                                                </th>
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap "> توضیحات گروه تنوع</span>
                                                </th>

                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap "> فعال / غیرفعال </span>
                                                </th>
                                                <th class="c-ui-table__header"><span
                                                        class="table-header-searchable uk-text-nowrap ">عملیات</span>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbody">
                                            @foreach($variant_groups as $variantGroup)
                                                <tr name="row" id="item-{{$variantGroup->id}}" class="c-ui-table__row c-ui-table__row--body c-join__table-row">
                                                    <td class="c-ui-table__cell" style="padding-right: 0px; padding-left: 23px;">
                                                        <div class="c-content-upload__drag-handler c-content-upload__drag-handler--outer">
                                                            <span class="c-content-upload__drag-handler c-content-upload__drag-handler--up js-sort-up"></span>
                                                            <span class="c-content-upload__drag-handler c-content-upload__drag-handler--bg"></span>
                                                            <span class="c-content-upload__drag-handler c-content-upload__drag-handler--down js-sort-down"></span>
                                                        </div>
                                                    </td>
                                                    <td class="c-ui-table__cell c-ui-table__cell-desc c-ui--pt-15 c-ui--pb-15" style="min-width: 90px">
                                                        <div class="uk-flex uk-flex-column">
                                                            <a href="#" target="_blank">
                                                                <span
                                                                    class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                                                                {{ $variantGroup->name }}
                                                                </span>
                                                                <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial"></span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td class="c-ui-table__cell">
                                                        {{ (isset($variantGroup->variants) && count($variantGroup->variants))? persianNum(count($variantGroup->variants)) : persianNum(0) }}
                                                    </td>
                                                    <td class="c-ui-table__cell">
                                                        {{ ($variantGroup->description)? $variantGroup->description : '' }}
                                                    </td>
                                                    <td class="c-ui-table__cell c-ui-table__cell--small-text">
                                                        <div class="c-ui-tooltip__anchor">
                                                            <div class="c-ui-toggle__group">
                                                                <label class="c-ui-toggle">
                                                                    <input class="c-ui-toggle__origin js-toggle-active-product" type="checkbox" data-group-id="{{ $variantGroup->id }}" name="status" {{ ($variantGroup->status)? 'checked' : '' }}>
                                                                    <span class="c-ui-toggle__check"></span>
                                                                </label>
                                                            </div>

                                                            <input type="hidden" value="0" class="js-active-input">
                                                        </div>
                                                    </td>

                                                    <td class="c-ui-table__cell">
                                                        <div class="c-promo__actions">
                                                            <a class="c-join__btn c-join__btn--icon-right c-join__btn--icon-edit
                                            c-join__btn--secondary-greenish" href="{{ route('staff.variants.edit', $variantGroup->id) }}">ویرایش</a>
                                                            <button class="c-join__btn c-join__btn--icon-right c-join__btn--icon-delete
                                            c-join__btn--primary js-remove-plp js-remove-product-list delete-btn"
                                                                    value="{{ $variantGroup->id }}" {{ ($variantGroup->type == 0)? 'disabled' : '' }}>حذف</button>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="c-card__footer" style="width: auto;">
                                        <a>
                                            <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">
                                                ایجاد گروه تنوع جدید
                                            </div>
                                        </a>

                                        <div class="c-ui-paginator js-paginator" data-select2-id="25">
                                            <div class="c-ui-paginator__total" data-rows="۶">
                                                تعداد نتایج: <span name="total" data-id="{{ $variant_groups->count() }}">{{ persianNum($variant_groups->count()) }} مورد</span>
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
    </div>
</div>
