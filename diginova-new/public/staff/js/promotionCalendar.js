/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/controllers/joinPromotionController/promotionCalendar.js]*/
promotionCalendar = {
    monthsToSkip: 0,
    promotions: [],
    init: function () {
        // this.initTooltips();
        // this.initCalendarTabs();

        this.initVariables();
        this.initState();
        this.initAjaxHandlers();
        this.initCalendarPromos();
        this.drawPromotionLine();
    },

    initTooltips: function () {
        const $tooltipContainers = $('.js-tooltip');
        const $tooltipClickContainers = $('.js-tooltip-click');

        if ($tooltipContainers.length > 0) {
            $tooltipContainers.on('mouseenter', this.showTooltip);
        }
        if ($tooltipClickContainers.length > 0) {
            $tooltipClickContainers.on('click', this.showTooltip);
        }
    },
    showTooltip: function (e) {
        e.stopPropagation();
        const target = e.currentTarget;
        const tooltipText = $(target).data('tooltip');
        const createTooltip = function (id, text) {
            const tooltip = $('<div/>');

            if (id && text) {
                tooltip.addClass('c-ui-tooltip');
                tooltip.attr('id', id);
                tooltip.html(text);
            }

            return tooltip;
        };

        if (tooltipText) {
            const tooltipHalfMaxWidth = 235 / 2;
            const targetHalfWidth = target.offsetWidth / 2;
            const tooltipId = 'tooltip-block';
            const targetPosition = target.getBoundingClientRect();
            const tooltip = createTooltip(tooltipId, tooltipText);

            const removeTooltip = function () {
                tooltip.remove();
                target.removeEventListener('mouseleave', removeTooltip);
                window.removeEventListener('scroll', removeTooltip);
            };

            $('body').append(tooltip);

            if (targetPosition.left + tooltipHalfMaxWidth + targetHalfWidth >= document.body.clientWidth) {
                tooltip.addClass('c-ui-tooltip--left');
            } else if (targetPosition.left + targetHalfWidth - tooltipHalfMaxWidth <= 0) {
                tooltip.addClass('c-ui-tooltip--right');
            }

            if (targetPosition.top + targetPosition.height + tooltip.offsetHeight >= document.body.clientHeight) {
                tooltip.addClass('c-ui-tooltip--top');
                tooltip.css('top', targetPosition.top - tooltip.offsetHeight + 'px');
            } else {
                tooltip.css('top', targetPosition.top + targetPosition.height + 'px');
            }

            tooltip.css('left', targetPosition.left + target.offsetWidth / 2 + 'px');
            tooltip.css('opacity', 1);

            target.addEventListener('mouseleave', removeTooltip);
            window.addEventListener('scroll', removeTooltip);
        }
    },
    initCalendarTabs: function () {
        $(document).on('click', '.js-calendar-tab-btn', function () {
            let $tab = $(this);
            let $target = $tab.attr('href');
            let $calendar = $('#calendar');
            let $workCalendar = $('#workCalendar');
            let $filters = $('#calendarFilters');
            let $workFilters = $('#calendarFiltersWork');

            $('.js-calendar-tab-btn').removeClass('active');
            $tab.addClass('active');

            if ($target === 'calendar') {
                $workFilters.addClass('hidden');
                $workCalendar.addClass('hidden');
                $filters.removeClass('hidden');
                $calendar.removeClass('hidden');
            }

            if ($target === 'workCalendar') {
                $workFilters.removeClass('hidden');
                $workCalendar.removeClass('hidden');
                $filters.addClass('hidden');
                $calendar.addClass('hidden');
            }
            return false;
        });
    },

    initAjaxHandlers: function () {
        var self = this;
        $('body')
            .on('click', '.js-calendar-prev', function (e) {
                e.preventDefault();
                self.previousMonth();
            })
            .on('click', '.js-calendar-next', function (e) {
                e.preventDefault();
                self.nextMonth();
            });
    },
    initState: function () {
        this.createCalendarHtml();
    },
    getEncryptedSellerId: function () {
        var path = window.location.pathname;
        var pathParts = path.split('/');
        pathParts.pop();
        return pathParts.pop();
    },
    initVariables: function () {
        this.calendar = window.calendar;
        this.promotions = window.promotions;
    },
    getData: function () {
        var self = this;
        var sellerId = self.getEncryptedSellerId();
        var url = '/promotions/calendar/' + sellerId + '/ajax/' + self.monthsToSkip + '/';

        Framework.ajaxGETRequestJSON(
            url,
            {},
            function (response) {
                self.promotions = response.promotions;
                self.calendar = response.calendar;
                self.createCalendarHtml();
            },
            function (response) {
                console.log(response);
            }
        );
    },
    createCalendarHtml: function () {
        this.clearCalendarWeeks();
        this.clearPromotions();
        var calendarData = this.makeCalendarMonthData();
        this.setMonthName();
        var week = $('<li class="c-calendar__week"></li>');

        var remaining = 0;
        for (i = 0; i < calendarData.length; i++) {
            var dayHtml = $('<div class="c-calendar__day js-calendar-day"></div>');
            var day = calendarData[i];
            if (day.empty === false) {
                var dayData = $('<div class="c-calendar__day-wrapper" data-day-index="' + day.index + '">' + Services.convertToFaDigit(day.index) + '</div>');
                dayHtml.append(dayData);
            }
            week.append(dayHtml);
            remaining++;
            if (i % 7 == 6) {
                remaining = 0;
                $('.js-calendar').append(week);
                week = $('<li class="c-calendar__week"></li>');
            }
            if (remaining > 0) {
                $('.js-calendar').append(week);
            }
        }
        this.createPromotionsListHtml();

    },
    clearPromotions: function () {
        $('.js-promotions-list').html('');
    },
    getRandomColor: function () {
        var color = '#' + Math.floor(Math.random() * 16777214).toString(16);
        if (color.length !== 7) {
            return color += '0';
        }
        return color;
    },
    createPromotionsListHtml: function () {
        var self = this;
        var promotionIds = Object.keys(self.promotions);

        for (var i = 0; i < promotionIds.length; i++) {
            var color = self.getRandomColor();

            var promotion = self.promotions[promotionIds[i]];
            var promotionHtml = $('<li class="c-calendar-filters__item"></li>');
            if (promotion.joinable_by_seller) {
                promotionHtml.append('<div class="c-calendar-filters__wrapper">\n' +
                    '         <span class="c-calendar-filters__filter-color"\n' +
                    '         style="background-color: ' + color + '"></span>\n' +
                    '         <a href="' + promotion.link + '"\n' +
                    '         class="c-calendar-filters__link"\n' +
                    '         target="_blank"\n' +
                    '         data-filter-promo-name="' + promotion.id + '">\n' +
                    '         <span class="c-calendar-filters__category">' + Services.convertToFaDigit(promotion.title) + '</span> \n' +
                    '         <span class="c-calendar-filters__date">' + Services.convertToFaDigit(promotion.date_interval) + '</span> \n' +
                    '         </a>\n' +
                    '         </div>');
            }
            else {
                promotionHtml.append('<div class="c-calendar-filters__wrapper">\n' +
                    '         <span class="c-calendar-filters__filter-color"\n' +
                    '         style="background-color: ' + color + '"></span>\n' +
                    '         <a \n' +
                    '         class="c-calendar-filters__link"\n' +
                    '         target="_blank"\n' +
                    '         data-filter-promo-name="' + promotion.id + '">\n' +
                    '         <span class="c-calendar-filters__category">' + Services.convertToFaDigit(promotion.title) + '</span> \n' +
                    '         <span class="c-calendar-filters__date">' + Services.convertToFaDigit(promotion.date_interval) + '</span> \n' +
                    '         </a>\n' +
                    '         </div>');
                promotionHtml.append('<div class="c-rating-chart__description-tooltip c-mega-campaigns-join-list__container-table-btn-tooltip ' +
                    'uk-dropdown uk-dropdown-stack uk-dropdown-bottom-center" ' +
                    'uk-dropdown="boundary: .js-dropdown-desc; pos: bottom-center" ' +
                    'style="left: 48px; top: 116px;">' +
                    promotion.not_joinable_tooltip +
                    '</div>');
            }

            self.addPromotionPoint(promotion, color);
            $('.js-promotions-list').append(promotionHtml);
        }
    },
    addPromotionPoint: function (promotionData, color) {
        if (promotionData.start_date.year == this.calendar.year && promotionData.start_date.month == this.calendar.month_index) {
            // start point
            var startDayWrapper = $('[data-day-index="' + promotionData.start_date.day + '"]');
            var startPoint = $('<span class="c-calendar__promo-point js-calendar-promo"\n' +
                '                                              style="background-color: ' + color + '"' +
                '                                              data-promo-name="' + promotionData.id + '"' +
                '                                              data-promo-direction="start"></span>');
            var promotionPoints = startDayWrapper.find('.c-calendar__promo-cluster');
            if (promotionPoints.length === 0) {
                promotionPoints = $('<div class="c-calendar__promo-cluster"></div>');
                promotionPoints.append(startPoint);
                startDayWrapper.append(promotionPoints);
            } else {
                promotionPoints.append(startPoint);
            }
        }
        if (promotionData.end_date.year == this.calendar.year && promotionData.end_date.month == this.calendar.month_index) {
            //end point
            var endDayWrapper = $('[data-day-index="' + promotionData.end_date.day + '"]');
            var endPoint = $('<span class="c-calendar__promo-point js-calendar-promo"' +
                '                                              style="background-color: ' + color + '"' +
                '                                              data-promo-name="' + promotionData.id + '"' +
                '                                              data-promo-direction="end"></span>');

            var promotionPoints = endDayWrapper.find('.c-calendar__promo-cluster');
            if (promotionPoints.length === 0) {
                promotionPoints = $('<div class="c-calendar__promo-cluster"></div>');
                promotionPoints.append(endPoint);
                endDayWrapper.append(promotionPoints);
            } else {
                promotionPoints.append(endPoint)
            }
        }
    },
    clearCalendarWeeks: function () {
        $('.c-calendar__week').not('c-calendar__week-header').remove();
    },
    setMonthName: function () {
        var name = Services.convertToFaDigit(this.calendar.month) + ' ' + Services.convertToFaDigit(this.calendar.year);
        $('.js-calendar-month').html(name);
        $('.js-calendar-year').html(Services.convertToFaDigit(this.calendar.current_date));
    },
    makeCalendarMonthData: function () {
        var self = this;
        var monthDays = [];
        var emptyDaysInStart = self.calendar.start_weekday;
        var emptyDaysInEnd = 7 - ((self.calendar.start_weekday + self.calendar.days) % 7);
        emptyDaysInEnd %= 7;
        for (i = 0; i < emptyDaysInStart; i++) {
            monthDays.push({empty: true});
        }
        for (i = 1; i <= this.calendar.days; i++) {
            monthDays.push({empty: false, index: i});
        }
        for (i = 0; i < emptyDaysInEnd; i++) {
            monthDays.push({empty: true});
        }
        return monthDays;
    },
    nextMonth: function () {
        this.monthsToSkip++;
        this.getData();
    },
    previousMonth: function () {
        this.monthsToSkip--;
        this.getData();
    },
    initCalendarPromos: function () {
        var context = this,
            promoName,
            promoDirection,
            promoRowPosition,
            promoCellPosition;
            // calendarTab;

        /* clear draw data */
        var calendarReset = function () {
            $('.js-promo-line').remove();
            $('.js-calendar-promo').removeClass('c-calendar__promo-point--focus');
            $('.js-calendar-filters a').removeClass('c-calendar-filters__link--focus');
        };

        $('.js-calendar').on('click', function () {
            calendarReset();
        });

        $('body').on('click', '.js-calendar-promo', function (e) {
            e.stopPropagation();

            /* Reset Calendar before logic is executed */
            calendarReset();


            // if (isModuleActive('work_calendar')) {
            //     calendarTab = $(this).closest('.js-calendar');
            // }

            /* Get promotion name and direction */
            promoName = $(this).data('promo-name');
            promoDirection = $(this).data('promo-direction');

            /* Re-style first and last promotion point and filter */
            $('[data-promo-name="' + promoName + '"').addClass('c-calendar__promo-point--focus');
            $('[data-filter-promo-name="' + promoName + '"').addClass('c-calendar-filters__link--focus');
            console.log("here", $('[data-filter-promo-name="' + promoName + '"'), '[data-filter-promo-name="' + promoName + '"');

            /* Get Promotion week and day position in the calendar */
            promoCellPosition = $(this).closest('li').children('div').index($(this).closest('.js-calendar-day'));
            promoRowPosition = $(this).closest('ul').children('li').index($(this).closest('li'));

            context.drawPromotionLine(promoName, promoDirection, promoRowPosition, promoCellPosition);

            // if (isModuleActive('work_calendar')) {
            //     context.drawPromotionLine(promoName, promoDirection, promoRowPosition, promoCellPosition, calendarTab);
            // } else {
            //     context.drawPromotionLine(promoName, promoDirection, promoRowPosition, promoCellPosition);
            // }
        });
    },
    drawPromotionLine: function (promoName, promoDirection, promoRow, promoCell, calendarTab) {
        var promoTarget,
            promoTargetRow,
            promoTargetCell;

        if (promoDirection == 'start') {
            promoTarget = $('[data-promo-name="' + promoName + '"')[1];

            /* Get position of promotion End point */
            promoTargetCell = $(promoTarget).closest('li').children('div').index($(promoTarget).closest('.js-calendar-day'));
            promoTargetRow = $(promoTarget).closest('ul').children('li').index($(promoTarget).closest('li'));

            if (promoRow === promoTargetRow) { /* If promo is within same week */
                for (var j = promoCell + 1; j < promoTargetCell; j++) {
                    $('.js-calendar li:nth-of-type(' + (promoRow + 1) + ')')
                        .children('div:nth-of-type(' + (j + 1) + ')')
                        .append('<span class="js-promo-line c-calendar__promo-line"></span>');
                }
            } else {
                for (var i = promoRow; i <= promoTargetRow; i++) {
                    if (i === promoTargetRow) {  /* Iterates last row. */
                        for (var j = 0; j < promoTargetCell; j++) {
                            $('.js-calendar li:nth-of-type(' + (i + 1) + ')')
                                .children('div:nth-of-type(' + (j + 1) + ')')
                                .append('<span class="js-promo-line c-calendar__promo-line"></span>');
                        }
                    } else if (i === promoRow) {  /* Iterates first row. */
                        for (var j = promoCell + 1; j <= 6; j++) {
                            $('.js-calendar li:nth-of-type(' + (i + 1) + ')')
                                .children('div:nth-of-type(' + (j + 1) + ')')
                                .append('<span class="js-promo-line c-calendar__promo-line"></span>');
                        }
                    } else {  /* Iterates rows in between. */
                        for (var j = 0; j <= 6; j++) {
                            $('.js-calendar li:nth-of-type(' + (i + 1) + ')')
                                .children('div:nth-of-type(' + (j + 1) + ')')
                                .append('<span class="js-promo-line c-calendar__promo-line"></span>');
                        }
                    }
                }
            }
            $('.js-promo-line').css('background-color', $(promoTarget).css('background-color'));
            $(promoTarget).addClass('c-calendar__promo-point--hover');
        } else {
            promoTarget = $('[data-promo-name="' + promoName + '"')[0];

            /* Get position of promotion End point */
            promoTargetCell = $(promoTarget).closest('li').children('div').index($(promoTarget).closest('.js-calendar-day'));
            promoTargetRow = $(promoTarget).closest('ul').children('li').index($(promoTarget).closest('li'));

            if (promoRow === promoTargetRow) { /* If promo is within same week */
                for (var j = promoCell; j > promoTargetCell + 1; j--) {
                    $('.js-calendar li:nth-of-type(' + (promoRow + 1) + ')')
                        .children('div:nth-of-type(' + (j) + ')')
                        .append('<span class="js-promo-line c-calendar__promo-line"></span>');
                }
            } else {
                for (var i = promoRow; i >= promoTargetRow; i--) {
                    console.log('weeks loop');
                    if (i === promoTargetRow) {  /* Iterates last row. */
                        for (var j = 6; j > promoTargetCell; j--) {
                            $('.js-calendar li:nth-of-type(' + (i + 1) + ')')
                                .children('div:nth-of-type(' + (j + 1) + ')')
                                .append('<span class="js-promo-line c-calendar__promo-line"></span>');
                        }
                    } else if (i === promoRow) {  /* Iterates first row. */
                        for (var j = promoCell; j >= 0; j--) {
                            $('.js-calendar li:nth-of-type(' + (i + 1) + ')')
                                .children('div:nth-of-type(' + (j) + ')')
                                .append('<span class="js-promo-line c-calendar__promo-line"></span>');
                        }
                    } else {  /* Iterates rows in between. */
                        for (var j = 6; j >= 0; j--) {
                            $('.js-calendar li:nth-of-type(' + (i + 1) + ')')
                                .children('div:nth-of-type(' + (j + 1) + ')')
                                .append('<span class="js-promo-line c-calendar__promo-line"></span>');
                        }
                    }
                }
            }

            $('.js-promo-line').css('background-color', $(promoTarget).css('background-color'));
            $(promoTarget).addClass('c-calendar__promo-point--hover');
        }
    }
};


$(function () {
    promotionCalendar.init();
});