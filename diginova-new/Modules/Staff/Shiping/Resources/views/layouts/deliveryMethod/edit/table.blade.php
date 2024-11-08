  <div class="c-grid__row" style="margin-top:30px">
    <div class="c-grid__col">
    <div class="c-card">
      <div class="c-card__wrapper">

        <div class="c-card__header c-card__header--table">
          <div class="c-ui-paginator js-paginator" style="visibility: hidden;"></div>
          <div class="c-ui-paginator js-paginator">
            <div class="c-ui-paginator__total">
              تعداد نتایج: <span name="total">{{ persianNum($values->total()) }} مورد</span>
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

              @if(count($values))
                @foreach($values as $key => $item)
                   <tr name="row db-row" id="item-{{ $item->id }}" data-id="{{ $item->id }}" class="c-ui-table__row c-ui-table__row--body c-join__table-row row db-row">

                    <td class="c-ui-table__cell" style="max-width: 7% !important; width: 7% !important;">
                      <span class="c-wallet__body-card-row-item"> {{ persianNum($values->firstItem() + $key) }} </span>
                    </td>


                    <td class="c-ui-table__cell c-ui-table__cell--small-text">
                        <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                          {{ $item->name }}
                        </span>
                    </td>

                    @if($item->type == 'single')

                    <td class="c-ui-table__cell c-ui-table__cell--small-text" style="text-align: center; min-width: 200px;">
                        <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                          <input type="text" class="c-content-input__origin c-content-input__origin menu_link" name="intra_province" value="{{ $item->intra_province }}" dir="rtl" style="text-align: right;">
                        </span>
                    </td>

                    <td class="c-ui-table__cell c-ui-table__cell--small-text" style="text-align: center; min-width: 200px;">
                        <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                          <input type="text" class="c-content-input__origin c-content-input__origin menu_link" name="neighboring_provinces" value="{{ $item->neighboring_provinces }}" dir="rtl" style="text-align: right;">
                        </span>
                    </td>


                    <td class="c-ui-table__cell c-ui-table__cell--small-text" style="text-align: center; min-width: 200px;">
                        <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                          <input type="text" class="c-content-input__origin c-content-input__origin menu_link" name="extra_province" value="{{ $item->extra_province }}" dir="rtl" style="text-align: right;">
                        </span>
                    </td>

                    @elseif($item->type == 'multi')
                      <td class="c-ui-table__cell c-ui-table__cell--small-text" style="text-align: center; min-width: 200px;" colspan="3">
                        <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                          <input type="text" class="c-content-input__origin c-content-input__origin menu_link" name="intra_province" value="{{ $item->intra_province }}" dir="rtl" style="text-align: right;">
                        </span>
                      </td>
                    @endif

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
              تعداد نتایج: <span name="total" data-id="2">{{ persianNum($values->total()) }} مورد</span>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>

  <div class="c-grid__col" style="padding-left: 0px; padding-right: 0px; margin-top: 25px !important;">
    <div class="c-grid__col">
      <div class="c-card">
        <div class="edit-form-section c-card__footer c-card__footer--products">
          <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-6 c-grid__col--xs-gap" style="width: 40%; float: left; display: contents;">
            <a class="c-ui-btn c-ui-btn--next mr-a save-form" style="margin-left: 68px;max-width: 100px;" data-value="all">ذخیره</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
