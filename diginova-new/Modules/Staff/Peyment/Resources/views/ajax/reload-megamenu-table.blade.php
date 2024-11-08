<div class="content-section">
  <div class="c-grid__row" style="margin-top:30px">
    <div class="c-grid__col">
      <div class="c-card">
        <div class="c-card__wrapper">
          <div class="c-card__header c-card__header--table">
            <a target="_blank">
              <div class="c-mega-campaigns__btns-green-plus uk-margin-remove add-megamenu">
                  ایجاد مگامنو جدید
              </div>
            </a>
            <div class="c-ui-paginator js-paginator"  style="visibility: hidden;"></div>
            <div class="c-ui-paginator js-paginator">
              <div class="c-ui-paginator__total" data-rows="۶">
                تعداد نتایج: <span name="total" data-id="5">{{ persianNum($items->total()) }} مورد</span>
              </div>
            </div>
          </div>
          <div class="c-card__body c-ui-table__wrapper">
            <table class="c-ui-table  js-search-table js-table-fixed-header c-join__table">
              <thead>
              <tr class="c-ui-table__row">
                <th class="c-ui-table__header">
                  <span class="table-header-searchable uk-text-nowrap "></span>
                </th>
                <th class="c-ui-table__header">
                  <span class="table-header-searchable uk-text-nowrap table-header-searchable--desc">عنوان منو</span>
                </th>
                <th class="c-ui-table__header">
                  <span class="table-header-searchable uk-text-nowrap ">لینک به آدرس</span>
                </th>
                <th class="c-ui-table__header"><span
                    class="table-header-searchable uk-text-nowrap ">وضعیت</span>
                </th>
                <th class="c-ui-table__header" style="max-width: 20% !important; width: 20% !important;">
                  <span class="table-header-searchable uk-text-nowrap ">عملیات</span>
                </th>
              </tr>
              </thead>
              <tbody id="tbody">
              @php
                $i = 1;
              @endphp
              @if(count($items))
                @foreach($items->sortBy('position') as $key => $item)
                  <tr name="row db-row" id="item-{{ $item->id }}" data-id="{{ $item->id }}"
                   class="c-ui-table__row c-ui-table__row--body c-join__table-row row db-row">
                    <td class="c-ui-table__cell" style="padding-right: 0px; padding-left: 23px;">
                      <div class="c-content-upload__drag-handler c-content-upload__drag-handler--outer">
                        <span class="c-content-upload__drag-handler c-content-upload__drag-handler--up js-sort-up"></span>
                        <span class="c-content-upload__drag-handler c-content-upload__drag-handler--bg"></span>
                        <span class="c-content-upload__drag-handler c-content-upload__drag-handler--down js-sort-down"></span>
                      </div>
                    </td>

                    <td class="c-ui-table__cell c-ui-table__cell--small-text" style="text-align: center; min-width: 200px;">
                      <span class="c-wallet__body-card-row-item c-ui--fit c-ui--initial">
                          {{ $item->name }}
                      </span>
                    </td>

                    <td class="c-ui-table__cell c-ui-table__cell--text-blue">
                      @if(!is_null($item->link))
                        <a class="c-join__promotion-link" href="" target="_blank" style="font-weight: bold">{{ $item->link }}</a>
                        <a class="c-join__promotion-copy-btn js-copy-btn" href="#" data-link="{{ $item->link }}">کپی لینک</a>
                      @endif
                    </td>

                    <td class="c-ui-table__cell c-ui-table__cell--small-text">
                      <div class="c-ui-tooltip__anchor">
                        <div class="c-ui-toggle__group">
                          <label class="c-ui-toggle">
                            <input class="c-ui-toggle__origin js-toggle-active-product" type="checkbox" name="status" {{ ($item->status == 'active')? 'checked' : '' }} data-item-id="{{$item->id}}">
                            <span class="c-ui-toggle__check"></span>
                          </label>
                        </div>

                        <input type="hidden" value="0" class="js-active-input">
                      </div>
                    </td>


                    <td class="c-ui-table__cell">
                      <div class="c-promo__actions">
                        <a class="c-join__btn c-join__btn--secondary-greenish" href="{{ route('staff.navs.megamenuItems', $item->id) }}">ویرایش منو</a>
                        <button class="c-join__btn c-join__btn--icon-right c-join__btn--icon-delete c-join__btn--primary js-remove-plp js-remove-product-list delete-btn" value="{{ $item->id }}">حذف</button>
                      </div>

                      <div uk-modal="esc-close: true; bg-close: true;" class="uk-modal-container uk-modal-container--message js-common-modal-notification" style="display: none;">
                        <div class="uk-modal-dialog uk-modal-dialog--flex">
                          <button class="uk-modal-close-default uk-close uk-icon" type="button" uk-close=""></button>

                          <div class="uk-modal-body">
                            <div class="c-modal-notification">
                              <div class="c-modal-notification__content c-modal-notification__content--limited">
                                <h2 class="c-modal-notification__header">
                                  هشدار</h2>

                                <p class="c-modal-notification__text">
                                  با حذف این مگامنو، تمامی منو های آن حذف خواهد شد. آیا از حذف آن اطمینان دارید؟
                                </p>
                                <div class="c-modal-notification__actions">
                                  <button class="c-modal-notification__btn no uk-modal-close">
                                    خیر
                                  </button>
                                  <button class="c-modal-notification__btn c-modal-notification__btn--secondary yes uk-modal-close">
                                    بله
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
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
              <div class="c-mega-campaigns__btns-green-plus uk-margin-remove add-megamenu">
                  ایجاد مگامنو جدید
              </div>
            </a>

            <div class="c-ui-paginator js-paginator"  style="visibility: hidden;"></div>

            <div class="c-ui-paginator js-paginator">
              <div class="c-ui-paginator__total" data-rows="۶">
                تعداد نتایج: <span name="total" data-id="2">{{ persianNum($items->total()) }} مورد</span>
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
    handle: '.c-content-upload__drag-handler',
    axis: 'y',
    update: function (event, ui) {
      var data = $("tbody").sortable('serialize');
      $.ajax({
        data: data,
        type: 'post',
        url: '{{route('staff.navs.navChangePosition')}}',
      })
    }
  });
</script>
