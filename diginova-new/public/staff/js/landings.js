var Promotion = {
    init: function () {
        this.initSelect();
        this.initDatePickers();
        this.initTableInput();
        this.initNumericInput();
        this.initSearchForm();
    },

    initSelect: function () {
        var selects = document.querySelectorAll('.c-ui-select--common');
        if (!selects) {
            return;
        }

        for (var i = 0, len = selects.length; i < len; i++) {
            setSelect2(selects[i]);
        }

        function setSelect2(select)
        {
            var $select = $(select);
            var selectPlaceholder = $select.attr('placeholder');
            var hasSearch = $select.hasClass('c-ui-select--search');

            $select.select2({
                placeholder: selectPlaceholder,
                minimumResultsForSearch: hasSearch ? 0 : Infinity,
                language: window.Services.selectSearchLanguage
            }).data('select2').$dropdown.addClass('c-ui-select__dropdown c-ui-select__dropdown--gap');
        }
    },

    initDatePickers: function () {

        var initDatePicker = function (el, onSelectExtraWorks) {

            var name = $(el).attr('data-name');
            var id = name.replace(/(:|\.|\[|\]|\\)/g, '_');
            $(el).siblings('input[type="hidden"]').first().attr('id', id);
            $(el).attr('data-name', id);
            var date = $(el).data('date') | 0;
            var time = $(el).data('time') | 0;
            var format = $(el).data('format') || 'LLLL';
            var value = $(el).val();
            return $(el).persianDatepicker({
                format: format,
                initialValue: value,
                altFormat: 'g',
                altField: '#' + $(el).attr('data-name'),
                firstRun: true,
                firstRunPersian: true,
                autoClose: !time && true,
                onlyTimePicker: !date,
                minDate: $(el).data('from-today') ? new Date().getTime() : null,
                timePicker: {
                    enabled: time,
                    second: false
                },
                toolbox: {
                    submitButton: {
                        enabled: true
                    },
                    todayButton: {
                        enabled: false
                    },
                    calendarSwitch: {
                        enabled: false
                    }
                },
                altFieldFormatter: function (unixDate) {
                    var self = this;
                    var thisAltFormat = self.altFormat.toLowerCase();

                    if (thisAltFormat === 'gregorian' || thisAltFormat === 'g') {
                        var d = new Date(unixDate);
                        var dateTime = [];
                        if (!this.onlyTimePicker) {
                            dateTime.push(d.getFullYear() + '-' + ("0" + (d.getMonth() + 1)).slice(-2) + '-' + ("0" + d.getDate()).slice(-2));
                        }
                        if (this.timePicker.enabled) {
                            dateTime.push(("0" + d.getHours()).slice(-2) + ':' + ("0" + d.getMinutes()).slice(-2) + ':' + ("0" + d.getSeconds()).slice(-2));
                        }
                        return dateTime.join(' ');
                    }
                    if (thisAltFormat === 'iso') {
                        var d = new Date(unixDate);
                        return d.toISOString();
                    }

                },
                formatter: function (unixDate) {
                    var self = this;
                    var pdate = new persianDate(unixDate);
                    pdate.formatPersian = this.persianDigit;
                    return pdate.format(self.format);
                },
                onSelect: function (unixDate) {
                    $(el).siblings('input[type="hidden"]').first().trigger('change');
                    $(el).keyup();
                    if (!!onSelectExtraWorks) {
                        onSelectExtraWorks(unixDate);
                    }
                }
            });
        };

        $('.js-promotion-date-picker').each(function () {
            $(this).attr('value', $(this).attr('value').replace(/-/ig, '/'));

            //if data picker is already initialized get the value from hidden input field
            var hiddenFieldName = $(this).data('name');
            var hiddenField = $('[name="' + hiddenFieldName + '"]');
            if (hiddenField.length) {
                $(this).attr('value', hiddenField.val());
            }
            initDatePicker(this);
        });

        // TODO : fix range date picker
        $('.js-promotion-range-date-picker').each(function () {
            var $rangeContainer = $(this);
            var $fromElem = $rangeContainer.find('.js-date-from').first();
            var $toElem = $rangeContainer.find('.js-date-to').first();
            var from, to;

            from = initDatePicker($fromElem.get(0), function (unix) {
                from.touched = true;
                if (to && to.options && to.options.minDate !== unix) {
                    var cachedValue = to.getState().selected.unixDate;
                    to.options = {minDate: unix};
                    if (to.touched) {
                        to.setDate(cachedValue);
                    }
                }
            });

            to = initDatePicker($toElem.get(0), function (unix) {
                to.touched = true;
                if (from && from.options && from.options.maxDate !== unix) {
                    var cachedValue = from.getState().selected.unixDate;
                    from.options = {maxDate: unix};
                    if (from.touched) {
                        from.setDate(cachedValue);
                    }
                }
            });
        });
    },
    initTableInput: function () {
        $(document).on('click', '.js-spinner-wheel', function (e) {
            var wheelStep = $(this).hasClass('js-spinner-wheel-up') ? 1 : -1;
            var siblingInput = $(this).parents('.js-number-input-wrapper').children('input');
            var currentVal = parseInt(siblingInput.val());
            var min = siblingInput.attr('min') || 1;
            var max = siblingInput.attr('max') || 1000;
            if (isNaN(currentVal)) {
                currentVal = 0;
                siblingInput.val(min);
            }
            if (currentVal >= min) {
                var nextVal = currentVal + wheelStep;
                if (nextVal <= min) {
                    siblingInput.val(min);
                } else if (nextVal >= max) {
                    siblingInput.val(max);
                } else {
                    siblingInput.val(nextVal);
                }
            } else {
                siblingInput.val(min);
            }

            $($(this).closest('.js-number-input-wrapper').find('.js-number-input'), document).change();
        });

        $(document).on('keydown', '.js-number-input', function (e) {
            if (e.keyCode === 38) {
                $($(this).parent('.js-number-input-wrapper').find('.js-spinner-wheel-up'), document).click();
            } else if (e.keyCode === 40) {
                $($(this).parent('.js-number-input-wrapper').find('.js-spinner-wheel-down'), document).click();
            }
        });


        var timeout;

        $(document).on('mousedown', '.js-spinner-wheel', function () {
            var $button = $(this);
            timeout = setInterval(function () {
                if ($button.hasClass('js-spinner-wheel-up')) {
                    $($button.closest('.js-number-input-wrapper').find('.js-spinner-wheel-up'), document).click();
                } else {
                    $($button.closest('.js-number-input-wrapper').find('.js-spinner-wheel-down'), document).click();
                }

                $($button.closest('.js-number-input-wrapper').find('.js-number-input'), document).change();
            }, 150);

            return false;
        });

        $(document).on('mouseup', '.js-spinner-wheel', function () {
            clearInterval(timeout);
            return false;
        });
    },
    initNumericInput: function () {
        $('.js-numeric-input', document).inputFilter(function (value) {
            return /^\d*$/.test(value); // Allow digits only, using a RegExp
        });
    },
    initSearchForm: function () {
        $(document).on('change', '.js-auto-submit', function () {
           $(this).closest('form').submit();
        });
    },
    displayError: function (errors) {
        var message = '';
        if (typeof errors === typeof  "") {
            message = errors;
        } else if (typeof errors === typeof {}) {
            try {
                message = Object.values(errors).join('<br/>');
            } catch (e) {
                message = errors;
            }
        }
        UIkit.notification({
            message: message,
            status: 'danger',
            pos: 'bottom-right',
            timeout: 8000
        });
    }
};

