<div class="c-comments-product__attributes-col  js-valid-row">
    <div class="c-comments-product__attributes-title">
        {{ $item->name }}
    </div>
    <div id="rating-bar-{{ $item->id }}" data-factor-id="{{ $item->id }}"
         class="c-slider c-slider--one js-rating noUi-target noUi-rtl noUi-horizontal"
         data-rate-digit="(3)" data-rate-title="معمولی">
        <span class="c-slider__step c-slider__step--two js-slider-step" data-rate-title="خیلی بد" data-rate-value="20"></span>
        <span class="c-slider__step c-slider__step--three js-slider-step" data-rate-title="بد" data-rate-value="40"></span>
        <span class="c-slider__step c-slider__step--four js-slider-step active" data-rate-title="معمولی" data-rate-value="60"></span>
        <span class="c-slider__step c-slider__step--five js-slider-step" data-rate-title="خوب" data-rate-value="80"></span>
        <span class="c-slider__step c-slider__step--six js-slider-step" data-rate-title="عالی" data-rate-value="100"></span>
        <input class="c-ui-hidden-input js-rate-input" type="text" value="0" id="rating-{{ $item->id }}" name="comment[rating][{{ $item->id }}]">
    </div>
</div>
