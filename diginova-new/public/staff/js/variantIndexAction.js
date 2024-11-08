/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/controllers/Content/ContentCreation/productVariantsController/indexAction.js]*/
var IndexAction = {
    data: {
        newProductVariantIterator: 0,
        maxVariantsCount: 0,
        variationPairs: null
    },
    productId: '',

    goldPriceInfo: {
        isOnlyGold: window['goldPriceParameters'] ? window['goldPriceParameters']['is_only_gold'] : null,
        staticData: {
            lgp: window['goldPriceParameters'] ? window['goldPriceParameters']['live_gold_price']: null, // live gold price
            tax: window['goldPriceParameters'] ? window['goldPriceParameters']['tax'] * 100: null,
            gold_wage_max_margin: window['goldPriceParameters'] ? parseInt( Number(window['goldPriceParameters']['gold_wage_max_margin']) * 100 ) : null,
            profit_max_margin: window['goldPriceParameters'] ? parseInt(Number(window['goldPriceParameters']['profit_max_margin']) * 100 ) : null
        },
        dynamicData: {
            // this object contains the dynamic data of gold price information per each variant that has been generated
            // for each variant should generate the object like below with the key of the variant iterator (newProductVariantIterator)
            // the data format would be like the below object
            // '0': {
            //     size: 1, // size of the gold ( gram )
            //     gw: 0, // gold wages
            //     ngp: 0, //  Non Gold part of the product cost Price
            //     ngw: 0, // Non Gold part of the product Wage
            //     profit: 0,
            //     finalPrice: 0
            // }
        },
    },

    init: function () {
        if (this.isReadOnly()) {
            return;
        }
        this.variantsFormValidator = null;

        this.initUiSelect();

        this.extendValidator();
        this.initAddNewVariant();
        this.initRemoveNewVariant();
        this.initSaveNewVariants();

        this.initMaxVariants();
        this.initVariationPairs();
        this.initEditVariantControls();

        if (this.isColorVariation()) {
            this.initNewColorRequestModal();
            this.initColorUploadPrimary();
        } else if (this.isSizeVariation()) {
            this.initNewSizeRequestModal();
        }

        this.initMeasurementModal();
        this.initNewWarrantyRequestModal();
        this.initWarrantyUploadFront();
        this.initWarrantyUploadBack();
        this.initInsuranceUploadFront();
        this.initInsuranceUploadBack();
        this.initSaveEditVariant();
    },

    isReadOnly: function () {
        /** @var readOnly */
        return typeof window.readOnly !== 'undefined' && window.readOnly === true;
    },

    isColorVariation: function () {
        /** @var coloredMode */
        return typeof window.coloredMode !== 'undefined' && window.coloredMode === true;
    },

    isSizeVariation: function () {
        /** @var sizedMode */
        return typeof window.sizedMode !== 'undefined' && window.sizedMode === true;
    },

    initMaxVariants: function () {
        this.data.maxVariantsCount = (typeof window.maxVariantsCount !== 'undefined') ? window.maxVariantsCount : 1000;
    },

    initVariationPairs: function () {
        this.data.variationPairs = (typeof window.variationPairs !== 'undefined') ? window.variationPairs : null;
    },

    initAddNewVariant: function () {
        let $that = this;
        $('.js-add-variant').click(function () {
            if ($that.data.maxVariantsCount < $that.getNewVariantsCount()) {
                return;
            }

            let $this = $(this);

            $('#ajaxSuccessList').addClass('hidden');
            $('#ajaxErrorsList').addClass('hidden');

            let $productVariantTemplate = $('#productVariantTemplate > div').clone();

            if ($that.isColorVariation() || $that.isSizeVariation()) {
                let $variantCountContainer = $this.find('.js-variant-count:first');
                let $variantCount = $variantCountContainer.text();

                if ($variantCount === '') {
                    $variantCountContainer.text(1);
                    $variantCountContainer.parent().removeClass('hidden');
                } else {
                    $variantCountContainer.text(parseInt($variantCount) + 1);
                }

                $this.addClass('active');

                let $attributeTitleContainer = $productVariantTemplate.find('.js-variant-attribute-title:first');
                $attributeTitleContainer.text($this.data('title'));

                if ($that.isColorVariation()) {
                    let $colorHexContainer = $productVariantTemplate.find('.js-variant-color-hex:first');
                    $colorHexContainer.css('background-color', $this.data('hex'));
                }

                $productVariantTemplate.find('.js-remove-variant:first').data('attribute-id', $this.prop('id'));
            }

            $('#variantsContainer').append($productVariantTemplate);
            $('#ajaxSuccessContainer').addClass('hidden');

            $productVariantTemplate.find('.js-variant-iterator:first').val($that.data.newProductVariantIterator);

            let $productVariantIteratorKey = 'product_variants[variant_' + $that.data.newProductVariantIterator;

            if ($that.isColorVariation() || $that.isSizeVariation()) {
                let $attributeIdInput = $productVariantTemplate.find('.js-variant-attribute-id:first');

                $attributeIdInput.prop('name', $productVariantIteratorKey + '_attribute]');
                $attributeIdInput.val($this.data('attribute-id'));
            }

            $productVariantTemplate
                .find('.js-variant-active:first')
                .prop('name', $productVariantIteratorKey + '_active]');

            $productVariantTemplate
                .find('.js-variant-site-digikala:first')
                .prop('name', $productVariantIteratorKey + '_site]');

            $productVariantTemplate
                .find('.js-variant-site-digistyle:first')
                .prop('name', $productVariantIteratorKey + '_site]');

            $productVariantTemplate
                .find('.js-variant-site-both:first')
                .prop('name', $productVariantIteratorKey + '_site]');

            $productVariantTemplate
                .find('.js-variant-shipping-type-digikala:first')
                .prop('name', $productVariantIteratorKey + '_shipping_type_digikala]')
                .rules('add', {
                    at_least_one_shipping_type: true,
                    messages: {
                        at_least_one_shipping_type: 'انتخاب نوع ارسال اجباری است'
                    }
                });

            // init gold price form, event listeners and default values
            if ( isModuleActive('variant_gold_price') && IndexAction.goldPriceInfo.staticData.lgp ) {
                IndexAction.goldPriceInfo.dynamicData[IndexAction.data.newProductVariantIterator.toString()] = {
                    size: $this.data('attribute-value').toString().search('گرم') !== -1
                        ? Number($this.data('attribute-value').toString().substr(0, $this.data('attribute-value').length - 3))
                        : Number($this.data('attribute-value').toString()), // size of the gold ( gram )
                    gw: 0, // gold wages
                    ngp: 0, //  Non Gold part of the product cost Price
                    ngw: 0, // Non Gold part of the product Wage
                    profit: 0,
                    finalPrice: 0
                };
                window.GoldPriceAction.initGoldPrice(IndexAction.data.newProductVariantIterator);
                window.GoldPriceAction.initGoldPriceForm();
            } else {
                window.GoldPriceAction.removeGoldPriceFields();
            }

            if (window.isShipBySellerModuleActive) {
                if (isModuleActive('only_fbs')) {
                    $productVariantTemplate.find('.js-variant-shipping-type-digikala:first').on('click', function () {
                        if (!$(this).is(':checked')) {
                            $productVariantTemplate.find('select.js-variant-lead-time').attr('disabled', true);
                            $productVariantTemplate.find('select.js-variant-lead-time').parent('div').addClass('new-sbs-lead-time-field-wrapper__first-select--disabled');
                        } else {
                            $productVariantTemplate.find('select.js-variant-lead-time').attr('disabled', false);
                            $productVariantTemplate.find('select.js-variant-lead-time').parent('div').removeClass('new-sbs-lead-time-field-wrapper__first-select--disabled');
                        }
                    });
                }

                let shipBySellerChecked = false;
                let shipBySeller = $productVariantTemplate.find('.js-variant-shipping-type-seller:first');
                if (!window.hasActiveSetting) {
                    shipBySeller.prop('disabled', true)
                    shipBySeller.parent().parent().parent().find('.c-nccp-tooltip').addClass('c-nccp-tooltip--visible');
                }

                const fbsLeadTime = $productVariantTemplate.find('.js-variant-fbs-lead-time').parent();
                let hiddenInput = fbsLeadTime.children('input');
                hiddenInput.prop('name', $productVariantIteratorKey + '_fbs_lead_time]');
                let hiddenShipBySellerInput = $productVariantTemplate
                    .find('.js-empty-shipping-type-seller');
                hiddenShipBySellerInput.prop('name', $productVariantIteratorKey + '_shipping_type_seller]')
                $productVariantTemplate
                    .find('.js-variant-shipping-type-seller:first')
                    .prop('name', $productVariantIteratorKey + '_shipping_type_seller]').on('click', function () {
                        shipBySellerChecked = !shipBySellerChecked;
                        if (shipBySellerChecked) {
                            $(this).siblings('input').remove();
                            fbsLeadTime.removeClass('new-sbs-lead-time-field-wrapper__first-select--disabled');
                            fbsLeadTime.addClass('new-sbs-lead-time-field-wrapper__first-select');
                            fbsLeadTime.children('select').prop('disabled', false);
                            fbsLeadTime.children('select').trigger('change');
                            fbsLeadTime.children('select').rules('add', 'required');
                            hiddenInput.remove();
                        } else {
                            $(this).parent().append(hiddenShipBySellerInput);
                            fbsLeadTime.removeClass('new-sbs-lead-time-field-wrapper__first-select');
                            fbsLeadTime.addClass('new-sbs-lead-time-field-wrapper__first-select--disabled');
                            fbsLeadTime.children('select').prop('disabled', true);
                            fbsLeadTime.children('select').trigger('change');
                            fbsLeadTime.children('select').rules('remove', 'required');
                            fbsLeadTime.append(hiddenInput);
                        }
                    });
            }
            $productVariantTemplate
                .find('.js-variant-shipping-type-digistyle:first')
                .prop('name', $productVariantIteratorKey + '_shipping_type_digistyle]');

            let $leadTimeInput = $productVariantTemplate.find('.js-variant-lead-time:first');

            $leadTimeInput.prop('name', $productVariantIteratorKey + '_lead_time]');

            $leadTimeInput.rules('add', {
                required: true,
                digits: true,
                min: 1,
                max: $productVariantTemplate.data('max_lead_time'),
                messages: {
                    required: 'وارد کردن بازه‌ی زمانی ارسال اجباری است',
                    digits : 'فقط مجاز به استفاده از عدد برای بازه‌ی زمانی ارسال هستید',
                    min: 'بازه‌ی زمانی ارسال نمی‌تواند کمتر از یک روز باشد',
                    max: 'بازه‌ی زمانی ارسال نمی‌تواند بیشتر از ده روز باشد'
                }
            });

            if (window.isShipBySellerModuleActive) {
                let $fbsLeadTime = $productVariantTemplate.find('.js-variant-fbs-lead-time');
                let leadtime = $productVariantTemplate.find('.js-variant-lead-time');
                $fbsLeadTime.prop('name', $productVariantIteratorKey + '_fbs_lead_time]');
                $fbsLeadTime.rules('add', {
                    required: true,
                    digits: true,
                    min: 2,
                    max: leadtime.val() ? parseInt(leadtime.val()) * 24 : 10000,
                    messages: {
                        required: 'وارد کردن بازه‌ی زمانی ارسال اجباری است',
                        digits: 'فقط مجاز به استفاده از عدد برای بازه‌ی زمانی ارسال هستید',
                        min: 'بازه‌ی زمانی ارسال نمی‌تواند کمتر از یک روز باشد',
                        max: 'بازه زمانی ارسال فروشنده نمیتواند بیشتر از بازه زمانی ارسال دیجیکالا باشد'
                    }
                });

                leadtime.on('change', function () {
                    $fbsLeadTime.rules('remove', 'max');
                    $fbsLeadTime.rules('add', {
                        max: leadtime.val() ? parseInt(leadtime.val()) * 24 : 241,
                    });

                })
                $fbsLeadTime.on('change', function () {
                    if (leadtime.val() && (parseInt(leadtime.val()) * 24 >= $(this).val()) && $(this).val()) {
                        $(this).parent().removeClass('has-error');
                    } else if ((leadtime.val() && (parseInt(leadtime.val()) * 24 < $(this).val()))) {
                        $(this).parent().addClass('has-error');
                    } else if (!leadtime.val() && $(this).val()) {
                        $(this).parent().removeClass('has-error');
                    }
                    leadtime = $productVariantTemplate.find('.js-variant-lead-time');
                    $(this).rules('remove', 'max');
                    $(this).rules('add', {
                        max: leadtime.val() ? parseInt(leadtime.val()) * 24 : 10000,
                    });

                    const shipBySellerChecked = $productVariantTemplate.find('.js-variant-shipping-type-seller:first').siblings('input').length === 0;
                    const hourLeadTime = $productVariantTemplate.find('.js-variant-fbs-lead-time-second').parent();
                    let currentFbsLeadTime = $(this);
                    if (shipBySellerChecked && $(this).val() && ($(this).val() === '2' || $(this).val() === '3' || $(this).val() === '4' || $(this).val() === '5')) {
                        hourLeadTime.removeClass('new-sbs-lead-time-field-wrapper__second-select--disabled');
                        hourLeadTime.addClass('new-sbs-lead-time-field-wrapper__second-select');
                        const hourLeadTimeSelect = hourLeadTime.children('.js-variant-fbs-lead-time-second');
                        hourLeadTimeSelect.prop('disabled', false);
                        hourLeadTimeSelect.rules('add', {required: true,
                            messages: {
                                required: 'پر کردن این فیلد الزامی است',
                                digits : 'فقط مجاز به استفاده از عدد برای بازه‌ی زمانی ارسال هستید',
                                min: 'بازه‌ی زمانی ارسال نمی‌تواند کمتر از یک روز باشد',
                                max: 'بازه‌ی زمانی ارسال نمی‌تواند بیشتر از ده روز باشد'
                            }});
                        hourLeadTimeSelect.on('change', function () {
                            currentFbsLeadTime.children('option:nth-child(2)').val($(this).val());
                            hourLeadTime.removeClass('has-error');
                        })
                    } else {
                        hourLeadTime.addClass('new-sbs-lead-time-field-wrapper__second-select--disabled');
                        hourLeadTime.removeClass('new-sbs-lead-time-field-wrapper__second-select');
                        hourLeadTime.children('.js-variant-fbs-lead-time-second').prop('disabled', true);
                        hourLeadTime.parent().find('.error-msg').remove();
                        hourLeadTime.removeClass('has-error');
                    }
                });
            }
            let $orderLimitInput = $productVariantTemplate.find('.js-variant-order-limit:first');

            $orderLimitInput.prop('name', $productVariantIteratorKey + '_order_limit]');

            $orderLimitInput.rules('add', {
                required: true,
                digits: true,
                min: 1,
                // max: 30,
                messages: {
                    required: 'وارد کردن تعداد برای سفارش مشتریان اجباری است',
                    digits : 'فقط مجاز به استفاده از عدد برای سفارش مشتریان هستید',
                    min: 'حداقل سفارش مشتریان نمی‌تواند کمتر از 1 باشد',
                    max: 'حداکثر تعداد سفارش مشتریان نمی‌تواند بیشتر از 30 باشد'
                }
            });




            let $postTimeInput = $productVariantTemplate.find('.js-variant-post-time:first');

            $postTimeInput.prop('name', $productVariantIteratorKey + '_post_time]');

            $postTimeInput.rules('add', {
                required: true,
                digits: true,
                min: 1,
                max: 365,
                messages: {
                    required: 'وارد کردن تعداد برای بازه زمانی ارسال اجباری است',
                    digits : 'فقط مجاز به استفاده از عدد برای بازه زمانی ارسال هستید',
                    min: 'حداقل بازه زمانی ارسال نمی‌تواند کمتر از 1 باشد',
                    max: 'حداکثر بازه زمانی ارسال نمی‌تواند بیشتر از 365 باشد'
                }
            });



            let $sellerStockInput = $productVariantTemplate.find('.js-variant-marketplace-seller-stock:first');

            $sellerStockInput.prop('name', $productVariantIteratorKey + '_marketplace_seller_stock]');

            $sellerStockInput.rules('add', {
                required: true,
                digits: true,
                min: 0,
                max: 30000,
                messages: {
                    required: 'وارد کردن موجودی نزد شما اجباری است',
                    digits:  'فقط مجاز به استفاده از عدد برای موجودی هستید',
                    min: 'مقدار موجودی ارسال به انبار نمی‌تواند کمتر از 0 باشد',
                    max: 'مقدار موجودی ارسال به انبار نمی‌تواند بیشتر از 10000 عدد باشد'
                }
            });

            let $supplierCodeInput = $productVariantTemplate.find('.js-variant-supplier-code:first');

            $supplierCodeInput.prop('name', $productVariantIteratorKey + '_supplier_code]');

            $supplierCodeInput.rules('add', {
                maxlength: 255,
                messages: {
                    maxlength: 'مقدار وارد شده برای کد فروشنده نمی‌تواند طولانی‌تر از 255 کاراکتر باشد'
                }
            });

            let $priceInput = $productVariantTemplate.find('.js-variant-price:first');

            $priceInput.prop('name', $productVariantIteratorKey + '_price]');

            window.Main.initThousandSeparator();
            $priceInput.rules('add', {
                required: true,
                digits: true,
                min: 100,
                price_mod_hundred: true,
                messages: {
                    required: 'وارد کردن قیمت اجباری است',
                    digits: 'فقط مجاز به استفاده از عدد برای قیمت هستید',
                    min: 'قیمت نمی‌تواند کمتر‌تر از ۱۰۰ ریال باشد',
                    price_mod_hundred: 'فرمت وارد شده برای قیمت صحیح نیست، قیمت باید به 00 ختم شود',
                }
            });




            let $buyPriceInput = $productVariantTemplate.find('.js-variant-buy-price:first');

            $buyPriceInput.prop('name', $productVariantIteratorKey + '_buy_price]');

            window.Main.initThousandSeparator();
            $buyPriceInput.rules('add', {
                // required: true,
                digits: true,
                min: 100,
                // price_mod_hundred: true,
                messages: {
                    required: 'وارد کردن قیمت اجباری است',
                    digits: 'فقط مجاز به استفاده از عدد برای قیمت هستید',
                    min: 'قیمت نمی‌تواند کمتر‌تر از ۱۰۰ ریال باشد',
                    price_mod_hundred: 'فرمت وارد شده برای قیمت صحیح نیست، قیمت باید به 00 ختم شود',
                }
            });




            let $warrantySelect = $productVariantTemplate.find('.js-variant-warranty:first');

            $warrantySelect.prop('name', $productVariantIteratorKey + '_warranty_id]');

            $warrantySelect.rules('add', {
                required: true,
                messages: {
                    required: 'وارد کردن گارانتی اجباری است'
                }
            });

            if (window.dimensionLevel === 'item') {
                let dimensionValidationMessages = {
                    width: {
                        min: 'عرض بسته‌بندی نمی‌تواند کمتر از 1 سانتیمتر باشد',
                        max: 'عرض بسته‌بندی نمی‌تواند بیش از 20000 سانتیمتر باشد'
                    },
                    height: {
                        min: 'ارتفاع بسته‌بندی نمی‌تواند کمتر از 1 سانتیمتر باشد',
                        max: 'ارتفاع بسته‌بندی نمی‌تواند بیش از 20000 سانتیمتر باشد'
                    },
                    length: {
                        min: 'طول بسته‌بندی نمی‌تواند کمتر از 1 سانتیمتر باشد',
                        max: 'طول بسته‌بندی نمی‌تواند بیش از 20000 سانتیمتر باشد'
                    },
                    weight: {
                        min: 'وزن بسته‌بندی نمی‌تواند کمتر از 1 گرم باشد',
                        max: 'وزن بسته‌بندی نمی‌تواند بیش از 9999000 گرم باشد'
                    }
                };

                if (window.hasDimensionConfig) {
                    dimensionValidationMessages.width.min = 'ابعاد وارد شده در بازه صحیح ابعاد این گروه کالایی قرار ندارد.';
                    dimensionValidationMessages.width.max = 'ابعاد وارد شده در بازه صحیح ابعاد این گروه کالایی قرار ندارد.';
                    dimensionValidationMessages.height.min = 'ابعاد وارد شده در بازه صحیح ابعاد این گروه کالایی قرار ندارد.';
                    dimensionValidationMessages.height.max = 'ابعاد وارد شده در بازه صحیح ابعاد این گروه کالایی قرار ندارد.';
                    dimensionValidationMessages.length.min = 'ابعاد وارد شده در بازه صحیح ابعاد این گروه کالایی قرار ندارد.';
                    dimensionValidationMessages.length.max = 'ابعاد وارد شده در بازه صحیح ابعاد این گروه کالایی قرار ندارد.';

                    dimensionValidationMessages.weight.min = 'وزن وارد شده در بازه صحیح وزن این گروه کالایی قرار ندارد.';
                    dimensionValidationMessages.weight.max = 'وزن وارد شده در بازه صحیح وزن این گروه کالایی قرار ندارد.';
                }

                $productVariantTemplate
                    .find('.js-variant-package-length:first')
                    .prop('name', $productVariantIteratorKey + '_package_length]')
                    .rules('add', {
                        required: true,
                        digits: true,
                        min: window.dimension.length.min,
                        max: window.dimension.length.max,
                        messages: {
                            'required': 'وارد کردن طول بسته‌بندی اجباری است',
                            'digits': 'فقط مجاز به وارد کردن عدد  و استفاده از اعداد صحیح برای طول هستید',
                            'min': dimensionValidationMessages.length.min,
                            'max': dimensionValidationMessages.length.max
                        }
                    });
                $productVariantTemplate
                    .find('.js-variant-package-width:first')
                    .prop('name', $productVariantIteratorKey + '_package_width]')
                    .rules('add', {
                        required: true,
                        digits: true,
                        min: window.dimension.width.min,
                        max: window.dimension.width.max,
                        messages: {
                            'required': 'وارد کردن عرض بسته‌بندی اجباری است',
                            'digits': 'فقط مجاز به وارد کردن عدد  و استفاده از اعداد صحیح برای عرض هستید',
                            'min': dimensionValidationMessages.width.min,
                            'max': dimensionValidationMessages.width.max
                        }
                    });
                $productVariantTemplate
                    .find('.js-variant-package-height:first')
                    .prop('name', $productVariantIteratorKey + '_package_height]')
                    .rules('add', {
                        required: true,
                        digits: true,
                        min: window.dimension.height.min,
                        max: window.dimension.height.max,
                        messages: {
                            'required': 'وارد کردن ارتفاع بسته‌بندی اجباری است',
                            'digits': 'فقط مجاز به وارد کردن عدد  و استفاده از اعداد صحیح برای ارتفاع هستید',
                            'min': dimensionValidationMessages.height.min,
                            'max': dimensionValidationMessages.height.max
                        }
                    });
                $productVariantTemplate
                    .find('.js-variant-package-weight:first')
                    .prop('name', $productVariantIteratorKey + '_package_weight]')
                    .rules('add', {
                        required: true,
                        digits: true,
                        min: window.dimension.weight.min,
                        max: window.dimension.weight.max,
                        messages: {
                            'required': 'وارد کردن وزن بسته‌بندی اجباری است',
                            'digits': 'فقط مجاز به وارد کردن عدد  و استفاده از اعداد صحیح برای وزن هستید',
                            'min': dimensionValidationMessages.weight.min,
                            'max': dimensionValidationMessages.weight.max
                        }
                    });
            }

            $that.data.newProductVariantIterator++;

            $productVariantTemplate.find('select').addClass('js-select-origin');

            $that.initUiSelect();

            $('#saveNewVariantsButton').removeClass('hidden');

            $that.scrollTo($productVariantTemplate, 55);
        });
    },

    initRemoveNewVariant: function () {
        let $that = this;
        $(document).on('click', '.js-remove-variant', function () {
            let $this = $(this);
            $('#ajaxSuccessList').addClass('hidden');
            $('#ajaxErrorsList').addClass('hidden');
            if ($that.isSizeVariation() || $that.isColorVariation()) {
                let $attributeButton = $('#' + $this.data('attribute-id'));
                let $variantCountContainer = $attributeButton.find('.js-variant-count:first');

                let $variantCount = $variantCountContainer.text();

                if ($variantCount === '1') {
                    $variantCountContainer.text('');
                    $variantCountContainer.parent().addClass('hidden');
                    $attributeButton.removeClass('active');
                } else {
                    $variantCountContainer.text(parseInt($variantCount) - 1);
                }
            }

            $this.parent().parent().remove();

            if ($that.getNewVariantsCount() === 0) {
                $('#saveNewVariantsButton').addClass('hidden');
            }

            $that.scrollTo($('#attributesContainer'), 55);

            return false;
        });
    },

    initSaveNewVariants: function () {
        let $that = this;
        let $form = $('#productVariantsForm');
        $('#saveNewVariantsButton').on('click', function () {
            $form.submit();

            // GTag part
            IndexAction.productId = $(this).parents('form').eq(0)
                .find('[name="product_variants[product_id]"]').eq(0).val();
            addGTag({event_action: 'Click on "add to list products"', event_label: IndexAction.productId});
            // GTag part end

            return false;
        });

        $that.variantsFormValidator = $form.validate();

        $form.on('submit', function () {
            let $formValid = $form.valid();
            let $variantsAreUnique = $that.validateUniqueVariants();

            if (!$formValid || !$variantsAreUnique) {
                return false;
            }

            let $saveNewVariantsButton = $('#saveNewVariantsButton');

            Services.showLoader = function () {
                $('#variantsContainer').addClass('c-content-loading');
                $saveNewVariantsButton.addClass('disabled');
            };

            Services.hideLoader = function () {
                $('#variantsContainer').removeClass('c-content-loading');
                $saveNewVariantsButton.removeClass('disabled');
            };

            let $ajaxErrorsContainer = $('#ajaxErrorsList');
            $ajaxErrorsContainer.addClass('hidden');
            $ajaxErrorsContainer.html('');

            var formData = $form.serializeArray();
            formData.forEach(function(item) {
                item.value = Services.convertToEnDigit(item.value).split(',').join('');
                if ( Number(item.value) ) {
                    // divide percent values to float values
                    if ( item.name.search('gold_wage') !== -1 || item.name.search('gold_profit') !== -1 )
                        item.value = Number(item.value) / 100;
                    else
                        item.value = Number(item.value);
                }
            });

            Services.ajaxPOSTRequestJSON(
                'save',
                formData,
                /**
                 * @param data.variationData variation data
                 * @param data.variationData.variation_pairs that already exists in DB
                 */
                function (data) {
                    $that.data.maxVariantsCount = $that.data.maxVariantsCount - $that.getNewVariantsCount();
                    $('#variantsContainer').html('');
                    $that.data.newProductVariantIterator = 0;
                    $('#saveNewVariantsButton').addClass('hidden');

                    let $ajaxSuccessContainer = $('#ajaxSuccessList');

                    $ajaxSuccessContainer.removeClass('hidden');

                    let $productVariantsContainer = $('#productVariantsContainer');

                    window.TableView.search(1, 10, 'id', 'desc');

                    if ($productVariantsContainer.hasClass('hidden')) {
                        $productVariantsContainer.removeClass('hidden');
                    }

                    if (typeof data.variationData !== 'undefined' && typeof data.variationData.variation_pairs !== 'undefined') {
                        $that.data.variationPairs = data.variationData.variation_pairs;
                    }
                    $that.scrollTo($ajaxSuccessContainer, 55);
                },
                function (data) {
                    let $scrollTo = null;
                    if (typeof data.globalErrors !== 'undefined') {
                        $.each(data.globalErrors, function (messageKey, messageText) {
                            let $div = $('<div/>');
                            $div.html(messageText);
                            $ajaxErrorsContainer.append($div);
                            if (isModuleActive('not_production')) {
                                Services.commonToastNotification(messageText, 'danger', 'bottom-right', 5000);
                            }
                        });
                        $ajaxErrorsContainer.removeClass('hidden');
                        $scrollTo = $ajaxErrorsContainer;
                    } else {
                        $ajaxErrorsContainer.addClass('hidden');
                    }

                    if (typeof data.jsErrors !== 'undefined') {
                        Services.commonToastNotification(data.jsErrors[Object.keys(data.jsErrors)[0]], 'danger', 'bottom-right', 5000);
                        if ($scrollTo == null) {
                            $scrollTo = $($that.variantsFormValidator.errorList[0].element);
                        }
                    } else {
                        $that.variantsFormValidator.resetForm();
                    }

                    if ($scrollTo) {
                        $that.scrollTo($scrollTo, 55);
                    }
                },
                true,
                true
            );

            return false;
        });
    },

    getNewVariantsCount: function () {
        return $('#variantsContainer').find('.js-new-variant-container').length;
    },

    validateUniqueVariants: function () {
        let $that = this;
        let newVariantPairs = [];
        let valid = true;

        $('#variantsContainer').find('.js-new-variant-container').each(function () {
            let $this = $(this);
            let $warrantySelect = $this.find('.js-variant-warranty:first');

            let warrantyId = $warrantySelect.val();
            let pairKey = warrantyId;

            if ($that.isSizeVariation() || $that.isColorVariation()) {
                let $attributeInput = $this.find('.js-variant-attribute-id:first');
                let attributeId = $attributeInput.length === 1 ? $attributeInput.val() : null;

                if (attributeId === null) {
                    return;
                }

                pairKey = warrantyId + '_' + attributeId;
            }

            if (pairKey in newVariantPairs) {
                newVariantPairs[pairKey] = newVariantPairs[pairKey] + 1;
                let name = $warrantySelect.prop('name');
                $that.variantsFormValidator.showErrors(
                    {
                        [name]: 'گارانتی انتخاب شده برای تنوع جدید نمی‌تواند تکراری باشد',
                    }
                );
                valid = false;
            } else {
                newVariantPairs[pairKey] = 1;

                if (pairKey in $that.data.variationPairs) {
                    let name = $warrantySelect.prop('name');
                    $that.variantsFormValidator.showErrors(
                        {
                            [name]: 'گارانتی انتخاب شده، قبلا در تنوع‌ها استفاده شده است',
                        }
                    );
                    valid = false;
                }
            }
        });

        return valid;
    },

    initNewColorRequestModal: function () {
        let $that = this;
        let $form = $('#newColorRequestForm');
        let $ajaxColorErrorsList = $('#ajaxColorErrorsList');

        let $formValidator = $form.validate({
            rules: {
                'color[title]': {
                    required: true,
                    minlength: 1,
                    maxlength: 35
                },
                'color[product_image_id]': {
                    required: true
                }
            },
            messages: {
                'color[title]': {
                    'required': 'وارد کردن عنوان برای رنگ درخواستی اجباری است',
                    'minlength': 'عنوان وارد شده برای رنگ درخواستی نمی‌تواند کوتاه‌تر از 1 کاراکتر باشد',
                    'maxlength': 'عنوان وارد شده برای رنگ درخواستی نمی‌تواند طولانی‌تر از 35 کاراکتر باشد',
                },
                'color[product_image_id]': {
                    'required': 'آپلود تصویری از کالا برای تشخیص رنگ آن اجباری است'
                }
            }
        });

        const confirmModal = window.UIkit.modal('#newColorRequestModal', {
            bgClose: false,
        });

        $('#cancelColorRequestButton').click(function () {
            confirmModal.hide();
        });

        $('#saveColorRequestButton').click(function () {
            if (!$form.valid()) {
                return;
            }

            let $this = $(this);

            let $modalContainer = $('#newColorRequestModalContent');

            $ajaxColorErrorsList.addClass('hidden');
            $ajaxColorErrorsList.html('');

            Services.showLoader = function () {
                $modalContainer.addClass('c-content-loading');
                $this.addClass('disabled');
            };

            Services.hideLoader = function () {
                $modalContainer.removeClass('c-content-loading');
                $this.removeClass('disabled');
            };

            Services.ajaxPOSTRequestJSON(
                '/content/request/color/save/',
                $form.serializeArray(),
                function () {
                    confirmModal.hide();
                },
                function (data) {
                    if (typeof data.globalErrors !== 'undefined') {
                        $.each(data.globalErrors, function (messageKey, messageText) {
                            let $div = $('<div/>');
                            $div.html(messageText);
                            $ajaxColorErrorsList.append($div);
                        });
                        $ajaxColorErrorsList.removeClass('hidden');
                        $that.scrollTo($ajaxColorErrorsList, 55);
                    }

                    if (typeof data.jsErrors !== 'undefined') {
                        $formValidator.showErrors(data.jsErrors);
                    } else {
                        $formValidator.resetForm();
                    }
                },
                true,
                true
            );
        });

        $('#newColorRequestModalBtn').click(function () {
            $form.trigger('reset');
            $ajaxColorErrorsList.addClass('hidden');
            $ajaxColorErrorsList.html('');
            $('#uploadColorImageFirstPreview').prop('src', '');
            $('#uploadColorImageFirst').addClass('empty');
            $('#productImage1TempId').val('');
            $('#uploadColorImageSecondPreview').prop('src', '');
            $('#uploadColorImageSecond').addClass('empty');
            $('#productImage2TempId').val('');
            confirmModal.show();
            $formValidator.resetForm();

            return false;
        });
    },

    initNewSizeRequestModal: function () {
        let $that = this;
        let $form = $('#newSizeRequestForm');
        let $ajaxSizeErrorsList = $('#ajaxSizeErrorsList');

        let $formValidator = $form.validate({
            rules: {
                'size[title]': {
                    required: true,
                    minlength: 1,
                    maxlength: 35
                }
            },
            messages: {
                'size[title]': {
                    'required': 'وارد کردن عنوان برای سایز اجباری است',
                    'minlength': 'عنوان وارد شده برای سایز درخواستی نمی‌تواند کوتاه‌تر از 1 کاراکتر باشد',
                    'maxlength': 'عنوان وارد شده برای سایز درخواستی نمی‌تواند طولانی‌تر از 35 کاراکتر باشد',
                }
            }
        });

        const confirmModal = window.UIkit.modal('#newSizeRequestModal', {
            bgClose: false,
        });

        $('#cancelSizeRequestButton').click(function () {
            confirmModal.hide();
        });

        $('#saveSizeRequestButton').click(function () {
            if (!$form.valid()) {
                return;
            }

            let $this = $(this);

            let $modalContainer = $('#newSizeRequestModalContent');

            $ajaxSizeErrorsList.addClass('hidden');
            $ajaxSizeErrorsList.html('');

            Services.showLoader = function () {
                $modalContainer.addClass('c-content-loading');
                $this.addClass('disabled');
            };

            Services.hideLoader = function () {
                $modalContainer.removeClass('c-content-loading');
                $this.removeClass('disabled');
            };

            Services.ajaxPOSTRequestJSON(
                '/content/request/size/save/',
                $form.serializeArray(),
                function () {
                    confirmModal.hide();
                },
                function (data) {
                    if (typeof data.globalErrors !== 'undefined') {
                        $.each(data.globalErrors, function (messageKey, messageText) {
                            let $div = $('<div/>');
                            $div.html(messageText);
                            $ajaxSizeErrorsList.append($div);
                        });
                        $ajaxSizeErrorsList.removeClass('hidden');
                        $that.scrollTo($ajaxSizeErrorsList, 55);
                    }

                    if (typeof data.jsErrors !== 'undefined') {
                        $formValidator.showErrors(data.jsErrors);
                    } else {
                        $formValidator.resetForm();
                    }
                },
                true,
                true
            );
        });

        $('#newSizeRequestModalBtn').click(function () {
            $form.trigger('reset');
            $ajaxSizeErrorsList.addClass('hidden');
            $ajaxSizeErrorsList.html('');
            confirmModal.show();
            $formValidator.resetForm();

            return false;
        });
    },

    initNewWarrantyRequestModal: function () {
        let $that = this;
        let $form = $('#newWarrantyRequestForm');
        let $ajaxWarrantyErrorsList = $('#ajaxWarrantyErrorsList');

        let $formValidator = $form.validate({
            rules: {
                'warranty[warranty_title]': {
                    required: true,
                    minlength: 1,
                    maxlength: 100,
                },
                'warranty[warranty_period]': {
                    required: true,
                    digits: true,
                    min: 1
                },
                'warranty[warranty_image_id_1]': {
                    required: function () {
                        return !$('#warrantyImageTempIdBack').val();
                    }
                },
                'warranty[warranty_image_id_2]': {
                    required: function () {
                        return !$('#warrantyImageTempIdFront').val();
                    }
                },
                'warranty[insurance_title]': {
                    required: true,
                    minlength: 1,
                    maxlength: 100,
                },
                'warranty[insurance_period]': {
                    required: true,
                    digits: true,
                    min: 1
                },
                'warranty[insurance_image_id_1]': {
                    required: function () {
                        return !$('#insuranceImageTempIdBack').val();
                    }
                },
                'warranty[insurance_image_id_2]': {
                    required: function () {
                        return !$('#insuranceImageTempIdFront').val();
                    }
                }
            },
            messages: {
                'warranty[warranty_title]': {
                    'required': 'وارد کردن عنوان برای گارانتی اجباری است',
                    'minlength': 'عنوان وارد شده برای گارانتی درخواستی نمی‌تواند کوتاه‌تر از 1 کاراکتر باشد',
                    'maxlength': 'عنوان وارد شده برای گارانتی درخواستی نمی‌تواند طولانی‌تر از 35 کاراکتر باشد'
                },
                'warranty[warranty_period]': {
                    'required': 'وارد کردن مدت زمان گارانتی اجباری است',
                    'digits': 'فقط مجاز به استفاده از عدد برای مدت زمان گارانتی هستید',
                    'min': 'مدت زمان گارانتی نمی‌تواند کمتر از یک ماه باشد'
                },
                'warranty[warranty_image_id_1]': {
                    'required': 'آپلود تصویری از برگه گارانتی اجباری است',
                },
                'warranty[warranty_image_id_2]': {
                    'required': 'آپلود تصویری از برگه گارانتی اجباری است',
                },
                'warranty[insurance_title]': {
                    'required': 'وارد کردن عنوان برای بیمه اجباری است',
                    'minlength': 'عنوان وارد شده برای بیمه درخواستی نمی‌تواند کوتاه‌تر از 1 کاراکتر باشد',
                    'maxlength': 'عنوان وارد شده برای بیمه درخواستی نمی‌تواند طولانی‌تر از 35 کاراکتر باشد'
                },
                'warranty[insurance_period]': {
                    'required': 'وارد کردن مدت زمان برای بیمه اجباری است',
                    'digits': 'فقط مجاز به استفاده از عدد برای مدت زمان بیمه هستید',
                    'min': 'مدت زمان بیمه نمی‌تواند کمتر از یک ماه باشد'
                },
                'warranty[insurance_image_id_1]': {
                    'required': 'آپلود تصویری از برگه بیمه اجباری است',
                },
                'warranty[insurance_image_id_2]': {
                    'required': 'آپلود تصویری از برگه بیمه اجباری است',
                },
            }
        });

        const confirmModal = window.UIkit.modal('#newWarrantyRequestModal', {
            bgClose: false,
        });

        $('#cancelWarrantyRequestButton').click(function () {
            confirmModal.hide();
        });

        $('#saveWarrantyRequestButton').click(function () {
            if (!$form.valid()) {
                return;
            }

            let $this = $(this);

            let $modalContainer = $('#newWarrantyRequestModalContent');

            $ajaxWarrantyErrorsList.addClass('hidden');
            $ajaxWarrantyErrorsList.html('');

            Services.showLoader = function () {
                $modalContainer.addClass('c-content-loading');
                $this.addClass('disabled');
            };

            Services.hideLoader = function () {
                $modalContainer.removeClass('c-content-loading');
                $this.removeClass('disabled');
            };

            Services.ajaxPOSTRequestJSON(
                '/content/request/warranty/save/',
                $form.serializeArray(),
                function () {
                    confirmModal.hide();
                },
                function (data) {
                    if (typeof data.globalErrors !== 'undefined') {
                        $.each(data.globalErrors, function (messageKey, messageText) {
                            let $div = $('<div/>');
                            $div.html(messageText);
                            $ajaxWarrantyErrorsList.append($div);
                        });
                        $ajaxWarrantyErrorsList.removeClass('hidden');
                        $that.scrollTo($ajaxWarrantyErrorsList, 55);
                    }

                    if (typeof data.jsErrors !== 'undefined') {
                        $formValidator.showErrors(data.jsErrors);
                    } else {
                        $formValidator.resetForm();
                    }
                },
                true,
                true
            );
        });

        $(document).on('click', '.js-request-new-warranty', function () {
            $form.trigger('reset');

            /* Warranty Front */
            $('#warrantyImagePreviewFront').prop('src', '');
            $('#uploadWarrantyImageFront').closest('.c-content-modal__uploads-label').addClass('empty');
            $('#warrantyImageTempIdFront').val('');

            /* Warranty Back */
            $('#warrantyImagePreviewBack').prop('src', '');
            $('#uploadWarrantyImageBack').closest('.c-content-modal__uploads-label').addClass('empty');
            $('#warrantyImageTempIdBack').val('');

            /* Insurance Front */
            $('#insuranceImagePreviewFront').prop('src', '');
            $('#uploadInsuranceImageFront').closest('.c-content-modal__uploads-label').addClass('empty');
            $('#insuranceImageTempIdFront').val('');

            /* Insurance Back */
            $('#insuranceImagePreviewBack').prop('src', '');
            $('#uploadInsuranceImageBack').closest('.c-content-modal__uploads-label').addClass('empty');
            $('#insuranceImageTempIdBack').val('');


            $ajaxWarrantyErrorsList.addClass('hidden');
            $ajaxWarrantyErrorsList.html('');
            confirmModal.show();
            $formValidator.resetForm();
            return false;
        });

        $('#warrantyHasInsurance').on('change', function () {
            let $this = $(this);
            const $insuranceContainer = $('#insuranceContainer');
            if ($this.prop('checked')) {
                $insuranceContainer.show();
                $('#insuranceTitle').prop('disabled', false).removeClass('disabled');
                $('#insurancePeriod').prop('disabled', false).removeClass('disabled');
                $('#insuranceImageTempIdFront').prop('disabled', false).removeClass('disabled');
                $('#insuranceImageTempIdBack').prop('disabled', false).removeClass('disabled');
            } else {
                $('#insuranceTitle').val('').prop('disabled', true).addClass('disabled');
                $('#insurancePeriod').val('').prop('disabled', true).addClass('disabled');
                $('#insuranceImageTempIdFront').prop('disabled', true).removeClass('disabled');
                $('#insuranceImageTempIdBack').prop('disabled', true).removeClass('disabled');
                $insuranceContainer.hide();
            }
            $formValidator.resetForm();
        });
    },

    initMeasurementModal: function () {
        $(document).on('click', '#measuringRequestModalBtn', function () {
            const confirmModal = window.UIkit.modal('#measuringRequestModal');
            new Promise(function (resolve, reject) {
                confirmModal.show();
                $('.js-accept').on('click', function () {
                    resolve();
                });
                $('.js-decline').on('click', function () {
                    reject();
                });
            }).then(function () {
            }).catch(function () {
            }).finally(function () {
                confirmModal.hide();
            });

            return false;
        })
    },

    scrollTo: function (element, topOffset) {
        $('html, body').animate({
            scrollTop: element.offset().top - topOffset
        }, 500);
    },

    initEditVariantControls: function () {
        let $that = this;
        $(document).on('click', '.js-variant-edit-btn', function () {

            if ( isModuleActive('variant_gold_price') && window['goldPriceParameters'] ) {
               window.GoldPriceAction.initGoldPriceEditFieldsChangeHandler();
            }

            $that.switchToEdit($(this).data('id'));

            // GTag part
            IndexAction.productId = $(this).parents('tr').siblings('tr').eq(1)
                .find('[name="product_variant[product_id]"]').eq(0).val();
            addGTag({event_action: 'Click on "edit product"', event_label: IndexAction.productId});
            // GTag part end

            window.Main.initThousandSeparator();
            $that.initUiSelect();
            return false;
        });

        $(document).on('click', '.js-variant-cancel-edit', function () {
            addGTag({event_action: 'Click on "cancel product"', event_label: IndexAction.productId});

            $that.switchToView($(this).data('id'));
            return false;
        });
    },

    initSaveEditVariant: function () {
        let $that = this;
        $(document).on('click', '.js-variant-save-edit', function () {
            let $this = $(this);
            let productVariantId = $this.data('id');
            let $form = $('#editVariant_' + productVariantId);

            // addGTag({event_action: 'Click on "save product"', event_label: IndexAction.productId});

            let validator = $form.validate();

            validator.destroy();

            if (window.isShipBySellerModuleActive) {
                let $formLeadTime = $form.find('.js-edit-lead-time').val();
                var rules = {
                    'product_variant[shipping_type_seller]': {
                        min: 0,
                    },
                    'product_variant[fbs_lead_time]': {
                        required: true,
                        digits: true,
                        min: 1,
                        max: $formLeadTime ? parseInt($formLeadTime) * 24 + 1: 241,
                    },
                    'product_variant[order_limit]': {
                        required: true,
                        digits: true,
                        min: 1,
                        // max: 30,
                    },
                    'product_variant[marketplace_seller_stock]': {
                        required: true,
                        digits: true,
                        min: 0,
                        max: 30000
                    },
                    'product_variant[supplier_code]': {
                        maxlength: 255,
                    },
                    'product_variant[price]': {
                        required: true,
                        digits: true,
                        min: 0,
                        price_mod_hundred: true,
                    },
                    'product_variant[length]': {
                        splitByDot: true,
                        required: true,
                    },
                    'product_variant[width]': {
                        splitByDot: true,
                        required: true,
                    },
                    'product_variant[height]': {
                        splitByDot: true,
                        required: true,
                    },
                    'product_variant[weight]': {
                        splitByDot: true,
                        required: true,
                    },
                };

                if ( IndexAction.goldPriceInfo.staticData.lgp ) {
                    rules['product_variant[non_gold_parts_cost]'] = { required:  true};
                    rules['product_variant[non_gold_parts_wage]'] = { required:  true};
                    rules['product_variant[gold_profit]'] = { required:  true};
                    rules['product_variant[gold_wage]'] = { required:  true};
                }

                if((!isModuleActive('only_fbs')) && $(`.js-shipping-type-digikala[data-id="${productVariantId}"]`).is(':checked')){

                    rules['product_variant[lead_time]'] = {
                        digits: true,
                        min: 1,
                        max: 365,
                    };

                    rules['product_variant[shipping_type_digikala]'] = {
                        at_least_one_shipping_type: true
                    };
                }

                var messages = {
                    'product_variant[shipping_type_digikala]': {
                        'at_least_one_shipping_type': 'انتخاب نوع ارسال اجباری است'
                    },
                    'product_variant[lead_time]': {
                        'required': 'وارد کردن بازه‌ی زمانی ارسال اجباری است',
                        'digits': 'فقط مجاز به استفاده از عدد برای بازه‌ی زمانی ارسال هستید',
                        'min': 'بازه‌ی زمانی ارسال نمی‌تواند کمتر از یک روز باشد',
                        'max': 'بازه‌ی زمانی ارسال نمی‌تواند بیشتر از سیصد و شست و پنج روز باشد'
                    },
                    'product_variant[fbs_lead_time]': {
                        'required': 'وارد کردن بازه‌ی زمانی ارسال اجباری است',
                        'digits': 'فقط مجاز به استفاده از عدد برای بازه‌ی زمانی ارسال هستید',
                        'min': 'بازه‌ی زمانی ارسال نمی‌تواند کمتر از یک روز باشد',
                        'max': 'بازه زمانی ارسال فروشنده نمیتواند بیشتر از بازه زمانی ارسال دیجیکالا باشد'
                    },
                    'product_variant[order_limit]': {
                        'required': 'وارد کردن تعداد برای سفارش مشتریان اجباری است',
                        'digits': 'فقط مجاز به استفاده از عدد برای سفارش مشتریان هستید',
                        'min': 'حداقل سفارش مشتریان نمی‌تواند کمتر از 1 باشد',
                        'max': 'حداکثر تعداد سفارش مشتریان نمی‌تواند بیشتر از 30 باشد'
                    },
                    'product_variant[marketplace_seller_stock]': {
                        'required': 'وارد کردن موجودی نزد شما اجباری است',
                        'digits': 'فقط مجاز به استفاده از عدد برای موجودی هستید',
                        'min': 'مقدار موجودی ارسال به انبار نمی‌تواند بیشتر از 10000 عدد باشد',
                        'max': 'مقدار موجودی ارسال به انبار نمی‌تواند بیشتر از 10000 عدد باشد'
                    },
                    'product_variant[supplier_code]': {
                        'maxlength': 'مقدار وارد شده برای کد فروشنده نمی‌تواند طولانی‌تر از 255 کاراکتر باشد'
                    },
                    'product_variant[price]': {
                        'required': 'وارد کردن قیمت اجباری است',
                        'digits': 'فقط مجاز به استفاده از عدد برای قیمت هستید',
                        'min': 'قیمت نمی‌تواند کمتر‌تر از ۱۰۰ ریال باشد',
                        'price_mod_hundred': 'فرمت وارد شده برای قیمت صحیح نیست، قیمت باید به 00 ختم شود',
                    },

                    'product_variant[buy_price]': {
                        'digits': 'فقط مجاز به استفاده از عدد برای قیمت هستید',
                        'price_mod_hundred': 'فرمت وارد شده برای قیمت صحیح نیست، قیمت باید به 00 ختم شود',
                    },
                    'product_variant[length]': {
                        'required': 'وارد کردن ابعاد اجباری است',
                        'splitByDot': 'کاراکترهای مجاز شامل عدد و نقطه (.) می‌باشد.'
                    },
                    'product_variant[width]': {
                        'required': 'وارد کردن ابعاد اجباری است',
                        'splitByDot': 'کاراکترهای مجاز شامل عدد و نقطه (.) می‌باشد.'
                    },
                    'product_variant[height]': {
                        'required': 'وارد کردن ابعاد اجباری است',
                        'splitByDot': 'کاراکترهای مجاز شامل عدد و نقطه (.) می‌باشد.'
                    },
                    'product_variant[weight]': {
                        'required': 'وارد کردن وزن اجباری است',
                        'splitByDot': 'کاراکترهای مجاز شامل عدد و نقطه (.) می‌باشد.'
                    },
                    'product_variant[gold_wage]': {
                        'required': 'وارد کردن دستمزد اجباری است'
                    },
                    'product_variant[non_gold_parts_cost]': {
                        'required': 'وارد کردن قیمت بخش های غیر طلا اجباری است'
                    },
                    'product_variant[non_gold_parts_wage]': {
                        'required': 'وارد کردن قیمت دستمزد بخش های غیر طلا اجباری است'
                    },
                    'product_variant[gold_profit]': {
                        'required': 'وارد کردن سود اجباری است'
                    },

                };

                validator = $form.validate({
                    rules,
                    messages
                });
            } else {
                var rules = {
                    'product_variant[shipping_type_digikala]': {
                        at_least_one_shipping_type: true
                    },
                    'product_variant[lead_time]': {
                        required: true,
                            digits: true,
                            min: 1,
                            // max: 10,
                    },
                    'product_variant[order_limit]': {
                        required: true,
                            digits: true,
                            min: 1,
                            // max: 30,
                    },
                    'product_variant[marketplace_seller_stock]': {
                        required: true,
                            digits: true,
                            min: 0,
                            max: 30000
                    },
                    'product_variant[supplier_code]': {
                        maxlength: 255,
                    },
                    'product_variant[price]': {
                        required: true,
                            digits: true,
                            min: 0,
                            price_mod_hundred: true,
                    },
                    'product_variant[length]': {
                        splitByDot: true,
                            required: true,
                    },
                    'product_variant[width]': {
                        splitByDot: true,
                            required: true,
                    },
                    'product_variant[height]': {
                        splitByDot: true,
                            required: true,
                    },
                    'product_variant[weight]': {
                        splitByDot: true,
                            required: true,
                    },
                };
                var messages = {
                    'product_variant[shipping_type_digikala]': {
                        'at_least_one_shipping_type': 'انتخاب نوع ارسال اجباری است'
                    },
                    'product_variant[lead_time]': {
                        'required': 'وارد کردن بازه‌ی زمانی ارسال اجباری است',
                            'digits': 'فقط مجاز به استفاده از عدد برای بازه‌ی زمانی ارسال هستید',
                            'min': 'بازه‌ی زمانی ارسال نمی‌تواند کمتر از یک روز باشد',
                            'max': 'بازه‌ی زمانی ارسال نمی‌تواند بیشتر از ده روز باشد'
                    },
                    'product_variant[order_limit]': {
                        'required': 'وارد کردن تعداد برای سفارش مشتریان اجباری است',
                            'digits': 'فقط مجاز به استفاده از عدد برای سفارش مشتریان هستید',
                            'min': 'حداقل سفارش مشتریان نمی‌تواند کمتر از 1 باشد',
                            'max': 'حداکثر تعداد سفارش مشتریان نمی‌تواند بیشتر از 30 باشد'
                    },
                    'product_variant[marketplace_seller_stock]': {
                        'required': 'وارد کردن موجودی نزد شما اجباری است',
                            'digits': 'فقط مجاز به استفاده از عدد برای موجودی هستید',
                            'min': 'مقدار موجودی ارسال به انبار نمی‌تواند بیشتر از 10000 عدد باشد',
                            'max': 'مقدار موجودی ارسال به انبار نمی‌تواند بیشتر از 10000 عدد باشد'
                    },
                    'product_variant[supplier_code]': {
                        'maxlength': 'مقدار وارد شده برای کد فروشنده نمی‌تواند طولانی‌تر از 255 کاراکتر باشد'
                    },
                    'product_variant[price]': {
                        'required': 'وارد کردن قیمت اجباری است',
                            'digits': 'فقط مجاز به استفاده از عدد برای قیمت هستید',
                            'min': 'قیمت نمی‌تواند کمتر‌تر از ۱۰۰ ریال باشد',
                            'price_mod_hundred': 'فرمت وارد شده برای قیمت صحیح نیست، قیمت باید به 00 ختم شود',
                    },
                    'product_variant[length]': {
                        'required': 'وارد کردن ابعاد اجباری است',
                            'splitByDot': 'کاراکترهای مجاز شامل عدد و نقطه (.) می‌باشد.'
                    },
                    'product_variant[width]': {
                        'required': 'وارد کردن ابعاد اجباری است',
                            'splitByDot': 'کاراکترهای مجاز شامل عدد و نقطه (.) می‌باشد.'
                    },
                    'product_variant[height]': {
                        'required': 'وارد کردن ابعاد اجباری است',
                            'splitByDot': 'کاراکترهای مجاز شامل عدد و نقطه (.) می‌باشد.'
                    },
                    'product_variant[weight]': {
                        'required': 'وارد کردن وزن اجباری است',
                            'splitByDot': 'کاراکترهای مجاز شامل عدد و نقطه (.) می‌باشد.'
                    },
                    'product_variant[gold_wage]': {
                        'required': 'وارد کردن دستمزد اجباری است'
                    },
                    'product_variant[non_gold_parts_cost]': {
                        'required': 'وارد کردن قیمت بخش های غیر طلا اجباری است'
                    },
                    'product_variant[non_gold_parts_wage]': {
                        'required': 'وارد کردن قیمت دستمزد بخش های غیر طلا اجباری است'
                    },
                    'product_variant[gold_profit]': {
                        'required': 'وارد کردن سود اجباری است'
                    },
                };

                if ( IndexAction.goldPriceInfo.staticData.lgp ) {
                    rules['product_variant[non_gold_parts_cost]'] = { required:  true};
                    rules['product_variant[non_gold_parts_wage]'] = { required:  true};
                    rules['product_variant[gold_profit]'] = { required:  true};
                    rules['product_variant[gold_wage]'] = { required:  true};
                }

                validator = $form.validate({
                    rules,
                    messages
                });
            }
            if (!$form.valid()) {
                return false;
            }

            let $productVariantEditRow = $('#productVariantEditRow_' + productVariantId);
            let $ajaxErrorsContainer = $productVariantEditRow.find('.js-edit-error:first');

            let $metaEditFormVariant = $('#metaEditFormVariant_' + productVariantId);

            $ajaxErrorsContainer.html('');
            $ajaxErrorsContainer.addClass('hidden');

            Services.showLoader = function () {
                $metaEditFormVariant.addClass('c-content-loading');
                $this.addClass('disabled');
            };

            Services.hideLoader = function () {
                $metaEditFormVariant.removeClass('c-content-loading');
                $this.removeClass('disabled');
            };

            var formData = $form.serializeArray();
            formData.forEach(function(item) {
                item.value = Services.convertToEnDigit(item.value).split(',').join('');
                if ( Number(item.value) ) {
                    // divide percent values to float values
                    if ( item.name.search('gold_wage') !== -1 || item.name.search('gold_profit') !== -1 )
                        item.value = Number(item.value) / 100;
                    else
                        item.value = Number(item.value);
                }
            });

            Services.ajaxPOSTRequestJSON(
                'update',
                formData,
                /**
                 * @param data
                 * @param data.active is active after save
                 * @param data.active_int is active as int after save
                 * @param data.lead_time_fa lead_time in farsi after save
                 * @param data.lead_time lead_time after save
                 * @param data.marketplace_seller_stock_fa marketplace_seller_stock in farsi after save
                 * @param data.marketplace_seller_stock marketplace_seller_stock after save
                 * @param data.order_limit_fa order_limit in farsi after save
                 * @param data.order_limit order_limit after save
                 * @param data.supplier_code supplier_code after save
                 * @param data.sale_price_fa sale_price in farsi after save
                 * @param data.sale_price sale_price after save
                 * @param data.shipping_type.dk_shipping dk_shipping after save
                 * @param data.shipping_type.seller_shipping seller_shipping after save
                 * @param data.channels.dk_channel_checked dk_channel_checked after save
                 * @param data.channels.ds_channel_checked ds_channel_checked after save
                 * @param data.channels.both_channel_checked both_channel_checked after save
                 * @param data.notice notice message after save
                 * @param data.fbs_lead_time ship by seller lead time
                 */
                function (data) {
                    validator.resetForm();

                    let $productVariantViewRow = $('#productVariantViewRow_' + productVariantId);
                    let $activeIndicator = $productVariantViewRow.find('.js-td-active:first');

                    $activeIndicator
                        .removeClass('active')
                        .removeClass('inactive');

                    let $jsActiveCheckbox = $productVariantEditRow.find('.js-edit-active:first');

                    $jsActiveCheckbox.data('default-value', data.active_int);

                    if (data.active_int) {
                        console.log('is true');
                        $('#span_' + productVariantId).removeClass("c-wallet__body-card-status-no-circle--danger");
                        $('#span_' + productVariantId).addClass("c-wallet__body-card-status-no-circle--active");
                        $('#span_' + productVariantId).text('فعال');
                    } else {
                        console.log('is false');
                        $('#span_' + productVariantId).removeClass("c-wallet__body-card-status-no-circle--active");
                        $('#span_' + productVariantId).addClass("c-wallet__body-card-status-no-circle--danger");
                        $('#span_' + productVariantId).text('غیرفعال');
                    }

                    if (window.dimensionLevel === 'item') {
                        let $packageLengthText = $productVariantEditRow.find('.js-view-package-length:first');
                        $packageLengthText.text(data.dimension.package_length.toLocaleString('fa'));

                        let $jsPackageLengthInput = $productVariantEditRow.find('.js-edit-package-length:first');
                        $jsPackageLengthInput.val(data.dimension.package_length);
                        $jsPackageLengthInput.data('default-value', data.dimension.package_length);

                        let $packageWidthText = $productVariantEditRow.find('.js-view-package-width:first');
                        $packageWidthText.text(data.dimension.package_width.toLocaleString('fa'));

                        let $jsPackageWidthInput = $productVariantEditRow.find('.js-edit-package-width:first');
                        $jsPackageWidthInput.val(data.dimension.package_width);
                        $jsPackageWidthInput.data('default-value', data.dimension.package_width);

                        let $packageHeightText = $productVariantEditRow.find('.js-view-package-height:first');
                        $packageHeightText.text(data.dimension.package_height.toLocaleString('fa'));

                        let $jsPackageHeightInput = $productVariantEditRow.find('.js-edit-package-height:first');
                        $jsPackageHeightInput.val(data.dimension.package_height);
                        $jsPackageHeightInput.data('default-value', data.dimension.package_height);

                        let $packageWeightText = $productVariantEditRow.find('.js-view-package-weight:first');
                        $packageWeightText.text(data.dimension.package_weight.toLocaleString('fa'));

                        let $jsPackageWeightInput = $productVariantEditRow.find('.js-edit-package-weight:first');
                        $jsPackageWeightInput.val(data.dimension.package_weight);
                        $jsPackageWeightInput.data('default-value', data.dimension.package_weight);
                    }

                    let $leadTimeText = $productVariantEditRow.find('.js-view-lead-time:first');
                    $leadTimeText.text(data.lead_time_fa);

                    let $jsLeadTimeInput = $productVariantEditRow.find('.js-edit-lead-time:first');
                    $jsLeadTimeInput.val(data.lead_time);
                    $jsLeadTimeInput.data('default-value', data.lead_time);

                    let $marketplaceSellerStockText = $productVariantEditRow.find('.js-view-marketplace-seller-stock:first');
                    $marketplaceSellerStockText.text(data.marketplace_seller_stock_fa);

                    let $jsMarketplaceSellerStockInput = $productVariantEditRow.find('.js-edit-marketplace-seller-stock:first');
                    $jsMarketplaceSellerStockInput.val(data.marketplace_seller_stock);
                    $jsMarketplaceSellerStockInput.data('default-value', data.marketplace_seller_stock);

                    let $jsOldMarketplaceSellerStockInput = $productVariantEditRow.find('.js-edit-old-marketplace-seller-stock:first');
                    $jsOldMarketplaceSellerStockInput.val(data.marketplace_seller_stock);
                    $jsOldMarketplaceSellerStockInput.data('default-value', data.marketplace_seller_stock);

                    let $orderLimitText = $productVariantEditRow.find('.js-view-order-limit:first');
                    $orderLimitText.text(data.order_limit_fa);

                    let $jsOrderLimitInput = $productVariantEditRow.find('.js-edit-order-limit:first');
                    $jsOrderLimitInput.val(data.order_limit);
                    $jsOrderLimitInput.data('default-value', data.order_limit);

                    let $supplierCodeText = $productVariantEditRow.find('.js-view-supplier-code:first');
                    $supplierCodeText.text(data.supplier_code);

                    let $jsSupplierCodeInput = $productVariantEditRow.find('.js-edit-supplier-code:first');
                    $jsSupplierCodeInput.val(data.supplier_code);
                    $jsSupplierCodeInput.data('default-value', data.supplier_code);

                    let $priceText = $productVariantEditRow.find('.js-view-price:first');
                    $priceText.text(data.sale_price_fa);

                    let $jsPriceInput = $productVariantEditRow.find('.js-edit-price:first');
                    $jsPriceInput.val(data.sale_price);
                    $jsPriceInput.data('default-value', data.sale_price);




                    let $buyPriceText = $productVariantEditRow.find('.js-view-buy-price:first');
                    $buyPriceText.text(data.buy_price_fa);

                    let $ByPriceInput = $productVariantEditRow.find('.js-edit-buy-price:first');
                    $ByPriceInput.val(data.buy_price);
                    $ByPriceInput.data('default-value', data.buy_price);




                    let $jsShippingTypeDigikalaCheckbox = $productVariantEditRow.find('.js-shipping-type-digikala:first');
                    let $shippingTypeDigikalaIndicator = $productVariantViewRow.find('.js-view-shipping-type-digikala:first');
                    if (data.shipping_type.dk_shipping) {
                        $jsShippingTypeDigikalaCheckbox.prop('checked', true);
                        $shippingTypeDigikalaIndicator.addClass('active')
                    } else {
                        $jsShippingTypeDigikalaCheckbox.prop('checked', false);
                        $shippingTypeDigikalaIndicator.removeClass('active')
                    }
                    $jsShippingTypeDigikalaCheckbox.data('default-value', data.shipping_type.dk_shipping);

                    let $jsShippingTypeSellerCheckbox = $productVariantEditRow.find('.js-shipping-type-seller:first');
                    let $shippingTypeSellerIndicator = $productVariantViewRow.find('.js-view-shipping-type-seller:first');
                    if (data.shipping_type.seller_shipping) {
                        $jsShippingTypeSellerCheckbox.prop('checked', true);
                        $shippingTypeSellerIndicator.addClass('active')
                    } else {
                        $jsShippingTypeSellerCheckbox.prop('checked', false);
                        $shippingTypeSellerIndicator.removeClass('active');
                    }
                    $jsShippingTypeSellerCheckbox.data('default-value', data.shipping_type.seller_shipping);

                    let $siteDigikalaIndicator = $productVariantViewRow.find('.js-view-site-digikala:first');
                    let $siteDigistyleIndicator = $productVariantViewRow.find('.js-view-site-digistyle:first');

                    $siteDigikalaIndicator.removeClass('active');
                    $siteDigistyleIndicator.removeClass('active');

                    let $jsSiteDigikalaRadio = $productVariantEditRow.find('.js-site-digikala:first');
                    if (data.channels.dk_channel_checked) {
                        $jsSiteDigikalaRadio.prop('checked', true);
                        $siteDigikalaIndicator.addClass('active');
                    } else {
                        $jsSiteDigikalaRadio.prop('checked', false);
                    }
                    $jsSiteDigikalaRadio.data('default-value', data.channels.dk_channel_checked);

                    let $jsSiteDigistyleRadio = $productVariantEditRow.find('.js-site-digistyle:first');
                    if (data.channels.ds_channel_checked) {
                        $jsSiteDigistyleRadio.prop('checked', true);
                        $siteDigistyleIndicator.addClass('active');
                    } else {
                        $jsSiteDigistyleRadio.prop('checked', false);
                    }
                    $jsSiteDigistyleRadio.data('default-value', data.channels.ds_channel_checked);

                    let $jsSiteBothRadio = $productVariantEditRow.find('.js-site-both:first');
                    if (data.channels.both_channel_checked) {
                        $jsSiteBothRadio.prop('checked', true);
                        $siteDigikalaIndicator.addClass('active');
                        $siteDigistyleIndicator.addClass('active');
                    } else {
                        $jsSiteBothRadio.prop('checked', false);
                    }
                    $jsSiteBothRadio.data('default-value', data.channels.both_channel_checked);

                    $that.switchToView(productVariantId);

                    let warningContainer = $productVariantEditRow.find('.js-save-warning:first');

                    warningContainer.html('');

                    if (window.isShipBySellerModuleActive) {
                        if (data.shipping_type.seller_shipping) {
                            $productVariantViewRow.find('[id*=productVariantShipBySellerIcon]').removeClass('uk-hidden').addClass('active');
                            let productFbsLeadTimeTextEl = $productVariantViewRow.find('[id*=productVariantFbsLeadTime]');

                            if (data.fbs_lead_time < 24) {
                                productFbsLeadTimeTextEl
                                    .removeClass('uk-hidden')
                                    .html(
                                        '<span>' +
                                        'همانروز -تا '
                                        +
                                            Services.convertToFaDigit(data.fbs_lead_time)
                                        + ' ساعت ' +
                                        '</span>'
                                    );
                            } else {
                                productFbsLeadTimeTextEl
                                    .removeClass('uk-hidden')
                                    .html(
                                        Services.convertToFaDigit(Math.floor(data.fbs_lead_time /24)) + ' ' + 'روز'
                                    );
                            }
                        }
                    }

                    if (typeof data.notice !== 'undefined') {
                        warningContainer.html('<div>' + data.notice + '</div>');
                        warningContainer.fadeIn(
                            1,
                            function () {
                                setTimeout(function () {
                                    warningContainer.fadeOut()
                                }, 10000);
                            }
                        );
                    }

                    if ( isModuleActive('variant_gold_price') ) {
                        var $variantRow = $($this).parents('.js-variant-row');
                        $variantRow.find('.js-variant-info-gold-wage').html(Services.convertToFaDigit($variantRow.find('input.js-variant-edit-gold-price-info[data-name=gw]').val()));
                        $variantRow.find('.js-variant-info-gold-ngp').html(Services.convertToFaDigit($variantRow.find('input.js-variant-edit-gold-price-info[data-name=ngp]').val()));
                        $variantRow.find('.js-variant-info-gold-ngw').html(Services.convertToFaDigit($variantRow.find('input.js-variant-edit-gold-price-info[data-name=ngw]').val()));
                        $variantRow.find('.js-variant-info-profit').html(Services.convertToFaDigit($variantRow.find('input.js-variant-edit-gold-price-info[data-name=profit]').val()));
                    }


                    if (data.active_int) {
                        $('#status_' + productVariantId).prop('checked', true);
                    }

                },
                function (data) {
                    if (typeof data.globalErrors !== 'undefined') {
                        $.each(data.globalErrors, function (messageKey, messageText) {
                            let $p = $('<p/>');
                            $p.text(messageText);
                            if (isModuleActive('not_production')) {
                                Services.commonToastNotification(messageText, 'danger', 'bottom-right', 5000);
                            }
                            $ajaxErrorsContainer.append($p);
                        });
                        $ajaxErrorsContainer.removeClass('hidden');
                    }

                    if (typeof data.jsErrors !== 'undefined') {
                        validator.showErrors(data.jsErrors);
                        if (isModuleActive('not_production')) {
                            Services.commonToastNotification(data.jsErrors[Object.keys(data.jsErrors)[0]], 'danger', 'bottom-right', 5000);
                        }
                    } else {
                        validator.resetForm();
                    }
                },
                true,
                true
            );

            return false;
        });

        if (window.isShipBySellerModuleActive) {
            let $productVariantIteratorKey = 'product_variant['
            let shipBySeller = $('.js-shipping-type-seller');
            shipBySeller.prop('disabled', false);
            if (!window.hasActiveSetting) {
                shipBySeller.prop('disabled', true)
                shipBySeller.parent().parent().parent().find('.c-nccp-tooltip').addClass('c-nccp-tooltip--visible');
            }

            if (isModuleActive('only_fbs')) {
                $('.js-shipping-type-digikala').on('change', function () {
                    let variantId = $(this).data('id');
                    var $leadTime = $(`.js-edit-lead-time[data-id="${variantId}"]`);
                    if (!$(this).is(':checked')) {
                        $leadTime.attr('disabled', true);
                        $leadTime.parent('div').addClass('new-sbs-lead-time-field-wrapper__first-select--disabled');
                    } else {
                        $leadTime.attr('disabled', false);
                        $leadTime.parent('div').removeClass('new-sbs-lead-time-field-wrapper__first-select--disabled');
                    }
                });
            }

            shipBySeller.prop('name', $productVariantIteratorKey + 'shipping_type_seller]');
            $(document).on('click', '.js-shipping-type-seller', function () {
                let hiddenShipBySellerInput = $('<input type="hidden"  class="js-empty-shipping-type-seller-edit" value="0"/>');
                hiddenShipBySellerInput.prop('name', $productVariantIteratorKey + 'shipping_type_seller]');
                let shipBySellerChecked = $(this).prop('checked');
                const productId = $(this).prop('id').split('_')[0];
                const fbsLeadTime = $('#' + productId + '_fbs_lead_time');
                let hiddenInput = fbsLeadTime.children('input');
                hiddenInput.prop('name', $productVariantIteratorKey + 'fbs_lead_time]');
                if (shipBySellerChecked) {
                    $(this).siblings('input').remove();
                    fbsLeadTime.removeClass('new-sbs-lead-time-field-wrapper__first-select--disabled');
                    fbsLeadTime.addClass('new-sbs-lead-time-field-wrapper__first-select');
                    fbsLeadTime.children('select').prop('disabled', false);
                    fbsLeadTime.children('select').trigger('change');
                    hiddenInput.remove();
                } else {
                    $(this).parent().append(hiddenShipBySellerInput);
                    fbsLeadTime.removeClass('new-sbs-lead-time-field-wrapper__first-select');
                    fbsLeadTime.addClass('new-sbs-lead-time-field-wrapper__first-select--disabled');
                    fbsLeadTime.children('select').prop('disabled', true);
                    fbsLeadTime.children('select').trigger('change');
                    fbsLeadTime.append(hiddenInput);
                }
                let $fbsLeadTime = $('.js-fbs-lead-time-edit');
                $fbsLeadTime.prop('name', $productVariantIteratorKey + 'fbs_lead_time]');
                $fbsLeadTime.on('change', function () {
                    const rowParent = $(this).parents('.c-variant__secondary-info--edit');
                    const shipBySellerChecked = rowParent.find('.js-shipping-type-seller:first').siblings('input').length === 0;
                    const hourLeadTime = rowParent.find('.js-fbs-lead-time-second-edit').parent();
                    let currentFbsLeadTime = $(this);
                    const leadTime = rowParent.find('.js-edit-lead-time');
                    if (leadTime.val() && (parseInt(leadTime.val()) * 24 >= $(this).val()) && $(this).val()) {
                        $(this).parent().removeClass('has-error');
                    } else if ((leadTime.val() && (parseInt(leadTime.val()) * 24 < $(this).val()))) {
                        $(this).parent().addClass('has-error');
                    }
                    if (shipBySellerChecked && $(this).val() && ($(this).val() === '2' || $(this).val() === '3' || $(this).val() === '4' || $(this).val() === '5')) {
                        hourLeadTime.removeClass('new-sbs-lead-time-field-wrapper__second-select--disabled');
                        hourLeadTime.addClass('new-sbs-lead-time-field-wrapper__second-select');
                        const hourLeadTimeSelect = hourLeadTime.children('.js-fbs-lead-time-second-edit');
                        hourLeadTimeSelect.prop('disabled', false);
                        if (!hourLeadTimeSelect.val()) {
                            hourLeadTimeSelect.val(2);
                            hourLeadTimeSelect.trigger('change');
                        }
                        hourLeadTimeSelect.on('change', function () {
                            currentFbsLeadTime.children('option:nth-child(2)').val($(this).val());
                        })
                    } else {
                        hourLeadTime.addClass('new-sbs-lead-time-field-wrapper__second-select--disabled');
                        hourLeadTime.removeClass('new-sbs-lead-time-field-wrapper__second-select');
                        hourLeadTime.parent().find('.error-msg').remove();
                        hourLeadTime.removeClass('has-error');
                        hourLeadTime.children('.js-fbs-lead-time-second-edit').prop('disabled', true);
                    }
                });
            });
            shipBySeller.trigger('click');
            shipBySeller.trigger('click');
        }

        $(document).on('click', '.js-edit-active', function () {
            let $this = $(this);
            let $productVariantEditRow = $('#productVariantEditRow_' + $this.data('id'));
            let $variantId = $this.data('id');

            if ($this.prop('checked')) {
                $productVariantEditRow.find('input[type=text]').removeClass('disabled');
                $productVariantEditRow.find('input[data-editable=false]').addClass('disabled');

                if ( isModuleActive('variant_gold_price') && window['goldPriceParameters'] && window['goldPriceParameters']['is_only_gold'] ) {
                    $('.js-variant-edit-gold-price-info[data-name=ngp]').addClass('disabled');
                    $('.js-variant-edit-gold-price-info[data-name=ngw]').addClass('disabled');
                }


                if(!isModuleActive('only_fbs')){
                    $productVariantEditRow.find('.js-edit-lead-time').prop('disabled', false);
                } else if (isModuleActive('only_fbs') && ($(`.js-shipping-type-digikala[data-id="${$variantId}"]`).is(':checked'))) {
                    $productVariantEditRow.find('.js-edit-lead-time').prop('disabled', false);
                }
                if (window.isShipBySellerModuleActive) {
                    const sellerCheckBox = $productVariantEditRow.find('.js-checkbox-group-seller');
                    $productVariantEditRow.find('.js-checkbox-group').prop('disabled', false);
                    sellerCheckBox.prop('disabled', false);
                    if (sellerCheckBox.prop('checked')) {
                        $productVariantEditRow.find('.js-shipping-type-seller').trigger('click').trigger('click');
                    }

                } else {
                    $productVariantEditRow.find('.js-checkbox-group').prop('disabled', false);
                }
                $productVariantEditRow.find('.js-radio-group').removeClass('disabled');

                if ($this.data('default-value') === 0) {
                    $productVariantEditRow.find('.js-variant-save-edit:first').removeClass('disabled').prop('disabled', false);
                }
            } else {
                $productVariantEditRow.find('input[type=text]').addClass('disabled');
                $productVariantEditRow.find('.js-edit-lead-time').prop('disabled', true);
                $productVariantEditRow.find('.js-checkbox-group').prop('disabled', true);
                if (window.isShipBySellerModuleActive) {
                    $productVariantEditRow.find('.js-checkbox-group-seller').prop('disabled', true);
                    $productVariantEditRow.find('.js-fbs-lead-time-edit').prop('disabled', true);
                    $productVariantEditRow.find('.js-fbs-lead-time-second-edit').prop('disabled', true);
                }
                $productVariantEditRow.find('.js-radio-group').addClass('disabled');

                if ($this.data('default-value') === 0) {
                    $productVariantEditRow.find('.js-variant-save-edit:first').addClass('disabled').prop('disabled', true);
                }
            }
        });
    },

    switchToView: function (productVariantId) {
        let $productVariantEditRow = $('#productVariantEditRow_' + productVariantId);
        let $productVariantViewRow = $('#productVariantViewRow_' + productVariantId);

        $productVariantEditRow.find('input[type=text]').each(function () {
            let $element = $(this);
            if ($element.data('default-value')) {
                $element.val($element.data('default-value'));
            }
        });

        $productVariantEditRow.find('input[type=checkbox]').each(function () {
            let $element = $(this);
            if ($element.data('default-value')) {
                $element.prop('checked', true);
                if ($element.hasClass('js-edit-active')) {
                    $productVariantEditRow.find('.js-checkbox-group').prop('disabled', false);
                    $productVariantEditRow.find('.js-variant-save-edit:first').removeClass('disabled');
                }
            } else {
                $element.prop('checked', false);
                if (window.isShipBySellerModuleActive) {
                    if ($element.hasClass('js-checkbox-group-seller')) {
                        $element.trigger('click');
                        $element.trigger('click');
                    }
                }
                if ($element.hasClass('js-edit-active')) {
                    $productVariantEditRow.find('input[type=text]').addClass('disabled');
                    $productVariantEditRow.find('.js-checkbox-group').prop('disabled', true);
                    if (window.isShipBySellerModuleActive) {
                        $productVariantEditRow.find('.js-checkbox-group-seller').prop('disabled', true);
                    }
                    $productVariantEditRow.find('.js-radio-group').addClass('disabled');
                    $productVariantEditRow.find('.js-variant-save-edit:first').addClass('disabled');
                }
            }
        });

        $productVariantEditRow.find('input[type=radio]').each(function () {
            let $element = $(this);
            if ($element.data('default-value')) {
                $element.prop('checked', true);
            } else {
                $element.prop('checked', false);
            }
        });

        $productVariantEditRow.removeClass('edit');
        $productVariantViewRow.removeClass('edit');
    },

    switchToEdit: function (productVariantId) {
        $('#productVariantEditRow_' + productVariantId).addClass('edit');
        $('#productVariantViewRow_' + productVariantId).addClass('edit');

        if (window.isShipBySellerModuleActive) {
            const $productVariantEditRow = $('#productVariantEditRow_' + productVariantId);

            const sellerCheckBox = $productVariantEditRow.find('.js-checkbox-group-seller');
            const activeCheckBox = $productVariantEditRow.find('.js-edit-active');
            activeCheckBox.trigger('click').trigger('click')
            if (sellerCheckBox.prop('checked') && activeCheckBox.prop('checked')) {
                $productVariantEditRow.find('.js-shipping-type-seller').trigger('click').trigger('click');
            }
        }
    },

    initUiSelect: function () {
        $('.js-select-origin').each(function () {
            const $this = $(this);
            const isMultiSelect = $this.attr('multiple');
            const $placeholder = $this.attr('placeholder') || ' ';
            const inProductStep = $this.hasClass('js-in-product');
            if (isMultiSelect && inProductStep) {
                let $counter = $this.siblings('.select-counter');
                let selectionsLength = $this.find(':selected').length;

                if (selectionsLength > 0 ) {
                    $counter.text(selectionsLength.toLocaleString());
                    $counter.css('display', 'flex');
                }
            }

            $this.select2({
                placeholder: $placeholder,
                closeOnSelect: !isMultiSelect,
                allowClear: (isMultiSelect && inProductStep),
                sorter: function (data) {
                    return data.sort(function (a, b) {
                        a = $(a).prop('selected');
                        b = $(b).prop('selected');
                        return b - a;
                    });
                }
            }).on('select2:opening', function () {
                $('body').addClass('ui-select');
            }).on('select2:select', function () {
                let $sortedOptions = $('li.select2-results__option').sort(function (a, b) {
                    return ($(b).attr('aria-selected') === 'true') - ($(a).attr('aria-selected') === 'true');
                });
                $('.select2-results__options').prepend($sortedOptions);
            }).on('select2:unselect', function () {
                let $sortedOptions = $('li.select2-results__option').sort(function (a, b) {
                    return ($(b).attr('aria-selected') === 'true') - ($(a).attr('aria-selected') === 'true');
                });
                $('.select2-results__options').prepend($sortedOptions);
            }).on('change', function () {
                if (isMultiSelect && inProductStep) {
                    let $counter = $this.siblings('.select-counter');
                    let selectionsLength = $this.find(':selected').length;

                    if (selectionsLength > 0) {
                        $counter.css('display', 'flex');
                    } else {
                        $counter.css('display', 'none');
                    }
                    $counter.text(selectionsLength.toLocaleString());
                }
                $(this).trigger('blur');
            }).on('select2:close', function () {
                $(this).valid();
                $('body').removeClass('ui-select');
            });
        });
    },

    initWarrantyUploadFront: function () {
        let $uploadWarrantyImage = $('#uploadWarrantyImageFront');
        let $uploadWarrantyImageContainer = $uploadWarrantyImage.closest('.c-content-modal__uploads-label');
        let $previewImg = $('#warrantyImagePreviewFront');
        let $errorsSection = $('#newWarrantyImageFrontUploadErrors');
        window.UIkit.upload($uploadWarrantyImage, {
            url: '/content/request/upload/',
            beforeSend: function () {
                $errorsSection.html('');
            },
            beforeAll: function () {
                $uploadWarrantyImageContainer.addClass('loading');
                $errorsSection.html('');
            },
            load: function () {},
            error: function () {},
            complete: function () {
                let result = JSON.parse(arguments[0].response);

                if (!result.status) {
                    $uploadWarrantyImageContainer.removeClass('loading');
                    return;
                }

                $errorsSection.html('');
                /**
                 * @param result
                 * @param result.data.errors errors related to image validation
                 * @param result.data.error_server error related to cloud upload
                 */
                if (typeof result.data.errors !== 'undefined') {
                    $.each(result.data.errors, function (messageKey, messageText) {
                        let $div = $('<div/>');
                        $div.html(messageText);
                        $errorsSection.append($div);
                    });
                    $uploadWarrantyImageContainer.removeClass('loading');
                    return;
                }

                if (typeof result.data.error_server !== 'undefined') {
                    let $div = $('<div/>');
                    $div.html(result.data.error_server);
                    $errorsSection.append($div);
                    $uploadWarrantyImageContainer.removeClass('loading');
                    return;
                }
                $uploadWarrantyImageContainer.removeClass('empty loading');
                $previewImg.attr('src', result.data.url);
                $('#warrantyImageTempIdFront').val(result.data.id);
            },
            loadStart: function () {},
            progress: function () {},
            loadEnd: function () {},
            completeAll: function () {}
        });
    },

    initWarrantyUploadBack: function () {
        let $uploadWarrantyImage = $('#uploadWarrantyImageBack');
        let $uploadWarrantyImageContainer = $uploadWarrantyImage.closest('.c-content-modal__uploads-label');
        let $previewImg = $('#warrantyImagePreviewBack');
        let $errorsSection = $('#newWarrantyImageBackUploadErrors');
        window.UIkit.upload($uploadWarrantyImage, {
            url: '/content/request/upload/',
            beforeSend: function () {
                $errorsSection.html('');
            },
            beforeAll: function () {
                $uploadWarrantyImageContainer.addClass('loading');
                $errorsSection.html('');
            },
            load: function () {},
            error: function () {},
            complete: function () {
                let result = JSON.parse(arguments[0].response);

                if (!result.status) {
                    $uploadWarrantyImageContainer.removeClass('loading');
                    return;
                }

                $errorsSection.html('');
                /**
                 * @param result
                 * @param result.data.errors errors related to image validation
                 * @param result.data.error_server error related to cloud upload
                 */
                if (typeof result.data.errors !== 'undefined') {
                    $.each(result.data.errors, function (messageKey, messageText) {
                        let $div = $('<div/>');
                        $div.html(messageText);
                        $errorsSection.append($div);
                    });
                    $uploadWarrantyImageContainer.removeClass('loading');
                    return;
                }

                if (typeof result.data.error_server !== 'undefined') {
                    let $div = $('<div/>');
                    $div.html(result.data.error_server);
                    $errorsSection.append($div);
                    $uploadWarrantyImageContainer.removeClass('loading');
                    return;
                }
                $uploadWarrantyImageContainer.removeClass('empty loading');
                $previewImg.attr('src', result.data.url);
                $('#warrantyImageTempIdBack').val(result.data.id);
            },
            loadStart: function () {},
            progress: function () {},
            loadEnd: function () {},
            completeAll: function () {}
        });
    },

    initInsuranceUploadFront: function () {
        let $uploadInsuranceImage = $('#uploadInsuranceImageFront');
        let $uploadInsuranceImageContainer = $uploadInsuranceImage.closest('.c-content-modal__uploads-label');
        let $previewImg = $('#insuranceImagePreviewFront');
        let $errorsSection = $('#newInsuranceImageFrontUploadErrors');
        window.UIkit.upload($uploadInsuranceImage, {
            url: '/content/request/upload/',
            beforeSend: function () {
                $errorsSection.html('');
            },
            beforeAll: function () {
                $uploadInsuranceImageContainer.addClass('loading');
                $errorsSection.html('');
            },
            load: function () {},
            error: function () {},
            complete: function () {
                let result = JSON.parse(arguments[0].response);

                if (!result.status) {
                    $uploadInsuranceImageContainer.removeClass('loading');
                    return;
                }

                $errorsSection.html('');
                /**
                 * @param result
                 * @param result.data.errors errors related to image validation
                 * @param result.data.error_server error related to cloud upload
                 */
                if (typeof result.data.errors !== 'undefined') {
                    $.each(result.data.errors, function (messageKey, messageText) {
                        let $div = $('<div/>');
                        $div.html(messageText);
                        $errorsSection.append($div);
                    });
                    $uploadInsuranceImageContainer.removeClass('loading');
                    return;
                }

                if (typeof result.data.error_server !== 'undefined') {
                    let $div = $('<div/>');
                    $div.html(result.data.error_server);
                    $errorsSection.append($div);
                    $uploadInsuranceImageContainer.removeClass('loading');
                    return;
                }
                $uploadInsuranceImageContainer.removeClass('empty loading');
                $previewImg.attr('src', result.data.url);
                $('#insuranceImageTempIdFront').val(result.data.id);
            },
            loadStart: function () {},
            progress: function () {},
            loadEnd: function () {},
            completeAll: function () {}
        });
    },

    initInsuranceUploadBack: function () {
        let $uploadInsuranceImage = $('#uploadInsuranceImageBack');
        let $uploadInsuranceImageContainer = $uploadInsuranceImage.closest('.c-content-modal__uploads-label');
        let $previewImg = $('#insuranceImagePreviewBack');
        let $errorsSection = $('#newInsuranceImageBackUploadErrors');
        window.UIkit.upload($uploadInsuranceImage, {
            url: '/content/request/upload/',
            beforeSend: function () {
                $errorsSection.html('');
            },
            beforeAll: function () {
                $uploadInsuranceImageContainer.addClass('loading');
                $errorsSection.html('');
            },
            load: function () {},
            error: function () {},
            complete: function () {
                let result = JSON.parse(arguments[0].response);

                if (!result.status) {
                    $uploadInsuranceImageContainer.removeClass('loading');
                    return;
                }

                $errorsSection.html('');
                /**
                 * @param result
                 * @param result.data.errors errors related to image validation
                 * @param result.data.error_server error related to cloud upload
                 */
                if (typeof result.data.errors !== 'undefined') {
                    $.each(result.data.errors, function (messageKey, messageText) {
                        let $div = $('<div/>');
                        $div.html(messageText);
                        $errorsSection.append($div);
                    });
                    $uploadInsuranceImageContainer.removeClass('loading');
                    return;
                }

                if (typeof result.data.error_server !== 'undefined') {
                    let $div = $('<div/>');
                    $div.html(result.data.error_server);
                    $errorsSection.append($div);
                    $uploadInsuranceImageContainer.removeClass('loading');
                    return;
                }
                $uploadInsuranceImageContainer.removeClass('empty loading');
                $previewImg.attr('src', result.data.url);
                $('#insuranceImageTempIdBack').val(result.data.id);
            },
            loadStart: function () {},
            progress: function () {},
            loadEnd: function () {},
            completeAll: function () {}
        });
    },

    initColorUploadPrimary: function () {
        let $uploadColorImageFirst = $('#uploadColorImageFirst');
        let $previewImg = $('#uploadColorImageFirstPreview');
        let $errorsSection = $('#newColorImageUpload1Errors');
        window.UIkit.upload($uploadColorImageFirst, {
            url: '/content/request/upload/',
            beforeSend: function () {
                $errorsSection.html('');
            },
            beforeAll: function () {
                $uploadColorImageFirst.addClass('loading');
                $errorsSection.html('');
            },
            load: function () {},
            error: function () {},
            complete: function () {
                let result = JSON.parse(arguments[0].response);
                if (!result.status) {
                    $uploadColorImageFirst.removeClass('loading');
                    return;
                }

                $errorsSection.html('');
                /**
                 * @param result
                 * @param result.data.errors errors related to image validation
                 * @param result.data.error_server error related to cloud upload
                 */
                if (typeof result.data.errors !== 'undefined') {
                    $.each(result.data.errors, function (messageKey, messageText) {
                        let $div = $('<div/>');
                        $div.html(messageText);
                        $errorsSection.append($div);
                    });
                    $uploadColorImageFirst.removeClass('loading');
                    return;
                }

                if (typeof result.data.error_server !== 'undefined') {
                    let $div = $('<div/>');
                    $div.html(result.data.error_server);
                    $errorsSection.append($div);
                    $uploadColorImageFirst.removeClass('loading');
                    return;
                }
                $uploadColorImageFirst.removeClass('empty loading');
                $previewImg.attr('src', result.data.url);
                $('#productImage1TempId').val(result.data.id);
            },
            loadStart: function () {},
            progress: function () {},
            loadEnd: function () {},
            completeAll: function () {}
        });
    },

    extendValidator: function () {
        $.validator.addMethod("at_least_one_shipping_type", function (value, elem) {
            let $container = $(elem).closest('.js-checkbox-group-container');
            return $('.js-checkbox-group:checkbox:checked', $container).length > 0;
        }, 'لطفا کد یا نام سلر را وارد کنید');
    },
};

