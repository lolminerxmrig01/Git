<div id="imagesSection" class="c-content-upload__uploads js-uploaded-section">
    <h3 class="product-form__section-title product-form__section-title--gap">
        تصویر بارگذاری شده
    </h3>
    <ul id="imagesContainer" class="c-content-upload__gallery-list js-uploaded-list js-sortable-list uk-sortable">
        <li class="c-content-upload__gallery-row js-uploads-row li-error" id="1dsWB">

            <div class="c-content-upload__img-container">
                <img name="uploaded" id="preview_uploading" src="{{ asset("media/categories/{$input['image']}") }}" data-id="{{ $media->id }}" class="c-content-upload__img js-upload-thumb upload-image">
                <div class="c-content-upload__img-loader" style="display: none;">
                    <div class="progress__wrapper">
                        <span class="progress"></span>
                    </div>
                </div>
                <div class="c-content-upload__img-error"></div>
            </div>

            <div class="c-content-upload__mid-container">
                <div class="c-content-upload__mid-container c-content-upload__mid-container--top">
                    <div class="c-content-upload__desc">
                        <div class="c-content-upload__desc--top">
                            <div class="right">
                                <div class="c-content-upload__name js-upload-name">{{ $request->image->getClientOriginalName() }}</div>
                                <div class="c-content-upload__size js-upload-size">{{  convertByte($imageSize) }}</div>
                            </div>
                            <div class="c-content-upload__select"></div>
                        </div>
                    </div>
                    <ul class="c-content-upload__list c-content-upload__list--errors js-upload-error-list">
                        <li class="error-image"></li>
                    </ul>
                </div>
            </div>
            <div class="c-content-upload__controls">
                <button type="button" class="c-content-upload__btn c-content-upload__btn--remove js-remove-upload"></button>
            </div>
        </li>
    </ul>
</div>
