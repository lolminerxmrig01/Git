/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/controllers/indexController/dashboardAction.js]*/
const DashboardAction = {
    init: function () {
        this.initDkCore();
        this.initHighchartLocales();
        this.initFirstChart();
        this.initRatingChart();
        this.initVariantStatusChart();
        this.initStatusMessage();
        this.initTableExpand();
        this.initSelect();
        this.initMostSellingProductsTable();
        this.initTrainingSignUp();
        this.initTrainingSelect();
        this.initNationalIdVerification();
        this.initDeadStockLog(); // TODO:IMPORTANT remove after demo test
    },

    initDeadStockLog: function () {
        if (isModuleActive("not_production")) {
            console && console.group && console.group('DEAD STOCK - TOTAL DATA');
            Services.ajaxPOSTRequestJSON(
                '/ajax/dead-stock/stats/',
                {},
                function (data) {
                    console && console.log && console.log(data);
                    console && console.groupEnd && console.groupEnd();
                },
                false,
                true
            );
        }
    },
    initDkCore: function () {
        window.dk = {
            core: {
                ui: {
                    compile: function (context, source) {
                        const fcall = function (param1) {
                            return eval(param1);
                        };

                        const regex = new RegExp(/\{(.*?)\}/g);
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
                    return obj !== 'undefined' && obj !== null;
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
            };
        }(window.Highcharts));
    },
    initFirstChart: function () {
        if (!$('#js-sales-chart-container').length) {
            return;
        }

        /** @var dashboard_sold_history_dates */
        /** @var dashboard_sold_history_quantities */
        /** @var dashboard_sold_history_prices */
        saleChart(
            window.dashboard_sold_history_dates,
            window.dashboard_sold_history_quantities,
            window.dashboard_sold_history_prices
        );

        $('.js-change-selling-chart').on('click' , function (e) {
            e.preventDefault()
            $('.js-duration-sold-items').val($(this).data("option")).trigger('change');
        })

        $('.js-duration-sold-items').on('change', function () {
            $('#js-sales-chart-container').css('display', 'none');
            const $loader = $('#sales-history-loading');
            $loader.addClass('is-active');
            /** @var stats_ajax_url */
            /** @var data.prices */
            Services.ajaxPOSTRequestJSON(
                window.stats_ajax_url,
                {
                    'stats[duration]': $(this).val(),
                    'stats[type]': 'soldItems'
                },
                function (data) {
                    saleChart(data.dates, data.quantities, data.prices);
                },
                false,
                true
            ).always(function () {
                $loader.removeClass('is-active');
                $('#js-sales-chart-container').css('display', 'block');
            });
        });

        function saleChart($dates, $quantities, $prices)
        {
            window.Highcharts.chart(
                'js-sales-chart-container',
                {
                    credits: {
                        enabled: false
                    },
                    lang: {
                        resetZoom: "پیش فرض بزرگنمایی",
                        resetZoomTitle: "پیش فرض بزرگنمایی",
                    },
                    title: {
                        text: "",
                        useHTML: false,
                        style: {fontFamily: "IRANSans,sans-serif"},
                    },
                    legend: {
                        align: "center",
                        backgroundColor: "#f5f7fa",
                        floating: false,
                        // layout: "vertical",
                        useHTML: true,
                        verticalAlign: "top",
                        x: 80,
                        y: 55,
                        itemStyle: {
                            fontFamily: "IRANSans,sans-serif"
                        },
                    },
                    plotOptions: {
                        spline: {
                            marker: {
                                enabled: true,
                                lineWidth: 1,
                                radius: 4,
                            }
                        }
                    },
                    tooltip: {
                        crosshairs: true,
                        backgroundColor: "#48cfad",
                        borderWidth: 0,
                        style: {
                            fontFamily: "IRANSans,sans-serif"
                        },
                        formatter: function () {
                            let html = window.dk.core.ui.compile(this, '<b>{this.series.name}</b> :');

                            if (this.series.index === 1) {
                                html += window.dk.core.ui.compile(this, '{String(this.point.y).toPersianCurrency()}</b><br>');
                            } else {
                                html += window.dk.core.ui.compile(this, '{String(this.point.y).toPersianDigits()}</b><br>');
                            }

                            return html;
                        },
                        useHTML: true
                    },
                    chart: {
                        type: "spline",
                        // renderTo: "js-orders-chart-container",
                        defaultSeriesType: "spline",
                        zoomType: "xy",
                        resetZoomButton: {
                            position: {
                                align: "left",
                                verticalAlign: "top",
                                x: 10,
                                y: 10
                            },
                        },
                    },
                    xAxis: [{
                        categories: $dates,
                        crosshair: true,
                        index: 0,
                        isX: true,
                        labels: {
                            y: 20,
                            rotation: -45,
                            formatter: function () {
                                return this.value.toPersianDigits();
                            }
                        },
                        tickWidth: 0,
                        title: {
                            enabled: false,
                            text: "",
                            useHTML: true
                        }

                    }],
                    yAxis: [{
                        gridLineWidth: 0,
                        index: 0,
                        title: {
                            useHTML: true,
                            text: "مبلغ",
                            style: {
                                color: "#777777",
                                fontSize: "15px",
                                fontFamily: "IRANSans,sans-serif",

                            }
                        },
                        labels: {
                            x: -20,
                            style: {
                                color: "#777777",
                            },
                            formatter: function () {
                                return String(this.value).toPersianCurrency()
                            }
                        }
                    }, {
                        gridLineWidth: 0,
                        index: 1,
                        title: {
                            useHTML: true,
                            text: "تعداد",
                            style: {
                                color: "#777777",
                                fontSize: "15px",
                                fontFamily: "IRANSans,sans-serif",
                            }
                        },
                        labels: {
                            x: 40,
                            formatter: function () {
                                return String(this.value).toPersianDigits();
                            },
                            style: {
                                color: '#777777',
                                fontFamily: "IRANSans,sans-serif",
                            }
                        },
                        opposite: true
                    }],
                    series: [
                        {
                            data: $quantities,
                            marker: {"lineWidth": 1},
                            yAxis: 1,
                            lineColor: '#da4453',
                            tooltip: {valueSuffix: " mm"},
                            name: "تعداد",
                            useHTML: true
                        },
                        {
                            data: $prices,
                            marker: {"lineWidth": 2},
                            yAxis: 0,
                            lineColor: "#48cfad",
                            tooltip: {valueSuffix: " mm"},
                            name: "مبلغ",
                            useHTML: true
                        }
                    ]
                }
            );
        }
    },
    initRatingChart: function () {
        $(function () {
            if (document.querySelector('#rating-gauge')) {
                /** @var dashboardRate */
                const gaugeRate = window.dashboardRate || 0;
                const isDataEmpty = gaugeRate === 0 || gaugeRate === false;
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
                                y: 5,
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
    initVariantStatusChart: function () {
        $(function () {
            if (!$('#js-container-variant').length) {
                return;
            }

            /** @var dashboard_variant_all */
            /** @var dashboard_variant_active_with_inventory */
            /** @var dashboard_variant_active_false */
            /** @var dashboard_variant_active_without_inventory */
            window.Highcharts.chart('js-container-variant', {
                credits: {
                    enabled: false
                },
                chart: {
                    type: 'solidgauge',
                    height: '60%',

                },
                title: {
                    text: 'variant status',
                    style: {
                        fontSize: '24px',
                        display: 'none'
                    }
                },
                tooltip: {
                    enabled: false
                },
                pane: {
                    startAngle: 0,
                    endAngle: 270,
                    background: [{ // Track for Move
                        outerRadius: '85%',
                        innerRadius: '70%',
                        backgroundColor: window.Highcharts.Color('#37bc9b')
                            .setOpacity(0.1)
                            .get(),

                        borderWidth: 0
                    }, { // Track for Move
                        outerRadius: '65%',
                        innerRadius: '50%',
                        backgroundColor: window.Highcharts.Color('#4a89dc')
                            .setOpacity(0.1)
                            .get(),
                        borderWidth: 0
                    }, { // Track for Exercise
                        outerRadius: '45%',
                        innerRadius: '30%',
                        backgroundColor: window.Highcharts.Color('#ed5565')
                            .setOpacity(0.1)
                            .get(),
                        borderWidth: 0
                    }, { // Track for Stand
                        outerRadius: '25%',
                        innerRadius: '10%',
                        backgroundColor: window.Highcharts.Color('#fdc364')
                            .setOpacity(0.1)
                            .get(),
                        borderWidth: 0
                    }]
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    lineWidth: 0,
                    tickPositions: []
                },
                plotOptions: {
                    solidgauge: {
                        dataLabels: {
                            enabled: false
                        },
                        linecap: 'round',
                        stickyTracking: false,
                        rounded: true
                    }
                },
                series: [{
                    name: 'All',
                    data: [{
                        color: '#37bc9b',
                        radius: '85%',
                        innerRadius: '70%',
                        y: window.dashboard_variant_all
                    }]
                }, {
                    name: 'Active with inventory',
                    data: [{
                        color: '#4a89dc',
                        radius: '65%',
                        innerRadius: '50%',
                        y: window.dashboard_variant_active_with_inventory
                    }]
                }, {
                    name: 'Inactive',
                    data: [{
                        color: '#ed5565',
                        radius: '45%',
                        innerRadius: '30%',
                        y: window.dashboard_variant_active_false
                    }]
                }, {
                    name: 'Active without inventory',
                    data: [{
                        color: '#fdc364',
                        radius: '25%',
                        innerRadius: '10%',
                        y: window.dashboard_variant_active_without_inventory
                    }]
                }]
            });
        });
    },


    initStatusMessage: function statusesMessages()
    {
        const statusClass = 'c-interactive-status';
        const $statusWithMessage = $('.js-status-message');

        $statusWithMessage.each(function addStatusHandlers()
        {
            const $status = $(this);
            const $message = $status.find('.' + statusClass + '__message');
            const $fade = $message.find('.' + statusClass + '__message-fade');

            $status.on('click', function showStatusMessage(e)
            {
                e.stopPropagation();

                if ($message.length && $fade.length) {
                    $message.removeClass('uk-hidden');
                }
            });

            $fade.on('click', function hideStatusMessage(e)
            {
                e.stopPropagation();

                $message.addClass('uk-hidden');
            });
        });
    },

    settings: {
        collapsedAmountOfRows: 4,
        hiddenRows: undefined,
    },

    initTableExpand: function tableExpanding()
    {
        const context = this;
        const callapsedAmountOfRows = context.settings.collapsedAmountOfRows;

        const $expandTable = $('.c-ui-table__wrapper .js-expandable');

        $expandTable.each(function initTable()
        {
            const $wrapper = $(this);
            const $expandControl = $wrapper
                .siblings('.c-ui-table__expand')
                .find('.js-expand-control');

            context.settings.hiddenRows = $wrapper
                .find('tbody > tr:gt(' + (callapsedAmountOfRows - 1) + ')');

            if (
                $expandControl.length &&
                !context.settings.hiddenRows.length
            ) {
                $expandControl.addClass('uk-hidden');
                $expandControl.parent().addClass('uk-hidden');
            }

            if (context.settings.hiddenRows.length) {
                context.settings.hiddenRows.addClass('uk-hidden');
            }

            $expandControl.on('click', function toggleExpanding()
            {
                const isOpen = $wrapper.hasClass('is-open');

                $wrapper[isOpen ? 'removeClass' : 'addClass']('is-open');
                $expandControl.text(isOpen ? 'مشاهده تمام لیست' : 'نمایش کمتر');

                if (context.settings.hiddenRows.length) {
                    context.settings.hiddenRows[isOpen ? 'addClass' : 'removeClass']('uk-hidden');
                }
            });
        });
    },

    initMostSellingProductsTable: function mostSellingTable()
    {
        const context = this;
        const callapsedAmountOfRows = context.settings.collapsedAmountOfRows;

        const $tableWrapper = $('.js-most-selling-products');
        const $periodSelect = $('.js-duration-most-selling-variants');
        const requestUrl = window.stats_ajax_url;
        const $expandWrapper = $tableWrapper.siblings('.c-ui-table__expand');
        const $expandControl = $expandWrapper.find('.js-expand-control');

        if ($tableWrapper.length) {
            $periodSelect.on('change', function () {
                const value = $(this).val();
                $('#js-most-selling-box').css('display', 'none');
                const $loader = $('#best-sales-loading');
                $loader.addClass('is-active');

                Services.ajaxPOSTRequestHTML(
                    requestUrl,
                    {
                        'stats[duration]': value,
                        'stats[type]': 'mostSellingItems'
                    },
                    function (data) {
                        $tableWrapper.html('').html(data);

                        if ($tableWrapper.find('table').length) {
                            $expandWrapper.removeClass('uk-hidden');
                        } else {
                            $expandWrapper.addClass('uk-hidden');
                        }

                        context.settings.hiddenRows = $tableWrapper.find('tbody')
                            .find('tr:gt(' + (callapsedAmountOfRows - 1) + ')');

                        if (!$tableWrapper.hasClass('is-open')) {
                            if (context.settings.hiddenRows.length) {
                                context.settings.hiddenRows.addClass('uk-hidden');
                                $expandControl.removeClass('uk-hidden');
                            } else if (!$expandControl.hasClass('uk-hidden')) {
                                $expandControl.addClass('uk-hidden');
                            }
                        }

                        $loader.removeClass('is-active');
                    },
                    false,
                    true
                );
            });
        }
    },

    initSelect: function () {
        const $inputs = $('.c-ui-select--common');

        $inputs.each(function () {
            const $input = $(this);
            const inputPlaceholder = $input.attr('placeholder');
            const hasSearch = $input.hasClass('c-ui-select--search');

            $input.select2({
                placeholder: inputPlaceholder,
                minimumResultsForSearch: hasSearch ? 0 : Infinity,
                language: {
                    noResults: function () {
                        return 'نتیجه‌ای پیدا نشد';
                    },
                    searching: function () {
                        return 'form.general.select.search.searching';
                    }
                }
            }).data('select2').$dropdown.addClass('c-ui-select__dropdown c-ui-select__dropdown--gap');
        })
    },

    initTrainingSignUp: function callTraining()
    {
        $('[data-target="training-sign-up"]').each(function () {
            $(this).on('click', function (e) {
                e.preventDefault();

                UIkit.modal('#training-sign-up').show();
            });
        });
    },

    initTrainingSelect: function () {
        const $trainingSignUp = $('#training-sign-up');
        if (!$trainingSignUp.length) {
            return;
        }

        const $form = $('#training-form');
        const $modalBody = $form.closest('.uk-modal-body');
        const $loadingProgress = $form.siblings('.c-loading');

        $form.validate({
            rules: {
                'register[training_day]': {
                    required: true
                },
                'register[training_hour]': {
                    required: true
                }
            },
            messages: {
                'register[training_day]': {
                    required: 'لطفا روز مورد نظر خود را انتخاب کنید.'
                },
                'register[training_hour]': {
                    required: 'لطفا ساعت مورد نظر خود را انتخاب کنید.'
                }
            }
        }).showBackendErrors();

        $('#btnSubmit').click(function (e) {
            e.preventDefault();
            $form.submit();
        });

        $(document).on('click', '#closeAndRefresh', function () {
            window.location.reload();
        });

        $form.on('submit', function (e) {
            e.preventDefault();

            if (!$form.valid()) {
                return false;
            }
            $loadingProgress.addClass('is-active');
            /** @var training_ajax_url */
            Services.ajaxPOSTRequestJSON(
                window.training_ajax_url,
                $form.serialize(),
                function () {
                    $modalBody.html('').append(
                        '<div class="c-modal-notification">' +
                            '<div class="c-modal-notification__content c-modal-notification__content--limited">' +
                                '<div class="c-modal-notification__bg-img c-modal-notification__bg-img--success"></div>' +
                                '<h2 class="c-modal-notification__header">فروشنده گرامی،</h2>' +
                                '<p class="c-modal-notification__text">ثبت‌نام شما در دوره آموزشی مرکز فروشندگان با موفقیت انجام شد.</p>' +
                                '<button class="c-modal-notification__btn" id="closeAndRefresh">تایید</button>' +
                            '</div>' +
                        '</div>'
                    );
                },
                function (data) {
                    $form.validate({
                        rules: {
                            'register[training_day]': {
                                required: true
                            },
                            'register[training_hour]': {
                                required: true
                            }
                        },
                        messages: {
                            'register[training_day]': {
                                required: 'لطفا روز مورد نظر خود را انتخاب کنید.'
                            },
                            'register[training_hour]': {
                                required: 'لطفا ساعت مورد نظر خود را انتخاب کنید.'
                            }
                        }
                    }).showErrors(data);
                },
                true
            ).always(function () {
                $loadingProgress.removeClass('is-active');
            });

            return false;
        });

        if ($trainingSignUp.length) {
            const context = this;
            const $inputs = $('.c-ui-select--training');
            const selectedType = $('[name="register[training_type]"]:checked').val();
            const $daysSelect = $('[name="register[training_day]"]');
            const $hoursSelect = $('[name="register[training_hour]"]');
            const chosenDay = $daysSelect.attr('data-id');

            $inputs.each(function () {
                const $input = $(this);
                const inputPlaceholder = $input.attr('placeholder');
                const hasSearch = $input.hasClass('c-ui-select--search');

                $input.select2({
                    placeholder: inputPlaceholder,
                    minimumResultsForSearch: hasSearch ? 0 : Infinity,
                    language: {
                        noResults: function () {
                            return 'نتیجه‌ای پیدا نشد';
                        },
                        searching: function () {
                            return 'form.general.select.search.searching';
                        }
                    }
                }).data('select2').$dropdown.addClass('c-ui-select__dropdown');
            });

            if (window.days) {
                context.loadSelector(selectedType, $daysSelect, chosenDay, window.days);

                $('[name="register[training_type]"]').on('change', function () {
                    $hoursSelect.html('');
                    context.loadSelector(this.value, $daysSelect, chosenDay, window.days);
                    $daysSelect.prop('disabled', false);
                });
            }

            if (chosenDay.length > 0 && $hoursSelect[selectedType] && $hoursSelect[selectedType][chosenDay]) {
                $.each($hoursSelect[selectedType][chosenDay], function (_, hour) {
                    if ($hoursSelect.attr('data-id') === hour.value) {
                        $hoursSelect.append('<option value="' + hour.value + '" selected>' + hour.label + '</option>')
                    } else {
                        $hoursSelect.append('<option value="' + hour.value + '">' + hour.label + '</option>')
                    }
                });
            }

            $daysSelect.on('change', function () {
                const selectedType2 = $('[name="register[training_type]"]:checked').val();

                $hoursSelect.html('');
                $hoursSelect.prop('disabled', false);
                if (window.hours) {
                    context.loadSelector(this.value, $hoursSelect, false, window.hours[selectedType2]);
                    $daysSelect.prop('disabled', false);
                }
            });
        }
    },

    initNationalIdVerification: function () {
        if(!$('.js-national-id-verification')) return;

        $('.js-national-id-verification').on('click', function () {
            UIkit.modal('#national-id-verification-error-modal').show();

            $('.js-verification-national-id').on('click', function () {
                UIkit.modal('#national-id-verification-error-modal').hide();
                UIkit.modal('#national-id-verification-modal').show();
                $('.js-close-verification').on('click', function () {
                    UIkit.modal('#national-id-verification-modal').hide();
                });
            });
        });
    },

    loadSelector: function (value, selector, defaultValue, values) {
        selector.html('');
        selector.append('<option></option>');
        if (values) {
            $.each(values[value], function (index, day) {
                if (day instanceof Object) {
                    if (defaultValue === day.value) {
                        selector.append('<option value="' + day.value + '" selected>' + day.label + '</option>')
                    } else {
                        selector.append('<option value="' + day.value + '">' + day.label + '</option>')
                    }
                } else {
                    if (defaultValue === index) {
                        selector.append('<option value="' + index + '" selected>' + day + '</option>')
                    } else {
                        selector.append('<option value="' + index + '">' + day + '</option>')
                    }
                }
            });
        }
    },
};


$(function () {
    DashboardAction.init()
});
