/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/promotion.js]*/
var Promotion = {
    init: function () {
        this.initDatePickers();
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



