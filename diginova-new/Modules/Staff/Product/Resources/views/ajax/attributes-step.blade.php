@foreach($attr_groups as $atrr_group)
<div class="c-grid__row c-grid__row--gap-lg">
    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial">
        <h3 class="product-form__section-title product-form__section-title--dot">{{ $atrr_group->name }}</h3>
    </div>
</div>


<div class="c-grid__row c-grid__row--gap-lg c-grid__row--negative-gap-attr">

  @foreach($atrr_group->attributes->sortBy('position') as $attribute)

    @if($attribute->type == 3 )
    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">
        <label class="uk-form-label uk-flex uk-flex-between">
            {{ $attribute->name }}:

            @if($attribute->is_required)
                <span class="uk-form-label__required"></span>
            @endif
        </label>

        <div class="field-wrapper ui-select ui-select__container">
            <select class="uk-input uk-input--select js-select-origin select2-hidden-accessible {{ ($attribute->is_required)? 'js-required-attribute' : '' }}" name="attributes[{{$attribute->id}}]" data-placeholder="انتخاب کنید" tabindex="-1" aria-hidden="true">
                <option value="">یکی از گزینه‌ها را انتخاب کنید</option>
              @foreach($attribute->values as $item)
                <option value="{{ $item->id }}"> {{ $item->value }} </option>
              @endforeach
            </select>
            <div class="js-select-options"></div>
        </div>
        <div>
        </div>
    </div>
    @endif


    @if($attribute->type == 4 )
    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">
        <label class="uk-form-label uk-flex uk-flex-between">
            {{ $attribute->name }}:

            @if($attribute->is_required)
                <span class="uk-form-label__required"></span>
            @endif
        </label>

        <div class="field-wrapper ui-select ui-select__container ui-select__container--product">
            <select class="uk-input uk-input--select uk-input--checkboxlist js-select-origin js-in-product select2-hidden-accessible
              {{ ($attribute->is_required)? 'js-required-attribute' : '' }}" multiple="" name="attributes[{{$attribute->id}}][]"
                    data-placeholder="انتخاب کنید" tabindex="-1" aria-hidden="true" aria-describedby="attributes[{{$attribute->id}}]-error" aria-invalid="false">
              @foreach($attribute->values as $item)
                <option value="{{ $item->id }}"> {{ $item->value }} </option>
              @endforeach
            </select>
            <span class="select-counter" style="display: none;">۰</span>
            <div class="js-select-options"></div>
            <div id="attributes[{{$attribute->id}}][]-error" class="error error-msg" style="display: none;"></div>
        </div>
        <div>

        </div>
    </div>
    @endif


    @if($attribute->type == 1)
    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">
        <label class="uk-form-label uk-flex uk-flex-between">
            {{ $attribute->name }}:

            @if($attribute->is_required)
                <span class="uk-form-label__required"></span>
            @endif
        </label>
        <div class="field-wrapper">
            <input type="text" class="c-content-input__origin js-attribute-old-value
               {{ ($attribute->is_required)? 'js-required-attribute' : '' }}" name="attributes[{{$attribute->id}}]" value="">
        </div>
        <div>
        </div>
    </div>
    @endif


    @if($attribute->type == 5)
        @if($attribute->unit->type == 0)
            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">
                <label class="uk-form-label uk-flex uk-flex-between">
                    {{ $attribute->name }}:

                    @if($attribute->is_required)
                        <span class="uk-form-label__required"></span>
                    @endif

                    <span class="uk-float-left uk-padding-medium-left">{{ $attribute->unit->name }}</span>
                </label>
                <div class="field-wrapper">
                    <input type="text" class="c-content-input__origin js-attribute-old-value
                    {{ ($attribute->is_required)? 'js-required-attribute' : '' }}" name="attributes[{{$attribute->id}}]" value="">
                </div>
            </div>
        @else
            <div class="c-grid__col c-grid__col--gap-attr c-grid__col--flex-initial c-grid__col--lg-6">
                <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm">
                    <div class="c-grid__col c-grid__col--gap-attr c-grid__col--flex-initial c-grid__col--lg-12">
                        <label for="" class="uk-form-label">
                            {{ $attribute->name }}:
                            @if($attribute->is_required)
                                <span class="uk-form-label__required"></span>
                            @endif
                        </label>
                        <div class="c-grid__row c-grid__row--gap-small c-grid__row--nowrap-sm">
                          @foreach($attribute->unit->values as $value)
                            <div class=" c-grid__col c-grid__col--gap-small c-grid__col--flex-initial c-grid__col--xs-gap">
                                <div class="field-wrapper">
                                    <label class="c-content-input">
                                        <span class="c-content-input__text c-content-input__text--overlay">{{ $value->value }}</span>
                                        <input type="text" placeholder="" class="c-content-input__origin c-content-input__origin--overlay {{ ($attribute->is_required)? 'js-required-attribute' : '' }}" name="attributes[{{$attribute->id}}][]" value="">
                                    </label>
                                </div>
                            </div>
                          @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif

    @if($attribute->type == 2)
    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-12">
        <label class="uk-form-label uk-flex uk-flex-between">
            {{ $attribute->name }}:

            @if($attribute->is_required)
                <span class="uk-form-label__required"></span>
            @endif
        </label>
        <div class="field-wrapper">
            <textarea class="uk-textarea uk-textarea--attr {{ ($attribute->is_required)? 'js-required-attribute' : '' }}" name="attributes[{{$attribute->id}}]"></textarea>
        </div>
        <div>
        </div>
    </div>
    @endif

  @endforeach

</div>
@endforeach

@if($attr_groups->count() == 0)
<div class="c-grid__row c-grid__row--gap-lg js-auto-title-message">
  <div
    class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--sm-12">
    <div class="c-content-product__auto-title-msg">برای این گروه کالایی شما هیچ ویژگی ایجاد نکرده‌اید پیشنهاد می‌شود حتما ابتدا برای دسته‌بندی‌ها ویژگی ایجاد کنید سپس اقدام به ایجاد محصول کنید و یا پس از ذخیره این صفحه و ایجاد ویژگی برای آن نسبت به ویرایش محصول اقدام کنید.</div>
  </div>
</div>
@endif


<div class="c-content-accordion__step-controls c-content-accordion__step-controls--spacer">
    <button class="c-ui-btn c-ui-btn--next mr-a goToTitleStep" id="attributesStepNext">
        ادامه دادن
    </button>
</div>
