/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/controllers/profileController/ratingAction.js]*/
const RatingAction = {
    init: function () {

        var functions = [
            this.initDkCore,
            this.initSelect2,
            this.initSearchFilter,
            this.initHighchartLocales,
            this.initPageChart,
            this.initRatingChart,
            this.initCommonSelect,
            this.initSearchChange,
            this.initProductRateDetails,
            this.initRatingModal,
            this.initFilter,
            this.initProductChart,
            this.initProductScore,
            this.initExpandRow,
            this.initRatingSwipe
        ];

        var self = this;

        $(functions).map(function (index, item) {
            item = item.bind(self);

            try {
                item();
            } catch (e) {
                console.warn(e);
            }
        });
    },

    initDkCore: function () {
        window.dk = {
            core: {
                ui: {
                    compile: function (context, source) {
                        const fcall = function (param1) {
                            return eval(param1);
                        };

                        const regex = new RegExp(/{(.*?)}/g);
                        return source.replace(regex, function (match, param1) {
                            return fcall.apply(context, [param1]);
                        });
                    }
                }
            }
        };
    },

    initHighchartLocales: function () {
        (function (Highcharts) {
            const LocalizationDate = {
                options: {
                    locale: {}
                },

                addLocale: function (locale) {
                    this.options.locale[locale.lang] = locale;
                },

                defined: function (obj) {
                    return obj !== undefined && obj !== null;
                },

                pick: function () {
                    let args = arguments,
                        i,
                        arg,
                        length = args.length;
                    for (i = 0; i < length; i++) {
                        arg = args[i];
                        if (typeof arg !== 'undefined' && arg !== null) {
                            return arg;
                        }
                    }
                },

                pad: function (number, length) {
                    // Create an array of the remaining length +1 and join it with 0's
                    return new Array((length || 2) + 1 - String(number).length).join('0') + number;
                },

                getI18nByLang: function (lang) {
                    if (!this.defined(this.options.locale[lang].i18n)) {
                        throw "Invalid i18n for language";
                    }
                    return this.options.locale[lang].i18n;
                },

                getMonthName: function (month, lang) {
                    const i18n = this.getI18nByLang(lang);
                    //console.log(i18n);
                    if (!this.defined(i18n.months)) {
                        throw "i18n for months is undefined";
                    }
                    return i18n.months[month];
                },

                getWeekDay: function (weekday, lang) {
                    const i18n = this.getI18nByLang(lang);
                    if (!this.defined(i18n.weekdays)) {
                        throw "i18n for weekdays is undefined";
                    }
                    return i18n.weekdays[weekday];
                },

                getDateByLocaleLang: function (localeLang) {
                    if (!this.defined(this.options.locale[localeLang].date)) {
                        throw "Invalid date object for selected local";
                    }
                    return this.options.locale[localeLang].date;
                },

                dateFormat: function (format, timestamp, capitalize, locale) {
                    if (!this.defined(timestamp) || isNaN(timestamp)) {
                        return 'Invalid date';
                    }

                    format = this.pick(format, '%Y-%m-%d %H:%M:%S');

                    let lang = locale['lang'],
                        localeDate = this.getDateByLocaleLang(lang).getDate(timestamp),
                        date = localeDate['date'],
                        hours = localeDate['hours'],
                        day = localeDate['day'],
                        dayOfMonth = localeDate['dayOfMonth'],
                        month = localeDate['month'],
                        fullYear = localeDate['fullYear'],
                        key;

                    // List all format keys. Custom formats can be added from the outside.
                    const replacements = {
                        // Day
                        'a': this.getWeekDay(day, lang), // Short weekday, like 'Mon'
                        'A': this.getWeekDay(day, lang), // Long weekday, like 'Monday'
                        'd': this.pad(dayOfMonth), // Two digit day of the month, 01 to 31
                        'e': dayOfMonth, // Day of the month, 1 through 31

                        // Month
                        'b': this.getMonthName(month, lang), // Short month, like 'Jan'
                        'B': this.getMonthName(month, lang), // Long month, like 'January'
                        'm': this.pad(month + 1), // Two digit month number, 01 through 12

                        // Year
                        'y': fullYear.toString(), // Two digits year, like 09 for 2009
                        'Y': fullYear, // Four digits year, like 2009

                        // Time
                        'H': this.pad(hours), // Two digits hours in 24h format, 00 through 23
                        'I': this.pad((hours % 12) || 12), // Two digits hours in 12h format, 00 through 11
                        'l': (hours % 12) || 12, // Hours in 12h format, 1 through 12
                        'M': this.pad(date.getMinutes()), // Two digits minutes, 00 through 59
                        'p': hours < 12 ? 'AM' : 'PM', // Upper case AM or PM
                        'P': hours < 12 ? 'am' : 'pm', // Lower case AM or PM
                        'S': this.pad(date.getSeconds()), // Two digits seconds, 00 through  59
                        'L': this.pad(Math.round(timestamp % 1000), 3) // Milliseconds (naming from Ruby)
                    };

                    // do the replaces
                    for (key in replacements) {
                        while (format.indexOf('%' + key) !== -1) { // regex would do it in one line, but this is faster
                            format = format.replace('%' + key, typeof replacements[key] === 'function' ? replacements[key](timestamp) : replacements[key]);
                        }
                    }

                    // Optionally capitalize the string and return
                    return capitalize ? format.substr(0, 1).toUpperCase() + format.substr(1) : format;
                }
            };

            Highcharts.localizationDateFormat = function (format, timestamp, capitalize) {
                if (!LocalizationDate.defined(Highcharts.getOptions().locale)) {
                    return Highcharts.dateFormat(format, timestamp, capitalize);
                }
                const Locale = Highcharts.getOptions().locale;
                LocalizationDate.addLocale(Locale);
                return LocalizationDate.dateFormat(format, timestamp, capitalize, Locale);
            };

            Highcharts.localizationNumber = function (number) {
                if (!LocalizationDate.defined(Highcharts.getOptions().locale)) {
                    return number;
                }
                return number.toString().toPersianDigits();
            }
        }(window.Highcharts));
    },

    initPageChart: function () {
        window.Highcharts.chart('js-chart-container', {
            chart: {
                type: 'spline',
                spacing: [50, 50, 10, 50]
            },
            credits: {
                enabled: false
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                title: {
                    text: 'تاریخ',
                    align: 'high',
                    offset: 30,
                    rotation: 0,
                    x: 40,
                    y: -20,
                    style: {
                        color: '#606265',
                        fontSize: '14px'
                    }
                },
                labels: {
                    rotation: -60,
                    formatter: function () {
                        return this.value.toPersianDigits();
                    },
                    padding: 120,
                    align: 'left',
                    y: 60,
                    x: -15,
                    style: {
                        fontSize: '12px',
                        color: '#899098'
                    }
                },
                /** @var rateHistoryX */
                categories: window.rateHistoryX,
                crosshair: true
            },
            yAxis: {
                min: 0,
                max: 100,
                tickInterval: 20,
                title: {
                    text: 'امتیاز',
                    align: 'high',
                    offset: 10,
                    rotation: 0,
                    y: -30,
                    x: 0,
                    style: {
                        color: '#606265',
                        fontSize: '14px'
                    }
                },
                labels: {
                    formatter: function () {
                        return this.value.toPersianDigits();
                    },
                    style: {
                        color: '#899098',
                        fontSize: '14px',
                    },
                }
            },
            tooltip: {
                useHTML: true,
                formatter: function () {
                    const dkCoreUi = window.dk && window.dk.core && window.dk.core.ui;
                    const chartDates = this.key;
                    let html = dkCoreUi.compile(this, '<b>{this.series.name}</b>');

                    html += dkCoreUi.compile(this, '{this.point.y.toPersianDigits()} % </b><br>');
                    html += chartDates;

                    html += '</b>';
                    html += '<b>';
                    html += '</b>';
                    return html;
                },
                crosshairs: [true, true]
            },
            plotOptions: {

                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                color: 'rgb(87, 207, 177)',
                name: 'امتیاز',
                /** @var rateHistoryY */
                data: window.rateHistoryY
            }],
            legend: {
                enabled: false,
                y: -20
            }
        });
    },

    initRatingChart: function () {
        if (!$('#rating-gauge').length) return;
        $(function () {
            if (document.querySelector('#rating-gauge')) {
                const gaugeRate = window.dashboardRate || 0;
                const isDataEmpty = gaugeRate === false || gaugeRate === 0;
                const gaugeColor = isDataEmpty ? '#f3f5f9' : '#37bc9b';
                const emptyClass = isDataEmpty ? 'c-rating-chart__empty-gauge' : '';
                const chartTitleClass = 'c-rating-chart__center-gauge ' + emptyClass;

                // The rating gauge
                const gaugeOptions = {
                    chart: {
                        type: 'solidgauge',
                        margin: [0, 0, 0, 0],
                        backgroundColor: 'transparent',
                        height: '100%',
                    },
                    title: null,
                    xAxis: {
                        title: {
                            text: '',
                        }
                    },
                    yAxis: {
                        min: 0,
                        max: 100,
                        title: {
                            text: ''
                        },
                        minColor: '#37bc9b',
                        maxColor: '#48cfad',
                        lineWidth: 0,
                        tickWidth: 0,
                        minorTickLength: 0,
                        minTickInterval: 500,
                        labels: {
                            enabled: false,
                        },
                        distance: 100
                    },
                    pane: {
                        size: '95%',
                        center: ['50%', '60%'],
                        startAngle: -90,
                        endAngle: 90,
                        background: {
                            borderWidth: 20,
                            backgroundColor: '#f3f5f9',
                            shape: 'arc',
                            borderColor: '#f3f5f9',
                            outerRadius: '90%',
                            innerRadius: '90%'
                        }
                    },
                    tooltip: {
                        enabled: false
                    },
                    plotOptions: {
                        solidgauge: {
                            borderColor: gaugeColor,
                            borderWidth: 20,
                            radius: 90,
                            innerRadius: '90%',
                            dataLabels: {
                                y: -50,
                                borderWidth: 0,
                                useHTML: true
                            }
                        }
                    },
                    series: [{
                        name: 'rating',
                        data: [{
                            // color: '#ed5565',
                            // radius: '85%',
                            // innerRadius: '85%',
                            // outerRadius: '100%',
                            y: gaugeRate
                        }],
                        dataLabels: {
                            formatter: function () {
                                return '<div class="' + chartTitleClass + '">٪' +
                                    Services.convertToFaDigit(this.y) +
                                    '<span>امتیاز مثبت</span>' +
                                    '</div>';
                            },
                        },
                        tooltip: {
                            valueSuffix: '%'
                        },
                        dataGrouping: {
                            groupPixelWidth: 30
                        },
                    }],

                    credits: {
                        enabled: false
                    },
                };

                window.Highcharts.chart('rating-gauge', gaugeOptions);

                const svg = document.querySelector('.c-rating-chart svg');

                if (svg) {
                    const path = svg.getElementsByTagName('path');

                    if (path.length > 1) {
                        // First path is gauge background
                        path[0].setAttributeNS(null, 'stroke-linejoin', 'round');
                        // Second path is gauge value
                        path[1].setAttributeNS(null, 'stroke-linejoin', 'round');
                    }
                }
            }
        });
    },

    initCommonSelect: function () {
        const selects = document.querySelectorAll('.c-ui-select--common');

        for (let i = 0, len = selects.length; i < len; i++) {
            setSelect2(selects[i]);
        }

        function setSelect2(select) {
            const $select = $(select);
            const selectPlaceholder = select.getAttribute('placeholder');
            const hasSearch = select.classList.contains('c-ui-select--search');

            $select.select2({
                placeholder: selectPlaceholder,
                minimumResultsForSearch: hasSearch ? 0 : Infinity,
                language: window.Services.selectSearchLanguage
            }).data('select2').$dropdown.addClass('c-ui-select__dropdown c-ui-select__dropdown--gap');
        }
    },

    initSearchChange: function () {
        const filters = document.querySelectorAll('.js-search-filter');
        const submitBtn = document.querySelector('#submitButton');
        const clearForm = document.querySelector('#clearForm');
        const searchField = document.querySelector('#variants-search');

        let initialFormValues;
        let $clearForm;
        let $formInputs;
        let hasChanges = false;
        let isActive = false;

        if (submitBtn) {
            isActive = submitBtn.disabled;
        }

        if (clearForm) {
            initialFormValues = [];
            $clearForm = $(clearForm);
            $formInputs = $clearForm.closest('form').find('.js-form-clearable');

            $formInputs.each(collectInitialValues);
            $clearForm.on('click', clearFilterForm);
        }

        $(submitBtn).on('click', checkChanges);
        $(filters).on('change', submitForm);
        $(searchField).on('input', toggleActiveSubmit);
        $(searchField).on('keypress', function (e) {
            if (!searchField.value && (e.keyCode == 13 || e.which == 13)) {
                $(clearForm).click();
            }
        });

        function checkChanges() {
            hasChanges = !!searchField.value;
        }

        function submitForm() {
            $(submitBtn).click();
        }

        function collectInitialValues(_, input) {
            const $input = $(input);

            initialFormValues.push({
                input: $input,
                value: $input.val()
            });
        }

        function clearFilterForm(e) {
            e.preventDefault();

            initialFormValues.forEach(function (el) {
                el.input.val(el.value).trigger('change');
            });

            $(submitBtn).click();
            toggleActiveSubmit();
        }

        function toggleActiveSubmit() {
            const hasValue = !!searchField.value;
            submitBtn.disabled = !hasValue;

            const isClearDisabled = !hasValue && !hasChanges;
            clearForm.disabled = isClearDisabled;
            clearForm.classList[isClearDisabled ? 'remove' : 'add']('is-active');
            if (isActive !== submitBtn.disabled) {
                isActive = !hasValue;
            }
        }
    },

    initProductRateDetails: function () {
        let $document;
        let currentDetails;
        let bodyDetails;
        let $this = this

        if (document.querySelector('.js-rate-details')) {
            $document = $(document);
            $document
                .on('mouseover', '.js-rate-details', showDetails)
                .on('mouseout', clearDetails);
            $document.on('scroll', clearDetails);
        }

        function showDetails() {
            const settings = this.querySelector('.js-rate-details-list');

            if (bodyDetails) {
                bodyDetails.remove();
                bodyDetails = null;
            }

            if (currentDetails && currentDetails === settings) {
                currentDetails = null;
                return;
            }

            currentDetails = settings;

            const $currentDetails = $(currentDetails);

            $currentDetails.show();

            const style = {
                top: $currentDetails.offset().top,
                left: $currentDetails.offset().left,
                display: 'block',
                'z-index': 99,
            };

            bodyDetails = $currentDetails.clone()
                .css(style).prop('id', 'settings-dropdown').appendTo('body');
            $currentDetails.removeAttr("style");
            bodyDetails.css({bottom: 'unset'});
        }

        function clearDetails() {
            setTimeout(function () {
                if($('.js-rate-details-list:hover').length){
                    // $this.initRatingSwipe();
                } else {
                    if (bodyDetails) {
                        dropDetails();
                    }
                }
            }, 1000);
        }

        function removeDetails(e) {
            const target = e.target;
            const classList = target.classList;

            if (
                classList &&
                (
                    classList.contains('js-bundle-details') ||
                    classList.contains('js-bundle-details-list')
                )
            ) {
                return false;
            }

            if (bodyDetails) {
                dropDetails();
            }
        }

        function dropDetails() {
            bodyDetails.remove();
            bodyDetails = null;
            currentDetails = null;
        }
    },

    initRatingModal: function () {
        $(document).on('click', '.js-chart-details', showPriceChart);

        function showPriceChart() {
            const $chartModal = $('#modal-satisfaction-chart');
            const $dkp = $chartModal.find('.js-chart-dkp');
            const $dkpc = $chartModal.find('.js-chart-dkpc');
            const $img = $chartModal.find('.js-chart-img');
            const $title = $chartModal.find('.js-chart-title');
            const $loader = $chartModal.find('.c-card__loading');
            const dataId = this.dataset.id;

            let xhr;

            $loader.addClass('is-active');
            $chartModal.on({
                'uk.modal.hide': function () {
                    if (xhr) {
                        xhr.abort();
                        xhr = null;
                    }

                    $loader.removeClass('is-active');
                }
            });

            UIkit.modal($chartModal).show();
            // xhr = Services.ajaxGETRequestJSON(
            //     '/ajax/variants/satisfaction/chart/' + dataId + '/',
            //     {},
            //     updateDetails,
            //     function () {
            //         UIkit.modal($chartModal).hide();
            //     },
            //     true
            // ).always(function () {
            //     $loader.removeClass('is-active');
            // });

            Services.ajaxGETRequestJSON(
                '/ajax/variants/satisfaction/chart/' + dataId + '/',
                {},
                updateDetails,
                function () {
                    UIkit.modal($chartModal).hide();
                },
                true
            ).always(function () {
                $loader.removeClass('is-active');
            });

            function updateDetails(data) {
                let rowData = $('tr[data-id="' + dataId + '"]');

                $title.text($(rowData).find('.c-ui-table__cell--item-title').text());
                $dkp.text('DKP-' + rowData.data('product'));
                $dkpc.text('DKPC-' + dataId);
                $img.prop('src', $(rowData).find('.c-ui-table__cell--img > img').attr('src'));

                window.Highcharts.chart('satisfactionChart', {
                    chart: {
                        type: 'spline',
                        spacing: [50, 50, 0, 50]
                    },
                    credits: {
                        enabled: false
                    },
                    title: {
                        text: ''
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        title: {
                            text: 'تاریخ',
                            align: 'high',
                            offset: 30,
                            rotation: 0,
                            x: 40,
                            y: -20,
                            style: {
                                color: '#606265',
                                fontSize: '14px'
                            }
                        },
                        labels: {
                            rotation: -60,
                            formatter: function () {
                                return this.value.toPersianDigits();
                            },
                            padding: 120,
                            align: 'left',
                            y: 60,
                            x: -15,
                            style: {
                                fontSize: '12px',
                                color: '#899098'
                            }
                        },
                        /** @var rateHistoryX */
                        categories: data.rate_history_x,
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        max: 100,
                        tickInterval: 20,
                        title: {
                            text: 'امتیاز',
                            align: 'high',
                            offset: 10,
                            rotation: 0,
                            y: -30,
                            x: 0,
                            style: {
                                color: '#606265',
                                fontSize: '14px'
                            }
                        },
                        labels: {
                            formatter: function () {
                                return this.value.toPersianDigits();
                            },
                            style: {
                                color: '#899098',
                                fontSize: '14px',
                            },
                        }
                    },
                    tooltip: {
                        useHTML: true,
                        formatter: function () {
                            const dkCoreUi = window.dk && window.dk.core && window.dk.core.ui;
                            const chartDates = this.key;
                            let html = '<span>';

                            html += dkCoreUi.compile(this, '<b>{this.series.name}</b>');
                            html += dkCoreUi.compile(this, ' {this.point.y.toPersianDigits()}٪ <br>');
                            html += chartDates + '</span>';
                            return html;
                        },
                        crosshairs: [true, true]
                    },
                    plotOptions: {

                        line: {
                            dataLabels: {
                                enabled: true
                            },
                            enableMouseTracking: false
                        }
                    },
                    series: [{
                        color: 'rgb(87, 207, 177)',
                        name: 'امتیاز',
                        /** @var rateHistoryY */
                        data: data.rate_history_y
                    }],
                    legend: {
                        enabled: false,
                        y: -20
                    }
                });
            }
        }
    },

    initSelect2: function () {

        const $selects = $('select.c-ui-select--common');

        if ($selects.length) {
            for (let i = 0, len = $selects.length; i < len; i++) {
                const $select = $($selects[i]);

                $select.select2({
                    placeholder: $select.attr('placeholder'),
                    tags: true,
                    clear: true,
                    closeOnSelect: true
                }).data('select2').$dropdown.addClass('c-ui-select__dropdown c-ui-select__dropdown--gap');
            }
        }
    },

    initSearchFilter: function () {
        if(!$('.js-select-satisfaction-rate').length) return;
        $('.js-select-satisfaction-rate').select2().on('change', function () {
            $('.js-rating-search-btn').attr('disabled', false);
        });
    },

    initRatingSwipe: function () {
        if (!$('.js-ratin-dropDown').length) return;
        $('.js-rating-swipe').on('click', function () {
            if ($(this).data('type') === 'dissatisfaction') {
                let $loading = $(this).parent('div').siblings('div.c-card__loading');
                let variantId = $(this).parent('div').siblings('div.js-dissatisfaction-rate').data('id');
                let $dissatisfactionContainer = $(this).parent('div').siblings('.js-dissatisfaction-rate');
                $loading.addClass('is-active');

                Services.ajaxGETRequestJSON(
                    `/rating/variant-dissatisfaction/${variantId}/`,
                    {},
                    function (result) {
                        $.each(result[0], function (i, j) {
                            $dissatisfactionContainer.find(`.js-${i}-rate`).css('width', j.rate + '%');
                            $dissatisfactionContainer.find(`.js-${i}-total-rate`).html(Services.convertToFaDigit(j.rate) + '٪');
                            $dissatisfactionContainer.find(`.js-${i}-total-count`).html(Services.convertToFaDigit(j.count));
                        });
                        $loading.removeClass('is-active');
                    },
                    function (err) {
                        console.log(err, 'err');
                    },
                    true
                );
                $(this).addClass('c-profile-rating__table-satisfaction-section--active');
                $(this).siblings().removeClass('c-profile-rating__table-satisfaction-section--active');
                $(this).parent('div').siblings('.js-satisfaction-rate').addClass('uk-hidden');
                $(this).parent('div').siblings('.js-dissatisfaction-rate').removeClass('uk-hidden');
            } else {
                $(this).addClass('c-profile-rating__table-satisfaction-section--active');
                $(this).siblings().removeClass('c-profile-rating__table-satisfaction-section--active');
                $(this).parent('div').siblings('.js-satisfaction-rate').removeClass('uk-hidden');
                $(this).parent('div').siblings('.js-dissatisfaction-rate').addClass('uk-hidden');
            }
        });
    },

    initProductChart: function () {
        var variantId = $('.js-variant-id').data('id'),
            $chartLoader = $('.js-product-chart-loader');
        if (!$chartLoader.length) return;

        function renderingChart(dateX, dataY) {
            Highcharts.chart("js-product-chart", {
                chart: {
                    type: "spline",
                    height: 240,
                    spacingBottom: 20,
                    spacingTop: 20,
                    spacingLeft: 69,
                    // chart: {
                    //     type: 'spline',
                    //     spacing: [50, 50, 10, 50]
                    // },
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                legend: {

                    enabled: false,
                    y: -20
                    // align: "right",
                    // verticalAlign: "top",
                    // x: 0,
                    // y: -10
                },
                xAxis: {
                    title: {
                        text: '',
                        align: 'high',
                        offset: 30,
                        rotation: 0,
                        x: 40,
                        y: -20,
                        style: {
                            color: '#606265',
                            fontSize: '14px'
                        }
                    },
                    labels: {
                        rotation: -60,
                        formatter: function () {
                            return this.value.toPersianDigits();
                        },
                        padding: 120,
                        align: 'left',
                        y: 60,
                        x: -15,
                        style: {
                            fontSize: '12px',
                            color: '#899098'
                        }
                    },
                    /** @var rateHistoryX */
                    categories: dateX,
                    crosshair: true,
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    tickInterval: 20,
                    title: {
                        text: '',
                        align: 'high',
                        offset: 10,
                        rotation: 0,
                        y: -30,
                        x: 0,
                        style: {
                            color: '#606265',
                            fontSize: '14px'
                        }
                    },
                    labels: {
                        formatter: function () {
                            return this.value.toPersianDigits();
                        },
                        style: {
                            color: '#899098',
                            fontSize: '14px',
                        },
                    },
                },
                tooltip: {
                    useHTML: true,
                    formatter: function () {
                        const dkCoreUi = window.dk && window.dk.core && window.dk.core.ui;
                        const chartDates = this.key;
                        let html = dkCoreUi.compile(this, '<b>{this.series.name}</b>');

                        html += dkCoreUi.compile(this, '{this.point.y.toPersianDigits()} % </b><br>');
                        html += chartDates;

                        html += '</b>';
                        html += '<b>';
                        html += '</b>';
                        return html;
                    },
                    crosshairs: [true, true]
                },

                plotOptions: {

                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: false
                    }
                },
                series: [{
                    color: 'rgb(87, 207, 177)',
                    name: 'امتیاز',
                    /** @var rateHistoryY */
                    data: dataY
                }],
            });
        }

        $chartLoader.addClass('is-active');

        Services.ajaxGETRequestJSON(
            `/ajax/variants/satisfaction/chart/${variantId}/`,
            {},
            function (data) {
                
                renderingChart(data.rate_history_x.slice(-7, data.rate_history_x.length), data.rate_history_y.slice(-7, data.rate_history_y.length));
                var diffRate = data.rate_history_x.length ? (data.rate_history_y[data.rate_history_x.length - 1] - data.rate_history_y[data.rate_history_x.length - 2]).toFixed(2) : 0 ;
                $chartLoader.removeClass('is-active');
                $('.js-last-rate').html(data.rate_history_x[data.rate_history_x.length - 1]);
                $('.js-change-rate').html(Services.convertToFaDigit(diffRate) + ' %');

                if(diffRate > 0) {
                    $('.js-diff-rating').addClass('c-rating-chart__rate-change-desc--increase');
                    $('.js-diff-rating-icon').addClass('c-rating-chart__rate-change-icon--increase');
                    $('.js-diff-rating-text').text('افزایش امتیاز');
                } else if (diffRate < 0){
                    $('.js-diff-rating').addClass('c-rating-chart__rate-change-desc--decrease');
                    $('.js-diff-rating-icon').addClass('c-rating-chart__rate-change-icon--decrease');
                    $('.js-diff-rating-text').text('کاهش امتیاز');
                }
            },
            function (dta) {
                $chartLoader.removeClass('is-active');
            }
        );

    },

    initProductScore: function () {
        var $score = $('.js-product-score-loader'),
            variantIdScore = $('.js-variant-id').data('id'),
            $scoreBoard = $('.js-product-score-board'),
            $totalCount = $('.js-total-count-rating'),
            $starContainer = $('.js-rating-star-container'),
            $star = $('.js-rating-star');
        if (!$score.length) return;

        var $scoreItem = $scoreBoard.find('.js-product-score-item');
        $score.addClass('is-active');

        Services.ajaxGETRequestJSON(
            `/rating/client-scores-product/${variantIdScore}/`,
            {},
            function (result) {
                var data = result[0],
                    rating = data.totalRating;

                $scoreBoard.empty();
                $starContainer.empty();
                $totalCount.html(Services.convertToFaDigit(data.totalCount));
                $('.js-totla-rating').html(Services.convertToFaDigit(`
                    ${data.totalRating}
                    از
                    ۵
                `));

                for(let i = 1; i < 6; i++) {
                    var ratingDiff = i - rating;

                    if(i < rating) {
                        $star.find('.js-fill-star').css('width', '100%');
                    } else if(ratingDiff < 1) {
                        $star.find('.js-fill-star').css('width', (1 - ratingDiff).toFixed(2) * 100 + '%');
                    } else {
                        $star.find('.js-fill-star').css('width', '0%');
                    }
                    $star.clone().appendTo($starContainer);
                }

                $.each(data.factors, function (index, item) {
                    $scoreItem.find('.js-product-score-item-label').html(item.title);
                    $scoreItem.find('.js-product-score-item-progress').css('width', data.bars[index].percent + '%');
                    if(data.bars[index].percent >= 90){
                        $scoreItem.find('.js-product-score-item-value').html('عالی');
                    } else if (data.bars[index].percent >= 70) {
                        $scoreItem.find('.js-product-score-item-value').html('خوب');
                    } else if (data.bars[index].percent >= 50) {
                        $scoreItem.find('.js-product-score-item-value').html('معمولی');
                    } else if (data.bars[index].percent >= 30) {
                        $scoreItem.find('.js-product-score-item-value').html('بد');
                    } else {
                        $scoreItem.find('.js-product-score-item-value').html('خیلی بد');
                    }

                    $scoreItem.clone().appendTo($scoreBoard);
                });
                $score.removeClass('is-active');
            },
            function (dta) {
                $score.removeClass('is-active');
            }
        );

    },

    initFilter: function () {
        var $userType = $('.js-user-comment'),
            $sort = $('.js-sortig-filter'),
            $filter = $('.js-filter-comment'),
            $form = $('#searchForm');

        $userType.on('click', function () {
            $(this).addClass('c-profile-rating__details-filter--active');
            $(this).siblings('div').removeClass('c-profile-rating__details-filter--active');
            $filter.val($(this).data('sort'));
            $form.submit();
        });

        $sort.select2().on('change', function () {
            $filter.val($(this).val());
            $form.submit();
        });
    },

    initExpandRow: function () {
        var $expandBtn = $('.js-expand-comment'),
            $expandRow = $('.js-expanded-row');

        $expandBtn.on('click', function () {
            // toggle class of expand button parent row
            $(this).parents('tr').toggleClass('c-profile-rating__expanded-product-row');

            var expandeData = $(this).parent('td').data('expand'),
                expandedRow = $(this).parents('tr').next();

            $(this).toggleClass('c-ui-table__expander-control--expanded');
            expandedRow.toggleClass('c-ui-table__expand-row--hidden');
        });
    }

};


$(function () {
    RatingAction.init()
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