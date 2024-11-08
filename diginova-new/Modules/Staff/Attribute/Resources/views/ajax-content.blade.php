<div class="content-section">

<div class="c-promo__row--m-sm" style="width: 97%;margin: auto;margin-top: 55px !important;">
    <div class="c-join__warning-box uk-margin-remove-top">
        <p class="c-join__warning-row c-join__warning-row--has-icon">
            لطفا برای ایجاد یکپارچگی و ورود صحیح اصلاعات ابتدا تمامی
             گروه ها و زیر گروه های مدنظرتان را ایجاد کرده
              سپس بران آنها ویژگی ایجاد کنید.
        </p>
    </div>
</div>

<div class="c-grid__row">
    <div class="c-grid__col">
        <div style="width: 98%;margin: auto;margin-top: 30px;margin-left: 15px;">
            <div class="c-card__wrapper">
                <div class="c-card__header c-card__header--table">
                    <a>
                        <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">
                            ایجاد گروه ویژگی جدید
                        </div>
                    </a>

                    <div class="c-ui-paginator js-paginator">
                        <div class="c-ui-paginator__total">
                            تعداد نتایج:       
                            <span name="total" data-id="{{ $category->attributeGroups()->count() }}">
                                {{ persianNum($category->attributeGroups()->count()) }} مورد
                            </span>
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
                              <th class="c-ui-table__header">
                                <span class="table-header-searchable uk-text-nowrap "> عنوان گروه ویژگی </span>
                              </th>
                              <th class="c-ui-table__header">
                                <span class="table-header-searchable uk-text-nowrap table-header-searchable--desc"> تعداد ویژگی‌ها </span>
                              </th>
                              <th class="c-ui-table__header">
                                <span class="table-header-searchable uk-text-nowrap "> توضیحات گروه ویژگی</span>
                              </th>
                              <th class="c-ui-table__header">
                                <span class="table-header-searchable uk-text-nowrap "> فعال / غیرفعال </span>
                              </th>
                              <th class="c-ui-table__header">
                                <span class="table-header-searchable uk-text-nowrap ">عملیات</span>
                              </th>
                          </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach($category->attributeGroups()->orderBy('position', 'asc')->get() as $attrGroup)
                                <tr name="row" id="item-{{$attrGroup->id}}" class="c-ui-table__row c-ui-table__row--body c-join__table-row">
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
                                                <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                                                    {{ $attrGroup->name }}
                                                </span>
                                                <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial"></span>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="c-ui-table__cell">
                                        {{ (count($attrGroup->attributes))? persianNum(count($attrGroup->attributes)) : persianNum(0) }}
                                    </td>
                                    <td class="c-ui-table__cell">
                                        {{ ($attrGroup->description)? $attrGroup->description : '' }}
                                    </td>
                                    <td class="c-ui-table__cell c-ui-table__cell--small-text">
                                        <div class="c-ui-tooltip__anchor">
                                            <div class="c-ui-toggle__group">
                                                <label class="c-ui-toggle">
                                                    <input class="c-ui-toggle__origin js-toggle-active-product"
                                                         type="checkbox" data-group-id="{{ $attrGroup->id }}"
                                                         name="status" {{ ($attrGroup->status)? 'checked' : '' }}>
                                                    <span class="c-ui-toggle__check"></span>
                                                </label>
                                            </div>
                                            <input type="hidden" value="0" class="js-active-input">
                                        </div>
                                    </td>

                                    <td class="c-ui-table__cell">
                                        <div class="c-promo__actions">
                                            <a class="c-join__btn c-join__btn--icon-right c-join__btn--icon-edit c-join__btn--secondary-greenish"
                                                 href="{{ route('staff.attributes.edit', $attrGroup->id) }}">
                                                 ویرایش
                                            </a>
                                            <button class="c-join__btn c-join__btn--icon-right c-join__btn--icon-delete 
                                                c-join__btn--primary js-remove-plp js-remove-product-list delete-btn"
                                                  value="{{ $attrGroup->id }}">حذف</button></button>
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
                            ایجاد گروه ویژگی جدید
                        </div>
                    </a>

                    <div class="c-ui-paginator js-paginator">
                        <div class="c-ui-paginator__total">
                            تعداد نتایج: 
                            <span name="total" data-id="{{ $category->attributeGroups()->count() }}">
                                {{ persianNum($category->attributeGroups()->count()) }} مورد
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<script>
    $('tbody').sortable({
    group: 'no-drop',
    handle: '.c-content-upload__drag-handler',
    connectWith: 'tbody',
    scroll: false,
    containment: 'tbody',
    axis: 'y',
    update: function (event, ui) {
        var data = $("tbody").sortable('serialize');
        $.ajax({
            data: data,
            type: 'post',
            url: '{{route('staff.attributes.indexChangePosition')}}'
        });
    }
});
</script>