(function ($) {
    $.fn.inputFilter = function (inputFilter) {
        return this.on('input keydown keyup mousedown mouseup select contextmenu drop', function () {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
        });
    };
}(jQuery));

$(function () {
    Promotion.init();
});



/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/controllers/productListController/itemAction.js]*/
ProductListController = {
    displayName: "ProductListController",
    promotion: window.promotion || {},
    pageId: window.promotion && window.promotion.id,
    pageData: null,
    addedVariants: {},
    searchVariants: {},
    pager: null,
    baseSearchUrl: '',
    isEmptyList: false,
    selectedCount: 0,

    init: function () {
        var fns = [
            this.initModal,
            this.initCreatePage,
            this.initSearchProducts,
            this.initPager,
            this.initAddProduct,
            this.initRemoveProduct,
            this.initUploadExcel
        ];

        for (var i = 0; i < fns.length; ++i) {
            try {
                fns[i].bind(this)();
            } catch (e) {
                console.log("Error in " + this.displayName + ": ", e);
            }
        }
    },

    initModal: function () {
        var self = this;

        $('.js-select-products-modal-trigger').on('click', function (e) {
            if ($(this).hasClass('js-empty-selected-products')) {
                self.isEmptyList = true;
            }
            UIkit.modal('#js-select-products').show();
            $('#select-search-form').submit();
        });
    },

    initCreatePage: function () {
        var self = this;
        var $submitButton = $('.js-save-list-page-button');

        $('.js-create-plp-form').submit(function (e) {
            e.preventDefault();

            $submitButton.prop('disabled', true);

            Services.ajaxPOSTRequestJSON(
                'update/' + (!!self.promotion && self.promotion.id ? self.promotion.id : 0),
                $(this).serialize(),
                function (response) {
                    UIkit.notification({
                        message: 'تغییرات شما ثبت گردید',
                        status: 'success',
                        pos: 'top-left',
                        timeout: 3000
                    });
                    setTimeout(function () {
                        if (!self.promotion.id) {
                            window.location.href = response.redirectUrl;
                        }
                    }, 3000);
                },
                function (errors) {
                    Promotion.displayError(errors.errors);
                    $submitButton.prop('disabled', false);
                }
            )
        });


        $('.js-save-list-page-button').on('click', function () {
            $('.js-create-plp-form').submit();
        });
    },

    initSearchProducts: function () {
        var self = this;
        var $selectFormSearch = $('#select-search-form');
        var $spinner = $('.js-modal-loading');
        var url = self.promotion.id + '/search/';

        $selectFormSearch.submit(function (e) {
            e.preventDefault();
            $spinner.addClass('is-active');

            Services.ajaxGETRequestHTML(
                url,
                $selectFormSearch.serialize(),
                function (html) {
                    $('.js-products-content').html(html);
                    self.selectedCount = self.selectedCount > 0 ? self.selectedCount : $('.js-selected-variants-count', document).data('count');
                    $('.js-selected-variants-count', document).text(Services.convertToFaDigit(self.selectedCount));
                    $spinner.removeClass('is-active');
                }
            );
        });

        if (!!self.promotion.id) {
            $selectFormSearch.submit();
        }

        $(document).on('change', '.js-search-sort', function () {
            $selectFormSearch.submit();
        });
    },

    initPager: function () {
        var self = this;
        var url = self.promotion.id + '/search';
        var $spinner = $('.js-modal-loading');

        $(document).on('click', '.js-adservice-pager a', function (e) {
            e.preventDefault();

            $spinner.addClass('is-active');
            Services.ajaxGETRequestHTML(
                url + '?page=' + $(this).data('page'),
                $('#select-search-form').serialize(),
                function (html) {
                    $('.js-products-content').html(html);
                    self.selectedCount = self.selectedCount > 0 ? self.selectedCount : $('.js-selected-variants-count', document).data('count');
                    $('.js-selected-variants-count', document).text(Services.convertToFaDigit(self.selectedCount));
                    $spinner.removeClass('is-active');
                    self.checkAlreadyAddedVariants();
                    if (Object.keys(self.addedVariants).length > 0) {
                        $('.js-submit-selected-items', document).removeClass('uk-disabled');
                    }
                }
            );
        });
    },

    initAddProduct: function () {
        var self = this;

        $(document).on('change', '.js-selected-item', function () {
            var variantId = $(this).val();
            if ($(this).is(':checked')) {
                self.addedVariants[variantId] = variantId;
                self.selectedCount++;
            } else {
                delete self.addedVariants[variantId];
                self.selectedCount--;
            }

            $('.js-selected-variants-count', document).text(Services.convertToFaDigit(self.selectedCount));

            if (Object.keys(self.addedVariants).length > 0) {
                $('.js-submit-selected-items', document).removeClass('uk-disabled');
            } else {
                $('.js-submit-selected-items', document).addClass('uk-disabled');
            }
        });

        $(document).on('change', '.js-select-all-products', function () {
            if ($(this).is(':checked')) {
                $('.js-selected-item:not(:disabled)', document).prop('checked', true).trigger('change');
            } else {
                $('.js-selected-item:not(:disabled)', document).prop('checked', false).trigger('change');
            }
        });

        $(document).on('click', '.js-submit-selected-items', function () {
            Services.ajaxPOSTRequestJSON(
                'addVariant/' + (!!self.promotion && self.promotion.id ? self.promotion.id : 0),
                {
                    variantIds: self.addedVariants
                },
                function (response) {
                    self.addedVariants = {};
                    UIkit.modal('#js-select-products').hide();
                    if (self.isEmptyList) {
                        $('.js-empty-list').addClass('uk-hidden');
                        $('.js-fill-list').removeClass('uk-hidden');
                    }
                    self.updateAddedVariantsList();
                },
                function (errors) {
                    Promotion.displayError(errors.errors);
                }
            );
        });
    },

    updateAddedVariantsList: function () {
        var self = this;
        var $spinner = $('.js-added-products-loading');
        $spinner.addClass('is-active');

        Services.ajaxGETRequestHTML(
            'variants/' + self.promotion.id,
            {},
            function (html) {
                $('.js-added-products-list').html(html);
                $spinner.removeClass('is-active');
            }
        );
    },

    initRemoveProduct: function () {
        var self = this;
        var timeOuts = {};

        $(document).on('click', '.js-remove-product', function () {
            var $this = $(this), promotionVariantId = $this.data('promotion_variant_id'), variantId = $this.data('variant_id');
            if (!promotionVariantId) {
                return;
            }

            $this.closest('li').find('.js-remove-overlay').removeClass('uk-hidden');
            timeOuts[promotionVariantId] = setTimeout(function () {
                Services.ajaxPOSTRequestJSON(
                    'removeVariant/' + self.promotion.id,
                    {
                        promotionVariantId: promotionVariantId
                    },
                    function (response) {
                        delete self.addedVariants[variantId];
                        $this.closest('li').remove();
                        // self.updateAddedVariantsList();
                    },
                    function (errors) {
                        Promotion.displayError(errors.errors);
                    }
                );
            }, 5000);
        });

        $(document).on('click', '.js-undo-remove-button', function (e) {
            e.preventDefault();

            var $this = $(this),
                promotionVariantId = $this.data('promotion_variant_id');
            clearTimeout(timeOuts[promotionVariantId]);

            $this.closest('li').find('.js-remove-overlay').addClass('uk-hidden');
        });


        var removeAllTimeout;
        $(document).on('click', '.js-remove-all-added-product', function (e) {
            e.preventDefault();

            var $this = $(this);
            $this.addClass('uk-hidden');
            $('.js-undo-remove-all').removeClass('uk-hidden');
            removeAllTimeout = setTimeout(function () {
                Services.ajaxPOSTRequestJSON(
                    'removeAll/' + (self.promotion.id || 0),
                    {},
                    function (response) {
                        self.addedVariants = {};
                        $('.js-added-products-list').empty();

                        $('.js-empty-list').removeClass('uk-hidden');
                        $('.js-fill-list').addClass('uk-hidden');
                    },
                    function (errors) {
                        Promotion.displayError(errors.errors);
                    }
                );
            }, 7000)
        });

        $(document).on('click', '.js-undo-remove-all', function (e) {
            e.preventDefault();

            var $this = $(this);
            $this.addClass('uk-hidden');
            $('.js-remove-all-added-product').removeClass('uk-hidden');
            clearTimeout(removeAllTimeout);
        });
    },

    initRemoveVariant: function () {
        var self = this;
        var timeOuts = {};


        $(document).on('click', '.js-remove-variant', function (e) {
            e.preventDefault();

            var self = $(this),
                promotionVariantId = self.data('promotion-variant-id');

            self.closest('tr').addClass('c-join__table-row--is-deleted');
            self.closest('tr').find('.js-action-buttons').addClass('uk-hidden');
            self.closest('tr').find('.js-undo-remove').removeClass('uk-hidden');
            self.closest('tr').find('.js-edit-actions button').prop('disabled', true);
            timeOuts[promotionVariantId] = setTimeout(function () {
                Services.ajaxPOSTRequestJSON(
                    '/ajax/seller/' + promotionId + '/delete/variant/',
                    {
                        promotionVariantId: promotionVariantId
                    },
                    function (response) {
                        self.closest('tr').remove();
                    },
                    function (error) {
                        UIkit.notification({
                            message: error.errors.permission,
                            status: 'danger',
                            pos: 'top-left',
                            timeout: 8000
                        });
                    }
                );
            }, 5000);
        });

        $(document).on('click', '.js-undo-remove-button', function (e) {
            e.preventDefault();

            var self = $(this),
                promotionVariantId = self.data('promotion-variant-id');
            clearTimeout(timeOuts[promotionVariantId]);

            self.closest('tr').removeClass('c-join__table-row--is-deleted');
            self.closest('tr').find('.js-action-buttons').removeClass('uk-hidden');
            self.closest('tr').find('.js-undo-remove').addClass('uk-hidden');
            thiz.resetInputs(self);
        });
    },

    initUploadExcel: function () {
        var self = this;
        $('.js-import-excel-file').on('change', function () {
            var file = this.files[0];
            if (!file) {
                return;
            }

            var formData = new FormData();
            formData.append('product_list_excel', file);

            $.ajax({
                url: '/ajax/product-list/' + (self.promotion.id || 1) + '/excel/import/',
                type: 'POST',
                data: formData,
                cache: false,
                header: {
                    "Content-Type": "multipart/form-data"
                },
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status === false) {
                        $('.js-upload-status-bar').removeClass('uk-hidden');
                        $('.js-upload-status-error').text(Object.values(data.data.errors).join(' '));

                        return;
                    }

                    self.updateAddedVariantsList();
                    $('.js-empty-list').addClass('uk-hidden');
                    $('.js-fill-list').removeClass('uk-hidden');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('.js-upload-status-bar').removeClass('uk-hidden');
                }
            });
            $(this).val('');
        });
    },
    checkAlreadyAddedVariants: function () {
        var variants = Object.getOwnPropertyNames(this.addedVariants);
        for (i = 0; i < variants.length; i++) {
            var variantId = variants[i];
            $('.js-checkbox-' + variantId + ' .js-selected-item').prop('checked', true)
        }
    }
};

$(function () {
    ProductListController.init();
});
