let IndexAction = {
    init: function () {
        this.initTooltips();
    },

    initTooltips: function () {
        const tooltipContainers = document.querySelectorAll('.js-tooltip');
        if (tooltipContainers.length) {
            $(document).on('mouseenter', '.js-tooltip', this.showTooltip);
        }

        const tooltipInputContainers = document.querySelectorAll('.js-tooltip-input');
        if (tooltipInputContainers.length) {
            $(document).on('focusin', '.js-tooltip-input', this.showTooltip);
        }
    },

    createTooltip: function (id, text) {
        const tooltip = document.createElement('div');

        if (id && text) {
            $(tooltip).addClass('c-content-tooltip').attr('id', id);
            $(tooltip).append($.parseHTML(text));
        }

        return $(tooltip);
    },

    showTooltip: function (e) {
        const $target = $(e.currentTarget);

        const tooltipText = $target.data('tooltip');

        if (!tooltipText) {
            return;
        }
        const tooltipHalfMaxWidth = 235 / 2;
        const targetHalfWidth = $target.offsetWidth / 2;
        const tooltipId = 'tooltip-block';
        const targetPosition = $target[0].getBoundingClientRect();
        const $tooltip = IndexAction.createTooltip(tooltipId, tooltipText);
        const $body = $('body');

        function removeTooltip()
        {
            $tooltip.remove();
            if ($target.hasClass('js-tooltip-input')) {
                $target.off('focusout', removeTooltip);
            } else {
                $target.off('mouseleave', removeTooltip);
            }
            $(window).off('scroll', removeTooltip);
        }

        $body.append($tooltip);

        if (targetPosition.left + tooltipHalfMaxWidth + targetHalfWidth >= $body.innerWidth()) {
            $tooltip.addClass('c-content-tooltip--left');
        } else if (targetPosition.left + targetHalfWidth - tooltipHalfMaxWidth <= 0) {
            $tooltip.addClass('c-content-tooltip--right');
        }

        if (targetPosition.top + targetPosition.height + $tooltip.offsetHeight >= document.body.clientHeight) {
            $tooltip.addClass('c-content-tooltip--top');
            $tooltip.css('top', targetPosition.top - $tooltip.outerHeight() + 'px');
        } else {
            $tooltip.css('top', targetPosition.top + targetPosition.height + 'px');
        }

        if ($target.hasClass('js-tooltip-input')) {
            $tooltip.addClass('c-content-tooltip--left');
            $tooltip.css('left', targetPosition.left + $target.outerWidth() - 20 + 'px');
        } else {
            $tooltip.css('left', targetPosition.left + $target.outerWidth() / 2 + 'px');
        }

        $tooltip.css('opacity', 1);

        if ($target.hasClass('js-tooltip-input')) {
            $target.on('focusout', removeTooltip);
        } else {
            $target.on('mouseleave', removeTooltip);
        }
        $(window).on('scroll', removeTooltip);
    },

    initTitleFormValidation: function () {
        let $form = $('#titleForm');
        let rules = {
            'title[title_fa]': {
                required: true,
                minlength: 7,
                maxlength: 255,
                not_same_as_old_value: true
            },
            'title[title_en]': {
                validate_only_english: true,
                minlength: 7,
                maxlength: 255,
                not_same_as_old_value: true
            },
        };

        let messages = {
            'title[title_fa]': {
                'required': 'وارد کردن عنوان فارسی اجباری است',
                'minlength': 'عنوان فارسی وارد شده کوتاه‌تر از حد مجاز است، این عنوان نمی‌تواند کوتاه‌تر از 7 کاراکتر باشد',
                'maxlength': 'عنوان فارسی وارد شده طولانی‌تر از حد مجاز است، این عنوان نمی‌تواند طولانی‌تر از 255 کاراکتر باشد'
            },
            'title[title_en]': {
                'validate_only_english': 'از کاراکترهای انگلیسی برای عنوان انگلیسی استفاده کنید',
                'minlength': 'عنوان انگلیسی وارد شده کوتاه‌تر از حد مجاز است، این عنوان نمی‌تواند کوتاه‌تر از 7 کاراکتر باشد',
                'maxlength': 'عنوان انگلیسی وارد شده طولانی‌تر از حد مجاز است، این عنوان نمی‌تواند طولاتی‌تر از 255 کاراکتر باشد',
            },
        };

        $form.validate();

        this.productFormValidator = $form.validate({
            rules: rules,
            messages: messages
        });
    },

    initProductChanges: function () {
        let $that = this;
        $('#brandsSelect').change(function () {
            let value = $(this).val();
            let $productIsFake = $('#productIsFake');
            if ($productIsFake.length && $productIsFake.prop('checked') && $productIsFake.data('brand-other-id').toString() !== value) {
                $productIsFake.prop('checked', false);
                $that.clearAndDisableFakeReasons();
            }

            if ($that.isContentUser() && !$that.hasForceMarketplaceSeller()) {
                return;
            }

            let $commissionsValueContainer = $('#commissionValueContainer');
            let $commissionsContainer = $('#commissionContainer');

            if (!value) {
                if (!$that.hasForceMarketplaceSeller()) {
                    $commissionsValueContainer.html('');
                    $commissionsContainer.addClass('hidden');
                }
                return;
            }

            Services.showLoader = function () {
                $('#stepProductContainer').addClass('c-content-loading');
            };

            Services.hideLoader = function () {
                $('#stepProductContainer').removeClass('c-content-loading');
            };

            Services.ajaxPOSTRequestJSON(
                '/content/create/product/step/product/commission/',
                {
                    category_id: $('#selectedCategoryIdConfirmed').val(),
                    brand_id: $(this).val(),
                    force_marketplace_seller_id: $that.getForceMarketplaceSellerId()
                },
                /**
                 * @param data
                 * @param data.forceUrl force url to go
                 * @param data.categoryFormValid Product Form is valid
                 * @param data.categoryForm.errors Backend validation errors
                 * @param data.productFormValid Product Form is valid
                 * @param data.productForm.jsErrors Backend validation errors
                 * @param data.productForm.errors Backend validation errors
                 * @param data.attributesFormValid Attribute Form is valid
                 * @param data.attributesForm.jsErrors Backend validation errors
                 * @param data.attributesForm.errors Backend validation errors
                 * @param data.imagesFormValid Images Form is valid
                 * @param data.imagesForm.jsErrors Backend validation errors
                 * @param data.imagesForm.errors Backend validation errors
                 * @param data.images3dFormValid Images3d Form is valid
                 * @param data.images3dForm.jsErrors Backend validation errors
                 * @param data.images3dForm.errors Backend validation errors
                 * @param data.videosFormValid Videos Form is valid
                 * @param data.videosForm.errors Backend validation errors
                 * @param data.productForm.commission Commission value
                 */
                function (data) {
                    $that.handleErrors(data);
                    let $productStepNext = $('#productStepNext');
                    if (typeof data.productFormValid !== 'undefined' && data.productFormValid === false) {
                        if (!$that.hasForceMarketplaceSeller()) {
                            $commissionsValueContainer.html('');
                            $commissionsContainer.addClass('hidden');
                        }
                        $productStepNext.addClass('disabled');
                        return;
                    }
                    if (!$that.hasForceMarketplaceSeller()) {
                        $commissionsValueContainer.html(data.productForm.commission);
                        $commissionsContainer.removeClass('hidden');
                    }

                    $productStepNext.removeClass('disabled');

                },
                function () {
                },
                true,
                true
            );
        });
    },
};


$(function () {
    IndexAction.init();
});
