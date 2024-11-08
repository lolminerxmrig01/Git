<div class="c-product-list__alert c-ui--mt-25 c-ui--mb-25">
  لازم به ذکر است به ازای هر ۱۳ منو یک ستون اضافه خواهد شد، بدین صورت منوهای ایجاد شده پشت سرهم قرار می‌گیرند. حداکثر منوی قابل ایجاد ۵۲ عدد است.
</div>

<div class="c-grid__row" style="margin-top:30px">
    <div class="c-grid__col">
    <div class="c-card">
      <div class="c-card__wrapper">
        <div class="c-card__header c-card__header--table">
          <a target="_blank">
            <div class="c-mega-campaigns__btns-green-plus uk-margin-remove add-menu">
                ایجاد منو جدید
            </div>
          </a>
          <div class="c-ui-paginator js-paginator" data-select2-id="25" style="visibility: hidden;"></div>
        </div>
        <div class="c-card__body c-ui-table__wrapper">
          <table class="c-ui-table  js-search-table js-table-fixed-header c-join__table">
            <thead>
            <tr class="c-ui-table__row">
              <th class="c-ui-table__header">
                <span class="table-header-searchable uk-text-nowrap "></span>
              </th>
              <th class="c-ui-table__header">
                <span class="table-header-searchable uk-text-nowrap table-header-searchable--desc">عنوان</span>
              </th>
              <th class="c-ui-table__header">
                <span class="table-header-searchable uk-text-nowrap ">درون استانی</span>
              </th>
              <th class="c-ui-table__header">
                <span class="table-header-searchable uk-text-nowrap ">استان همجوار</span>
              </th>
              <th class="c-ui-table__header">
                <span class="table-header-searchable uk-text-nowrap ">برون استانی</span>
              </th>
            </tr>
            </thead>
            <tbody id="tbody">
            @php
              $i = 1;
            @endphp
            @if(count($items))
              @foreach($items->sortBy('position') as $key => $item)
                <tr name="row db-row" id="item-{{ $item->id }}" data-id="{{ $item->id }}" class="c-ui-table__row c-ui-table__row--body c-join__table-row row db-row">
                  <td class="c-ui-table__cell c-ui-table__cell--small-text">
                      {{ persianNum($key+1) }}
                  </td>

                  <td class="c-ui-table__cell c-ui-table__cell--small-text" style="text-align: center; min-width: 200px;">
                      <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                        <input type="text" class="c-content-input__origin c-content-input__origin menu_name" name="menu_name" value="{{ $item->name }}" dir="rtl" style="text-align: right;">
                      </span>
                  </td>

                  <td class="c-ui-table__cell c-ui-table__cell--small-text" style="text-align: center; min-width: 200px;">
                      <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                        <input type="text" class="c-content-input__origin c-content-input__origin menu_link" name="menu_link" value="{{ $item->link }}" dir="rtl" style="text-align: right;">
                      </span>
                  </td>

                  <td class="c-ui-table__cell c-ui-table__cell--small-text">
                    <div class="c-ui-tooltip__anchor">
                      <div class="c-ui-toggle__group">
                        <label class="c-ui-toggle">
                          <input class="c-ui-toggle__origin js-toggle-active-product" type="checkbox" name="menu_style" {{ ($item->style == 'bold')? 'checked' : '' }} data-item-id="{{$item->id}}">
                          <span class="c-ui-toggle__check"></span>
                        </label>
                      </div>
                    </div>
                  </td>

                  <td class="c-ui-table__cell">
                    <div class="c-promo__actions">
                      <button class="c-join__btn c-join__btn--icon-right c-join__btn--icon-delete c-join__btn--primary js-remove-plp js-remove-product-list delete-btn" value="{{ $item->id }}">حذف</button>
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
            <div class="c-mega-campaigns__btns-green-plus uk-margin-remove add-menu">
                ایجاد منو جدید
            </div>
          </a>

          <div class="c-ui-paginator js-paginator" data-select2-id="25" style="visibility: hidden;"></div>

        </div>
      </div>

    </div>
  </div>

  <div class="c-grid__col" style="padding-left: 0px; padding-right: 0px; margin-top: 25px !important;">
    <div class="c-grid__col">
      <div class="c-card">
        <div class="edit-form-section c-card__footer c-card__footer--products">
          <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6 c-grid__col--xs-gap" style="width: 40%; float: left; display: contents;">
            <a class="c-ui-btn c-ui-btn--next mr-a" style="margin-left: 68px;max-width: 100px;" id="save-menus">ذخیره</a>
          </div>
        </div>
      </div>
    </div>

</div>
</div>
