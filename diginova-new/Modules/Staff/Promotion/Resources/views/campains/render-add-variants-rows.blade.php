@php
    $i = 0;
@endphp

@foreach($variantIds as $variantId)

@php
    $product_variant = $product_variants->find($variantId);
@endphp

<tr class="c-ui-table__row c-ui-table__row--body js-edit-row added-by-js added-by-js-{{ $product_variant->id }}"
 data-id="{{ $product_variant->id }}" style="text-align: center !important;">
    <td class="c-ui-table__cell">
        <img src="{{ $site_url . '/' . $product_variant->product->media()->first()->path . '/' . $product_variant->product->media()->first()->name }}?x-oss-process=image/resize,m_lfit,h_115,w_115/quality,q_60"
            alt="
                {{ $product_variant->product->title_fa }} | {{ $product_variant->variant->name }} | گارانتی
                {{ (!is_null($product_variant->warranty->month))? persianNum($product_variant->warranty->month) . ' ماهه' : '' }}
                {{ $product_variant->warranty->name }}
            " class="c-mega-campaigns-join-list__container-table-image">
    </td>
    <td class="c-ui-table__cell" style="text-align: right;">
        {{ $product_variant->product->title_fa }} | {{ $product_variant->variant->name }} | گارانتی
        {{ (!is_null($product_variant->warranty->month))? persianNum($product_variant->warranty->month) . ' ماهه' : '' }}
        {{ $product_variant->warranty->name }}
        <span class="c-mega-campaigns-join-list__container-table-dkpc">DKPC-{{ $product_variant->variant_code }}</span>
        <div
            class="c-mega-campaigns-join-list__container-table-error uk-text-nowrap uk-hidden added-by-js-messages-{{ $product_variant->id }}">
        </div>
    </td>
    <td class="c-ui-table__cell">
        {{ persianNum($product_variant->sale_price) }}
    </td>
    <td class="c-ui-table__cell uk-padding-remove">
        <div class="c-mega-campaigns--mh-105 uk-flex">
            <div class="c-mega-campaigns--mt-25 uk-flex">
                <div class="uk-flex uk-flex-column">
                    <div class="c-mega-campaigns-join-modal__body-table-input c-mega-campaigns-join-modal__body-table-input--xs js-number-input-wrapper">
                        <input name="variant[promotion_percent]" type="number" min="0" max="100" type="text" class="js-discount-value js-number-input" value="">
                    </div>
                    <span class="c-mega-campaigns-join-modal__body-table-input-sub-title"></span>
                </div>
                <span class="c-mega-campaigns-join-modal__body-table-input-link c-mega-campaigns--mr-5"></span>
            </div>
        </div>
    </td>
    <td class="c-ui-table__cell uk-padding-remove">
        <div class="uk-flex uk-flex-column c-mega-campaigns--mh-105 uk-flex-center">
            <div class="c-mega-campaigns--mt-12">
                <div class="c-mega-campaigns-join-modal__body-table-input c-mega-campaigns-join-modal__body-table-input--medium js-number-input-wrapper">
                    <input type="text" name="variant[promotion_price]" class="js-promotion-price js-numeric-input"
                           value="" data-selling_price="{{ $product_variant->sale_price }}" data-crossed_price="{{ $product_variant->sale_price }}">
                </div>
            </div>
        </div>
    </td>

    <td class="c-ui-table__cell uk-padding-remove">
        <div class="c-ui-tooltip__anchor">
            <div class="c-ui-toggle__group">
                <label class="c-ui-toggle">
                    <input class="c-ui-toggle__origin js-toggle-active-product" type="checkbox" data-group-id="" name="variant[status]" checked>
                    <span class="c-ui-toggle__check"></span>
                </label>
            </div>

            <input type="hidden" value="0" class="js-active-input">
        </div>
    </td>

    <td class="c-ui-table__cell" style="text-align: center !important;">
        {{ persianNum($product_variant->stock_count) }}
    </td>
    <td class="c-ui-table__cell uk-padding-remove">
        <div class="c-join-smart-products--middle-item-height uk-flex uk-flex-middle uk-flex-center">
            <div class="c-mega-campaigns-join-modal__body-table-input c-mega-campaigns-join-modal__body-table-input--small-container c-mega-campaigns-join-modal__body-table-input--small js-number-input-wrapper uk-flex">
                <input type="number" name="variant[promotion_limit]" min="1" class="js-number-input js-input-promotion-limit" value="">
            </div>
        </div>
    </td>
    <td class="c-ui-table__cell uk-padding-remove">
        <div class="c-join-smart-products--middle-item-height uk-flex uk-flex-middle uk-flex-center">
            <div class="c-mega-campaigns-join-modal__body-table-input c-mega-campaigns-join-modal__body-table-input--small-container c-mega-campaigns-join-modal__body-table-input--small js-number-input-wrapper uk-flex">
                <input type="number" name="variant[promotion_order_limit]" min="1" class="js-number-input js-input-order-limit" value="">
            </div>
        </div>
    </td>
    <td class="c-ui-table__cell uk-padding-remove">
        <div class="uk-flex uk-flex-between uk-flex-middle c-join-smart-products--middle-item-height js-edit-actions">
            <div class="uk-hidden c-mega-campaigns-join-modal__body-table-btn-separator c-mega-campaigns--ml-10">
                <button class="c-mega-campaigns-join-list__container-table-btn c-mega-campaigns-join-list__container-table-btn--save c-mega-campaigns--ml-10 c-mega-campaigns--mr-10 js-edit-button button js-save-promotion-price-record-changes" data-promotion="" data-product-variant-id="{{ $product_variant->id }}" data-promotion-variant-id="0"></button>
                <button class="c-mega-campaigns-join-list__container-table-btn c-mega-campaigns-join-list__container-table-btn--cancle c-mega-campaigns--ml-10 js-edit-cancel-button js-table-swap-row-handle" disabled></button>
            </div>
            <button class="c-mega-campaigns-join-list__container-table-btn c-mega-campaigns-join-list__container-table-btn--delete js-remove-variant" data-promotion="" data-variant="{{ $product_variant->id }}" data-promotion-variant-id="" data-product-id="2661133"></button>
        </div>
    </td>
    <td class="c-ui-table__cell c-ui-table__cell--operations c-ui-table__cell--text-error">
        <div class="uk-hidden js-undo-remove">
            <div class="c-join__flex-end">
                <span>کالا حذف شد</span>
            </div>
            <div class="c-join__flex-end">
                <a href="#" class="c-promo__table-action c-promo__table-action--undo js-undo-remove-button" data-promotion-variant-id="">لغو حذف</a>
            </div>
        </div>
    </td>
</tr>
@endforeach