/** This is description of addGTag function.
 * @param   {{event_label, event_action}} options sets GTag args and has event_label, and event_action.
 *
 * @return void */
let addGTag = function (options) {
    try {
        gtag('event', 'click', {
            'event_category': 'seller_product_page',
            'event_action': options.event_action,
            'event_label': options.event_label,
            'non_interaction': true
        });
    } catch (e) {
        // eslint-disable-next-line no-console
        console.log(e);
    }
};

$(function () {
    IndexAction.init();
});



/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/controllers/Content/ContentCreation/productVariantsController/goldPriceAction.js]*/
var GoldPriceAction = {

    initGoldPrice: function(productVariantIterator) {

        // show gold price fields
        $('.js-gold-price-field').each(function() {
            $(this).removeClass('uk-hidden');
        });

        // disable all un-editable inputs
        $('.js-variant-marketplace-gold-price-info[data-editable="false"]').each(function() {
            $(this).attr('disabled', 'disabled').addClass('disabled');
        });

        // set max value attributes and hints for profit and gold wage fiels
        $('.js-variant-marketplace-gold-price-info[data-name=gw]').attr('data-max-value', window.IndexAction.goldPriceInfo.staticData.gold_wage_max_margin);
        $('.js-variant-marketplace-gold-price-info[data-name=profit]').attr('data-max-value', window.IndexAction.goldPriceInfo.staticData.profit_max_margin);
        $('.js-variant-marketplace-gold-price-info[data-name=gw]').siblings('.js-input-max-value-hint').html(Services.convertToFaDigit(window.IndexAction.goldPriceInfo.staticData.gold_wage_max_margin));
        $('.js-variant-marketplace-gold-price-info[data-name=profit]').siblings('.js-input-max-value-hint').html(Services.convertToFaDigit(window.IndexAction.goldPriceInfo.staticData.profit_max_margin));

        // disable none gold params input when variant is only gold
        if ( window['goldPriceParameters']['is_only_gold'] ) {
            $('.js-variant-marketplace-gold-price-info[data-name=ngp]').prop('disabled', true).addClass('disabled');
            $('.js-variant-marketplace-gold-price-info[data-name=ngw]').prop('disabled', true).addClass('disabled');
        }

        var liveGoldPriceInput = $('.js-variant-marketplace-gold-price-info[name="lgp"]');

        // set live gold price value to input hidden and text field
        liveGoldPriceInput.val(Services.convertToFaDigit(Services.formatCurrency(window.IndexAction.goldPriceInfo.staticData.lgp)));

        // init form event listeners
        GoldPriceAction.initGoldPriceEventListeners(productVariantIterator);



    },

    initGoldPriceEventListeners: function (productVariantIterator) {
        var productVariantIteratorKey = 'product_variants[variant_' + productVariantIterator;

        // set tax and live gold price to the related input hidden
        $(`input[name="${productVariantIteratorKey}_live_gold_price]"]`).val(window.IndexAction.goldPriceInfo.staticData.lgp);
        $(`input[name="${productVariantIteratorKey}_gold_tax]"]`).val(window.IndexAction.goldPriceInfo.staticData.tax);

        // disable and  set static default value of un-editable inputs
        $('.js-variant-price').attr('name', '').attr('disabled', 'disabled');
        $('.js-variant-marketplace-gold-price-info[data-name="lgp"]').val(Services.convertToFaDigit(Services.formatCurrency(window.IndexAction.goldPriceInfo.staticData.lgp, false, '')));
        $('.js-variant-marketplace-gold-price-info[data-name="tax"]').val(Services.convertToFaDigit(Services.formatCurrency(window.IndexAction.goldPriceInfo.staticData.tax, false, '')));

        // on related to gold price inputs change handler
        $('.c-grid__row--gap-lg').on('input', '.js-variant-marketplace-gold-price-info', function(){
            // input max value - mostly used to handle percentage values
            var maxValue = $(this).data('max-value') ? Number($(this).data('max-value')) : null;
            // find the index of the changed variant to update the gold price by variant index
            var changedVariantInfoIndex = $(this).attr('name').split('product_variants[variant_')[1].charAt(0);
            // convert input value to pure Number type
            var inputValue = Number(Services.convertToEnDigit($(this).val()).split(',').join(''));
            // input formatted value
            var formattedNumber = Services.convertToFaDigit(Services.formatCurrency(inputValue, false, ''));
            // the formatted value from saved value in goldPriceInfo
            var currentFormattedNumber = Services.convertToFaDigit(Services.formatCurrency(window.IndexAction.goldPriceInfo.dynamicData[changedVariantInfoIndex.toString()][$(this).data('name')], false, ''));

            if ( $(this).data('editable') ) {
                if ( inputValue >= 0 ) {
                    // check if maxValue has been set in the input, then compare input value with that to set correct value
                    if ( maxValue ) {
                        if ( inputValue <= maxValue ) {
                            window.IndexAction.goldPriceInfo.dynamicData[changedVariantInfoIndex][$(this).data('name')] = inputValue;
                            $(this).val(formattedNumber.trim());
                            GoldPriceAction.createVariantCalculateGoldPrice(changedVariantInfoIndex, this);
                        } else {
                            $(this).val(currentFormattedNumber);
                            GoldPriceAction.createVariantCalculateGoldPrice(changedVariantInfoIndex, this);
                        }
                    } else {
                        window.IndexAction.goldPriceInfo.dynamicData[changedVariantInfoIndex][$(this).data('name')] = inputValue;
                        $(this).val(formattedNumber.trim());
                        GoldPriceAction.createVariantCalculateGoldPrice(changedVariantInfoIndex, this);
                    }
                } else {
                    $(this).val(currentFormattedNumber);
                    GoldPriceAction.createVariantCalculateGoldPrice(changedVariantInfoIndex, this);
                }
            } else {
                // re-assign the static value to the text input to prevent changing the input value
                $(this).val(currentFormattedNumber);
                GoldPriceAction.createVariantCalculateGoldPrice(changedVariantInfoIndex, this);
            }
        });
    },

    initGoldPriceForm: function() {
        // set form name for gold price inputs
        var productVariantIteratorKey = 'product_variants[variant_' + window.IndexAction.data.newProductVariantIterator;
        var formNamesByKey = {
            gw: {
                key: productVariantIteratorKey + '_gold_wage]',
                rules: {
                    required: true,
                    messages: {
                        required: 'وارد کردن دستمزد اجباری است'
                    }
                }
            },
            ngp: {
                key: productVariantIteratorKey + '_non_gold_parts_cost]',
                rules: {
                    required: true,
                    messages: {
                        required: 'وارد کردن قیمت بخش های غیر طلا اجباری است'
                    }
                }
            },
            ngw: {
                key: productVariantIteratorKey + '_non_gold_parts_wage]',
                rules: {
                    required: true,
                    messages: {
                        required: 'وارد کردن قیمت دستمزد بخش های غیر طلا اجباری است'
                    }
                }
            },
            profit: {
                key: productVariantIteratorKey + '_gold_profit]',
                rules: {
                    required: true,
                    messages: {
                        required: 'وارد کردن سود اجباری است'
                    }
                }
            },
        };

        $('.js-variant-marketplace-gold-price-info').each(function() {
            if ( $(this).data('name') && !$(this).prop('disabled') ) {
                // set name of gold price inputs by theirs own data-name attr.
                // notice that because of the multiple forms in this section you have to set name for last shown gold price forms by variant iterator
                var inputsWithSameName = $(`input.js-variant-marketplace-gold-price-info[data-name=${$(this).data('name')}]`);
                $(inputsWithSameName[inputsWithSameName.length - 2]).attr('name', formNamesByKey[$(this).data('name')].key);
                $(inputsWithSameName[inputsWithSameName.length - 2]).rules('add', formNamesByKey[$(this).data('name')].rules);
            }
        });
    },



    createVariantCalculateGoldPrice: function(changedVariantIndex, changedInput) {
        var priceDynamicInfo = window.IndexAction.goldPriceInfo.dynamicData[changedVariantIndex.toString()];
        var finalPrice = GoldPriceAction.calculateGoldPrice(priceDynamicInfo);
        window.IndexAction.goldPriceInfo.dynamicData[changedVariantIndex.toString()].finalPrice = finalPrice;
        $($(changedInput).parents('.c-variant-box__main').find('.js-gold-final-price')).val(Services.convertToFaDigit(Services.formatCurrency(finalPrice, false, '')));
    },


    calculateGoldPrice: function(priceDynamicInfo) {
        /*
            price info should be an object by below format :
            {
                size: 1,
                gw: 1,
                ngp: 1,
                ngw: 1,
                profit: 1
            }

        */
        var priceStaticInfo = window.IndexAction.goldPriceInfo.staticData;

        // final price would be calculated by this formula : ((Size * LGP ) * (1 + GW) * (1 + P) + NGP + NGWP) * (1 + T)
        var finalPrice = (( priceDynamicInfo.size * priceStaticInfo.lgp ) * ( 1 + (priceDynamicInfo.gw / 100)) * ( 1 + (priceDynamicInfo.profit / 100)) + priceDynamicInfo.ngp + priceDynamicInfo.ngw ) * ( 1 + (priceStaticInfo.tax / 100) );

        // round final price
        finalPrice = Math.round(finalPrice);
        if ( finalPrice % 100 < 50 ) {
            finalPrice -= (finalPrice % 100);
        } else {
            finalPrice += 100 - (finalPrice % 100);
        }
        return finalPrice;
    },


    removeGoldPriceFields: function () {
        $('input.js-variant-marketplace-gold-price-info').each(function () {
            if ( !$(this).hasClass('js-gold-final-price') ) {
                $(this).remove();
            }
        });
    },

    initGoldPricingToEditVariant: function () {
        // disable all un-editable fields in edit variant form
        $('.js-variant-edit-gold-price-info[data-editable="false"]').prop('disabled', 'disabled');

        // set live gold price value to its own fields
        $('input.js-variant-edit-gold-price-info[data-name=lgp]').val(Services.convertToFaDigit(Services.formatCurrency(window['goldPriceParameters']['live_gold_price'], false, '')));
        $('input.js-variant-edit-gold-price-info[data-name=tax]').val(Services.convertToFaDigit(Services.formatCurrency(window['goldPriceParameters']['tax'] * 100, false, '' )));

        // set max value and max value hint for profit and gold wage fields
        $('.js-variant-edit-gold-price-info[data-name=gw]').attr('data-max-value', window.IndexAction.goldPriceInfo.staticData.gold_wage_max_margin);
        $('.js-variant-edit-gold-price-info[data-name=profit]').attr('data-max-value', window.IndexAction.goldPriceInfo.staticData.profit_max_margin);
        $('.js-variant-edit-gold-price-info[data-name=gw]').siblings('.js-input-max-value-hint').html(Services.convertToFaDigit(window.IndexAction.goldPriceInfo.staticData.gold_wage_max_margin));
        $('.js-variant-edit-gold-price-info[data-name=profit]').siblings('.js-input-max-value-hint').html(Services.convertToFaDigit(window.IndexAction.goldPriceInfo.staticData.profit_max_margin));

        // disable none gold params input when variant is only gold
        if ( window['goldPriceParameters']['is_only_gold'] ) {
            $('.js-variant-edit-gold-price-info[data-name=ngp]').prop('disabled', true);
            $('.js-variant-edit-gold-price-info[data-name=ngw]').prop('disabled', true);
        }
    },

    initGoldPriceEditFieldsChangeHandler: function() {
        $(document).on('input', '.js-variant-edit-gold-price-info', function () {
            // input max value - mostly used to handle percentage values
            var maxValue = $(this).data('max-value') ? Number($(this).data('max-value')) : null;
            // convert input value to pure Number type
            var inputValue = Number(Services.convertToEnDigit($(this).val()).split(',').join(''));
            // input formatted value
            var formattedNumber = Services.convertToFaDigit(Services.formatCurrency(inputValue, false, ''));
            // the formatted value from saved value in goldPriceInfo
            var currentFormattedNumber = Services.convertToFaDigit(Services.formatCurrency(maxValue || $(this).val(), false, '')).trim();

            if ( $(this).data('editable') ) {
                if ( inputValue >= 0 ) {
                    // check if maxValue has been set in the input, then compare input value with that to set correct value
                    if ( maxValue ) {
                        if ( inputValue <= maxValue ) {
                            $(this).val(formattedNumber.trim());
                            GoldPriceAction.editVariantCalculateGoldPrice(this);
                        } else {
                            $(this).val(currentFormattedNumber);
                            GoldPriceAction.editVariantCalculateGoldPrice(this);
                        }
                    } else {
                        $(this).val(formattedNumber.trim());
                        GoldPriceAction.editVariantCalculateGoldPrice(this);
                    }
                } else {
                    $(this).val(currentFormattedNumber);
                    GoldPriceAction.editVariantCalculateGoldPrice(this);
                }
            } else {
                // re-assign the static value to the text input to prevent changing the input value
                $(this).val(currentFormattedNumber);
                GoldPriceAction.editVariantCalculateGoldPrice(this);
            }
        });
    },

    convertFormattedNumberToRealNumber: function(formattedNumber) {
        return Number(Services.convertToEnDigit(formattedNumber).split(',').join(''));
    },

    editVariantCalculateGoldPrice: function (changedInput) {
        var goldPriceInfo = {
            size: Number($(changedInput).parents('.js-variant-row').data('size')),
            gw: GoldPriceAction.convertFormattedNumberToRealNumber($(changedInput).parents('.js-variant-row').find('input[data-name="gw"]').val()),
            ngp: GoldPriceAction.convertFormattedNumberToRealNumber($(changedInput).parents('.js-variant-row').find('input[data-name="ngp"]').val()),
            ngw: GoldPriceAction.convertFormattedNumberToRealNumber($(changedInput).parents('.js-variant-row').find('input[data-name="ngw"]').val()),
            profit: GoldPriceAction.convertFormattedNumberToRealNumber($(changedInput).parents('.js-variant-row').find('input[data-name="profit"]').val())
        };
        var finalPrice = GoldPriceAction.calculateGoldPrice(goldPriceInfo);
        $(changedInput).parents('.js-variant-row').find('.js-gold-final-price').val(Services.convertToFaDigit(Services.formatCurrency(finalPrice, false, '')));
    },



};

