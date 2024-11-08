<div class="editable-section">
    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-4 ajax-box">
        <div class="c-grid__row c-grid__row--gap-lg c-grid__row--nowrap-sm">
            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--lg-12 c-grid__col--xs-gap">
                <label for="" class="uk-form-label" style="color: #606265;margin-bottom: 7px; margin-top: 15px;">
                    تنوع مجاز:
                </label>
                <div class="field-wrapper">
                    <label class="c-content-input">
                        @php
                            $cat_variant_g = $category->variantGroup()->first();
                        @endphp
                        <select name="variant_group" class="uk-input uk-input--select variant_type js-select-origin select2-hidden-accessible" tabindex="-1" aria-hidden="true" aria-invalid="false">
                        <option value="">انتخاب کنید</option>
                        @if(count($variantGroups))
                            @foreach($variantGroups->where('status', 1) as $variantGroup)
                                <option value="{{ $variantGroup->id }}" {{ (!is_null($cat_variant_g) && ($cat_variant_g->id == $variantGroup->id))? 'selected' : '' }}>{{ $variantGroup->name }}</option>
                            @endforeach
                        @endif
                        </select>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