$(document).ready(function () {
    if ( window['goldPriceParameters'] ) {
        GoldPriceAction.initGoldPricingToEditVariant();
        GoldPriceAction.initGoldPriceEditFieldsChangeHandler();
    }
});


/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/tableView.js]*/
window.TableView = {
    init: function () {
        this.tableDefaultEmpty = false;
        this.searchFormDefaultArray = [];
        this.searchFormArray = [];
        this.searchFormSubmitted = false;
        this.staticFormData = [];
        this.initStaticFormData();
        this.initPrepareSearchRadioGroup();
        this.initSearchForm();
        this.initDataSetTable();
        this.initExpandTables();

        if (this.isNewUI()) {
            this.initSelect2();
        }

        this.initOnEndEvent();
    },

    serializeForm: function () {
        let $form = $('#searchForm');
        let $formArray = $form.serializeArray();
        let $formArrayFixed = {};
        for (let i = 0; i < $formArray.length; i++) {
            $formArrayFixed[$formArray[i]['name']] = $formArray[i]['value'];
        }
        return $formArrayFixed;
    },

    initSearchForm: function () {
        const $that = this;
        const $form = $('#searchForm');
        const $submitBtn = $('#submitButton');
        const $typeSelect = $('.js-select-type');
        const $statusSelect = $('.js-select-status');

        if (!$form.length) {
            return;
        }

        $that.searchFormArray = $that.serializeForm();
        $that.searchFormDefaultArray = $that.serializeForm();

        $('.js-persian-date-picker').persianDatepicker({
            initialValue: false,
            autoClose: true,
            format: 'YYYY/MM/DD'
        });

        // To manually configure date picker for the page
        if ($('.js-order-history-search-input').length) {
            $('.js-persian-date-picker').persianDatepicker({
                initialValue: false,
                autoClose: true,
                format: 'YYYY/MM/DD',
                observer: true,
                onSelect: function () {
                    $(this.model.inputElement).trigger('change');
                },
            });
        }

        $submitBtn.click(function () {
            if ($that.tableDefaultEmpty) {
                return false;
            }

            let $currentFormArray = $that.serializeForm();
            if (JSON.stringify($that.searchFormArray) === JSON.stringify($currentFormArray) && !window.canSearchWithNoChange) {
                return false;
            }

            $that.searchFormArray = $currentFormArray;
            $that.searchFormSubmitted = true;
            $that.search(1, $that.getItemsPerPage());

            // return false;
        });

        $form.on('submit', function (e) {
            e.preventDefault();
            $submitBtn.click();
        });


        if ($typeSelect.length) {
            $typeSelect.on('change', function (e) {
                e.preventDefault();
                $submitBtn.click()
            });
        }

        if ($statusSelect.length) {
            $statusSelect.on('change', function (e) {
                e.preventDefault()
                $submitBtn.click();
            })


        }

        $(document).on('click', '#export-button', function () {
            $that.requestExport($that.serializeForm(), $that.staticFormData);
            return false;
        });

        $('#export-invoice-button').click(function () {
            if ($that.tableDefaultEmpty) {
                return false;
            }

            let $currentFormArray = $that.serializeForm();
            if (JSON.stringify($that.searchFormArray) === JSON.stringify($currentFormArray)) {
                return false;
            }

            //TODO STUPID
            $that.searchFormArray = $currentFormArray;
            window.Services.ajaxPOSTRequestHTML(
                '/sellerinvoice/printinvoices/',
                $that.searchFormArray,
                function (response) {
                    if (response) {
                        window.open('/sellerinvoice/printinvoices/?order_created_at_from=' + $that.searchFormArray['search[order_created_at_from]']);
                    }
                }
            );

            return false;
        });

        $('#resetButton').click(function () {
            if ($that.tableDefaultEmpty) {
                return false;
            }

            const $productVariantAjax = $('.js-select2, .js-product-variant-ajax');
            if (!$that.searchFormSubmitted) {
                let $currentFormArray = $that.serializeForm();
                if (JSON.stringify($that.searchFormDefaultArray) === JSON.stringify($currentFormArray)) {
                    return false;
                }

                $form[0].reset();
                $productVariantAjax.val('').trigger('change');

                return false;
            }

            $form[0].reset();
            $productVariantAjax.val('').trigger('change');

            $that.searchFormArray = $that.serializeForm();
            $that.searchFormSubmitted = false;
            $that.search(1, $that.getItemsPerPage());

            return false;
        });
    },

    initDataSetTable: function () {
        const $searchTable = $('.js-search-table');

        if (!$searchTable.length) {
            return;
        }

        const $that = this;

        $(document).on('click', '.js-search-table-column-sortable', function () {
            $that.search($that.getCurrentPage(), $that.getItemsPerPage(), $(this).data('sort-column'), $(this).data('sort-order'));
        });

        $(document).on('click', '.js-search-pager a', function () {
            const $page = $(this).data('page');
            if ($page === $that.getCurrentPage()) {
                return;
            }

            const $searchUpdatedTable = $('.js-search-table');

            $that.search($page, $that.getItemsPerPage(), $searchUpdatedTable.data('sort-column'), $searchUpdatedTable.data('sort-order'));
        });

        $(document).on('change', '.js-search-items-per-page', function () {
            $that.search(1, $(this).val());
        });

        if (this.isNewUI) {
            if (this.isHeaderFloating()) {
                this.fixTableHeader();
            }

            if (this.hasCheckboxes()) {
                this.initRowSelection();
            }

            if (this.hasTooltips()) {
                this.initTooltips();
            }
        }

        if ($that.reloadInSeconds()) {
            setInterval(
                function () {
                    window.location.reload();
                },
                $that.reloadInSeconds() * 1000
            );
        }
    },

    initStaticFormData: function () {
        let $that = this;

        $('.js-static-form-data').each(function () {
            $that.staticFormData[$(this).attr('name')] = $(this).val();
        });
    },

    getCurrentPage: function () {
        let $aPage = $('ul.js-search-pager li.uk-active:first a');
        let $page;

        if ($aPage !== 'undefined' && ($page = $aPage.data('page'))) {
            return $page;
        }

        return 1
    },

    getSearchUrl: function (selector) {
        selector = selector || '.js-search-table';
        return $(selector).data('search-url');
    },

    getExportUrl: function () {
        return $('.js-search-table').data('export-url');
    },

    getItemsPerPage: function () {
        return $('.js-search-items-per-page:first').val();
    },

    isNewUI: function () {
        return $('.js-search-table').data('new-ui');
    },

    isHeaderFloating: function (tableSelector) {
        tableSelector = tableSelector || '.js-search-table';

        let $table = $(tableSelector);
        if (!isTable($table)) {
            $table = $table.find('table');
        }
        if ($table.length == 0 || !isTable($table)) {
            return;
        }
        return $table.data('is-header-floating');

        function isTable($el) {
            return $el[0].tagName === 'TABLE';
        }
    },

    hasCheckboxes: function (tableSelector) {
        tableSelector = tableSelector || '.js-search-table';

        let $table = $(tableSelector);
        if (!isTable($table)) {
            $table = $table.find('table');
        }
        if ($table.length == 0 || !isTable($table)) {
            return;
        }
        return $('.js-search-table').data('has-checkboxes');

        function isTable($el) {
            return $el[0].tagName === 'TABLE';
        }
    },

    hasTooltips: function () {
        return $('.c-ui-table__tooltip').length > 0;
    },

    reloadInSeconds: function () {
        return $('.js-search-table').data('auto-reload-seconds');
    },

    initExpandTables: function () {
        const $this = this;
        const tables = document.querySelectorAll('.c-ui-table');
        if (!tables) {
            return;
        }

        for (let i = 0, len = tables.length; i < len; i++) {
            $this.initTable(tables[i]);
        }
    },

    initTable: function (table) {
        let tableHeight = {value: null};

        if (table.classList.contains('js-table-expandable')) {
            this.expandTable(table, tableHeight);
        }
    },

    expandTable: function (table, tableHeight) {
        const tableClasses = {
            expander: 'c-ui-table__expander',
            togglerActive: 'c-ui-table__expander-control--expanded',
            hiddenRow: 'c-ui-table__expand-row--hidden',
        };
        let controls;
        let expandebles;
        let allToggle;
        const rowControls = table.querySelectorAll('tbody .' + tableClasses.expander);

        if (rowControls) {
            controls = [];
            expandebles = [];

            for (let i = 0, len = rowControls.length; i < len; i++) {
                rowControl(rowControls[i], controls, expandebles);
            }

            const allControl = table
                .querySelector('thead .' + tableClasses.expander);
            if (!allControl || !controls.length) {
                return;
            }

            allToggle = allControl.querySelector('.' + tableClasses.expander + '-control');
            if (!allToggle) {
                return;
            }

            allToggle.isExpanded = isExpanded(controls);
            controlClass(allToggle.classList, tableClasses.togglerActive, allToggle.isExpanded);
            toggleRowClass(allToggle.classList, allToggle.isExpanded);

            allToggle.addEventListener('click', function () {
                const expanded = !this.isExpanded;

                this.isExpanded = expanded;
                controlClass(this.classList, tableClasses.togglerActive, expanded);

                for (let i = 0, len = controls.length; i < len; i++) {
                    triggerControls(controls[i]);
                }

                toggleTargetRowsClass(expandebles, expanded);

                function triggerControls(control) {
                    control.isExpanded = expanded;
                    controlClass(control.classList, tableClasses.togglerActive, expanded);
                }
            });
        }

        function rowControl(control) {
            const toggler = control.querySelector('.' + tableClasses.expander + '-control');
            let expandableRows;

            if (toggler) {
                toggler.isExpanded = false;
                controlClass(toggler.classList, tableClasses.togglerActive, toggler.isExpanded);
                controls.push(toggler);

                const targetId = control.dataset.expand;
                if (!targetId) {
                    return;
                }

                expandableRows = table.querySelectorAll('[data-expand-target="' + targetId + '"]');
                if (!expandableRows) {
                    return;
                }

                for (let i = 0, len = expandableRows.length; i < len; i++) {
                    expandebles.push(expandableRows[i]);
                }

                toggler.addEventListener('click', toggleExpandableRows);
            }

            function toggleExpandableRows() {
                const controlExpanded = !this.isExpanded;
                this.isExpanded = controlExpanded;

                controlClass(this.classList, tableClasses.togglerActive, controlExpanded);
                toggleTargetRowsClass(expandableRows, controlExpanded);

                if (allToggle) {
                    const allExpanded = isExpanded(controls);
                    controlClass(
                        allToggle.classList,
                        tableClasses.togglerActive,
                        allExpanded
                    );
                    allToggle.isExpanded = allExpanded;
                }
            }

        }


        function controlClass(nodeClassList, className, expand) {
            nodeClassList[expand ? 'add' : 'remove'](className);
        }

        function isExpanded(arrOfNodes) {
            return arrOfNodes.some(checkExpand);
        }

        function checkExpand(node) {
            return node.isExpanded;
        }

        function toggleTargetRowsClass(nodes, show) {
            for (let i = 0, len = nodes.length; i < len; i++) {
                toggleRowClass(nodes[i].classList, show);
            }
            tableHeight.value = table.offsetHeight;
        }

        function toggleRowClass(nodeClassList, show) {
            nodeClassList[show ? 'remove' : 'add'](tableClasses.hiddenRow);
        }
    },

    search: function ($page, $itemsPerPage, $sortColumn, $sortOrder, $urlSelector, $containerSelector) {
        const $that = this;

        $containerSelector = $containerSelector || '.js-table-container';
        $($containerSelector + ' .c-loading').removeClass('c-loading--hidden');
        $($containerSelector + ' .c-card__loading').addClass('is-active');

        Services.showLoader = function () {
        };
        Services.hideLoader = function () {
        };
        let params = {};
        (new URL(location.href))
            .searchParams
            .forEach(function (v, k) {
                params[k] = v
            });
        let $loader = $('#pageLoader');
        if ($loader.length) {
            $('#pageLoader').addClass('c-content-loading');
            $('html').addClass('c-loader-overflow');
        }

        window.Services.ajaxPOSTRequestHTML(
            $that.getSearchUrl($urlSelector),
            $.extend(
                {
                    sortColumn: $sortColumn,
                    sortOrder: $sortOrder,
                    items: $itemsPerPage,
                    page: $page,
                    params: params
                },
                $that.searchFormArray,
                $that.staticFormData
            ),
            function (data) {
                $containerSelector = $containerSelector || '.js-table-container';
                $($containerSelector).replaceWith(data);
                window.ga('send', 'pageview');
                if ($that.isNewUI()) {
                    $that.initSelect2($containerSelector);

                    if ($that.isHeaderFloating($containerSelector)) {
                        $that.fixTableHeader($containerSelector);
                    }

                    if ($that.hasCheckboxes()) {
                        $that.initRowSelection();
                    }
                }

                const tables = document.querySelectorAll('.c-ui-table');
                if (!tables) {
                    return;
                }

                for (let i = 0, len = tables.length; i < len; i++) {
                    $that.initTable(tables[i]);
                }

                $($containerSelector).trigger('onSearchFinished');

                if ($loader.length) {
                    $('#pageLoader').removeClass('c-content-loading');
                    $('html').removeClass('c-loader-overflow');
                    Services.commonSelect2();
                }

                var $expandBtn = $('.js-expand-comment'),
                    $expandRow = $('.js-expanded-row');
                if ($expandBtn.length && $expandRow.length) {
                    $expandBtn.on('click', function () {
                        // toggle class of expand button parent row
                        $(this).parents('tr').toggleClass('c-profile-rating__expanded-product-row');

                        var expandeData = $(this).parent('td').data('expand'),
                            expandedRow = $(this).parents('tr').next();

                        $(this).toggleClass('c-ui-table__expander-control--expanded');
                        expandedRow.toggleClass('c-ui-table__expand-row--hidden');
                    });
                }
            },
            false,
            true
        );
    },

    requestExport: function ($searchFormArray, $staticFormData, $sortColumn, $sortOrder, $url) {
        $url = $url || this.getExportUrl();
        window.Services.ajaxPOSTRequestJSON(
            $url,
            $.extend(
                {
                    sortColumn: $sortColumn,
                    sortOrder: $sortOrder
                },
                $searchFormArray,
                $staticFormData
            ),
            function (data) {
                window.UIkit.modal.alert("<div class='modal-confirm'><span class='modal-confirm-icon' uk-icon='icon: warning; ratio: 5'></span> <h2></h2></div> " + data, {
                    labels: {
                        'ok': 'تایید'
                    }
                });
                $('.modal-confirm').parent().siblings('.uk-modal-footer').removeClass('uk-text-right').addClass('uk-text-center').css('border', 'none');
            },
            false,
            true
        );
    },

    initSelect2: function (containerSelector) {
        const $selects = containerSelector
            ? $(containerSelector).find('.js-search-items-per-page, .c-ui-select--common')
            : $('.js-search-items-per-page, .c-ui-select--common');

        if ($selects.length) {
            for (let i = 0, len = $selects.length; i < len; i++) {
                const $select = $($selects[i]);
                // const $dropdown = $select.siblings('.js-select-options').length > 0 && $select.siblings('.js-select-options') || null;
                $select.select2({
                    placeholder: $select.attr('placeholder'),
                    dropdownParent: null,
                    minimumResultsForSearch: $select.hasClass('c-ui-select--search') ? 0 : Infinity,
                    language: window.Services.selectSearchLanguage
                }).data('select2').$dropdown.addClass('c-ui-select__dropdown c-ui-select__dropdown--gap');

            }
        }
    },

    fixTableHeader: function (containerSelector) {
        containerSelector = containerSelector || '.js-table-container';

        const container = document.querySelector(containerSelector);
        const tables = container.querySelectorAll('.js-search-table');
        let navbarHeight;
        let posY;

        tables.forEach(function initTable(table) {
            let transformed;
            let ticker;

            const headerRow = table.querySelector('thead .c-ui-table__row');
            if (!headerRow) {
                return;
            }

            const headers = headerRow.querySelectorAll('.c-ui-table__header');
            if (headers) {
                if (!navbarHeight) {
                    const nav = document.querySelector('.js-header-nav');
                    navbarHeight = nav ? nav.clientHeight : 0;
                }
                posY = posY || window.scrollY;
                transformed = false;
                ticker = false;

                window.addEventListener('scroll', fixTableHeader);
            }

            function fixTableHeader() {
                posY = window.scrollY;
                if (!ticker) {
                    window.requestAnimationFrame(animateHeader);
                    ticker = true;
                }
            }

            function animateHeader() {
                setHeaderPosition();
                ticker = false;
            }

            function setHeaderPosition() {
                const MIN_POSITION = 300;
                const scrolled = posY;
                const tablePositionY = offsetTop(table, scrolled);
                const fromTop = navbarHeight + scrolled;
                const minShift = tablePositionY + table.scrollHeight - MIN_POSITION;

                if (fromTop > minShift) {
                    return;
                }
                if (fromTop >= tablePositionY) {
                    const translateY = Math.floor(fromTop - tablePositionY);
                    const transformValue = 'transform: translate3d(0, ' + translateY + 'px, 0);';

                    assignTransformToElements(headers, transformValue);
                    transformed = true;
                } else if (transformed) {
                    const transformValue = 'transform: none;';

                    assignTransformToElements(headers, transformValue);
                    transformed = false;
                }
            }
        });

        function assignTransformToElements(nodes, style) {
            for (let i = 0, length = nodes.length; i < length; i++) {
                nodes[i].style = style;
            }
        }

        function offsetTop(node, shiftY) {
            return node.getBoundingClientRect().top + shiftY;
        }
    },

    initTooltips: function () {
        $(document).on('mouseenter', '.c-ui-table__info', function () {
            const $info = $(this);
            const $tooltip = $info.find('.c-ui-table__tooltip');
            const $wrapper = $tooltip.closest('.c-ui-table');
            let $visibleTooltip = null;

            $tooltip.show();
            const style = {
                top: $tooltip.offset().top,
                left: $tooltip.offset().left,
                height: $tooltip.innerHeight(),
                display: 'block',
            };
            $visibleTooltip = $tooltip.clone().css(style).appendTo('body');
            $tooltip.removeAttr("style");

            $wrapper.on('scroll', detectScroll);
            $(document).on('scroll', detectScroll);
            $info.on('mouseleave', detectScroll);

            function detectScroll() {
                if (!$visibleTooltip) {
                    return;
                }

                /** @var $visibleTooltip.remove() */
                $visibleTooltip.remove();
                $wrapper.off('scroll', detectScroll);
                $(document).off('scroll', detectScroll);
            }
        });
    },

    initRowSelection: function (containerSelector) {
        containerSelector = containerSelector || '.c-ui-table';
        const checkboxesSelector = containerSelector + ' .c-ui-checkbox__origin';
        const $rowCheckboxes = $(checkboxesSelector);

        if (!($rowCheckboxes.length > 1)) {
            return;
        }

        $(document).on('change', checkboxesSelector, function () {
            const $toggledCheckbox = $(this);
            const $table = $toggledCheckbox.closest('.c-ui-table');
            const $checkboxes = $table.find('input:checkbox');
            let enabledCreateBtn = false;
            let isAllChecked = true;

            if ($checkboxes[0] === this) {
                enabledCreateBtn = this.checked;

                for (let i = 1, len = $checkboxes.length; i < len; i++) {
                    $checkboxes[i].checked = enabledCreateBtn;
                    setSelectedRow($checkboxes[i], enabledCreateBtn);
                }
            } else {
                for (let i = 1, len = $checkboxes.length; i < len; i++) {
                    if (!$checkboxes[i].checked) {
                        isAllChecked = false;
                        break;
                    }
                }
                $checkboxes[0].checked = isAllChecked;
                setSelectedRow(this, this.checked);
            }
        });

        let $variants = $('[name="selected-variants"]');

        if ($variants.length <= 0) {
            $variants = $('[name="search[selected-variants]"]');
        }

        if ($variants.length > 0) {
            let selectedVariants = $variants.val();

            if (selectedVariants.length > 0) {
                let activateCreateButton = false;

                selectedVariants = selectedVariants.split(',');

                const $orders = $('[name="add-to-order"]');
                if ($orders.length > 0) {
                    selectedVariants.forEach(function (value) {
                        $orders.each(function (key, item) {
                            if (item.value === value) {
                                $(this).prop('checked', true);
                                activateCreateButton = true;
                            }
                        });
                    });
                }

                const $consignment = $('[name="add-to-package"]');
                if ($consignment.length > 0) {
                    selectedVariants.forEach(function (value) {
                        $consignment.each(function (key, item) {
                            if (item.value === value) {
                                $(this).prop('checked', true);
                                activateCreateButton = true;
                            }
                        });
                    });
                }

                if (activateCreateButton) {
                    $('.js-create-package').attr('disabled', false);
                }
            }
        }

        function setSelectedRow(checkbox, isSelected) {
            const row = checkbox.closest('tr');
            if (!row) {
                return;
            }

            row.classList[isSelected ? 'add' : 'remove']('is-selected');
        }
    },

    initPrepareSearchRadioGroup() {
        $('.js-search-radio-group-container label').on('click', function () {
            if (!$(this).hasClass('c-ui-search-radio-group-container__label--checked')) {
                $(this).addClass('c-ui-search-radio-group-container__label--checked');
                $(this).siblings('label').removeClass('c-ui-search-radio-group-container__label--checked');

            }
        })
    },


    initOnEndEvent() {
        $(document).triggerHandler('tableViewEnd');
    }
};

$(function () {
    window.TableView.init();
});
