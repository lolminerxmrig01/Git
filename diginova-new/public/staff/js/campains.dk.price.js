/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/dk.price.js]*/
var dk = dk || {};

(function (dk, w, $) {
    'use strict';

    w.DISPLAY_MODES = {
        container: 'container',
        modal: 'modal',
        popover: 'popover'
    };

    $.fn.dkprice = function (options) {
        var superSelf = this,
            attachContext = null,
            productConfigId = null,
            _wrapper = null,
            _container = null,
            attachType = 'body';

        var uniqueId = (function () {
            function s4() {
                return Math.floor((1 + Math.random()) * 0x10000)
                    .toString(16)
                    .substring(1);
            }

            return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
                s4() + '-' + s4() + s4() + s4();
        })();

        options = $.extend({
            url: '',
            shadowElement: superSelf,
            displayMode: DISPLAY_MODES.popover
        }, options);

        var eventHook = function () {
            var events = {};
            return {
                hookEvent: function (evName, callback) {
                    if (!events[evName]) events[evName] = [];
                    events[evName].push(callback);
                },
                invoke: function (evName, args) {
                    var method = events[evName];
                    if (!method) return;
                    for (var i = 0; i < method.length; i++) {
                        events[evName][i].call(this, args);
                    }
                }
            };
        }();

        var getWrapper = function () {
            if (_wrapper && _wrapper.length > 0) return _wrapper;

            _wrapper = $('[dk-for="' + uniqueId + '"]');
            return _wrapper;
        };

        var getContainer = function () {
            if (_container && _container.length > 0) return _container;

            _container = $('.dk-price-container', '[dk-for="' + uniqueId + '"]');
            return _container;
        };

        //----- Popover to body
        var contextIsBody = function () {
            if (!attachContext) return true;
            return attachContext.length == 0 || attachContext.get(0).tagName.toUpperCase() == 'BODY';
        };
        var tid = null;
        var popoverOffset = function () {

            //console.log($(options.shadowElement), options.shadowElement, $(options.shadowElement).parent().parent().offset(), options.shadowElement.offset());
            if (options.shadowElement) {
                return $(options.shadowElement).offset();
            }
            return $(superSelf).offset();
        };

        var positionRefresh = function () {

            if (tid) {
                clearTimeout(tid);
                tid = null;
            }

            var offset = popoverOffset();

            //tid = setTimeout(function () {

            if (options.shadowElement) {
                $(".dk-price-wrapper").css({
                    "top": (offset.top + $(options.shadowElement).outerHeight()) + "px",
                    "left": offset.left + "px"
                });
            }else {
                $(".dk-price-wrapper").css({
                    "top": (offset.top + $(superSelf).outerHeight()) + "px",
                    "left": offset.left + "px"
                });
            }


            //popoverWrapperPattern.css({ "top": offset.top + $(superSelf).height() + 8 + "px", "left": offset.left + "px" });
            //}, 350);
        };

        //----- priceTranslate

        var priceTranslate = function (wrapper) {

            var priceTranslateWrapper = $('<div class="dk-price-translate-wrapper"></div>');
            var priceTranslateDigits = $('<div class="dk-price-translate-digits"><span class="digits-label">قیمت شما:</span><span class="digits-value"></span></div>');
            var priceTranslatePersian = $('<div class="dk-price-translate-persian"></div>');

            priceTranslateWrapper.append(priceTranslateDigits);
            priceTranslateWrapper.append(priceTranslatePersian);

            wrapper.append(priceTranslateWrapper);


            eventHook.hookEvent('valueChange', function (input) {
                //---- Price Translate


                var inputlength = input.length;
                if (inputlength <= 15) {
                    $('.dk-price-translate-digits > .digits-value').html(dk.core.basics.toPersianCurrency(input));

                } else {
                    $('.dk-price-translate-digits > .digits-value').html("خارج از محدوده!").css("font-size", "16px");
                }

                $('.dk-price-translate-persian').html(dk.core.basics.money.translateToString(input));


            });


            return wrapper;


        };

        //----- priceChart

        var priceChart = function (wrapper, data) {

            var priceChartWrapper = $('<div class="dk-price-chart-wrapper"></div>');

            var chartLine = $('<div class="dk-price-chart-line"></div>');
            var chartrange = $('<div class="dk-price-chart-ranges"></div>');

            var chartMinPoint = $('<div class="dk-price-chart-min-point"></div>');
            var chartMaxPoint = $('<div class="dk-price-chart-max-point"></div>');


            var chartMinDk = $('<div class="dk-price-chart-dk-point minDk"></div>');
            var chartMaxDk = $('<div class="dk-price-chart-dk-point maxDk"></div>');
            var chartMinOther = $('<div class="dk-price-chart-other-point minOther"></div>');
            var chartMaxOther = $('<div class="dk-price-chart-other-point maxOther"></div>');

            var chartMaxrange = $('<div class="dk-price-chart-range max-range"></div>');
            var chartMediumrange = $('<div class="dk-price-chart-range medium-range"></div>');
            var chartMinrange = $('<div class="dk-price-chart-range min-range"></div>');
            var chartGreyrange = $('<div class="dk-price-chart-range grey-range"></div>');

            var pointer = $('<div class="dk-price-chart-pointer"></div>');
            var pointerTooltip = $('<div class="dk-price-chart-pointer-tooltip">قیمت شما</div>');
            pointer.append(pointerTooltip);

            var minDk = data.minDk.price;
            var maxDk = data.maxDk.price;
            var minOther = data.minOther.price;
            var maxOther = data.maxOther.price;

            var minDkTitle = data.minDk.title;
            var maxDkTitle = data.maxDk.title;
            var minOtherTitle = data.minOther.title;
            var maxOtherTitle = data.maxOther.title;


            var points;
            if (minOther == null && maxOther == null) {
                points = {
                    "minDk": minDk,
                    "maxDk": maxDk
                };

            } else if (minDk == null && maxDk == null) {
                points = {
                    "minOther": minOther,
                    "maxOther": maxOther
                }
            }
            else {
                points = {
                    "minDk": minDk,
                    "maxDk": maxDk,
                    "minOther": minOther,
                    "maxOther": maxOther
                };
            }


            var pointsArray = $.map(points, function (v, k) {
                var obj = {};
                obj.val = v;
                obj.key = k;
                return obj
            });
            var maxPrice = pointsArray.sort(
                function (a, b) {
                    return b.val - a.val
                }
            )[0].val;
            var minPrice = pointsArray.sort(
                function (a, b) {
                    return a.val - b.val
                }
            )[0].val;

            var minmin = pointsArray.sort(
                function (a, b) {
                    return a.val - b.val
                }
            )[0].key;

            var minPercent = 0;
            var maxPercent = 100;

            var maxRange = data.maxRange;
            var mediumRange = data.mediumRange;

            var scope = maxPrice - minPrice;

            var green = (100 * (data.maxRange - minPrice)) / scope;
            var yellow = (100 * (data.mediumRange - data.maxRange)) / scope;
            var red = 100 - (green + yellow);
            var redStart = (green + yellow);


            var minDkPercent = (100 * (minDk - minPrice)) / scope;
            var maxDkPercent = (100 * (maxDk - minPrice)) / scope;
            var minOtherPercent = (100 * (minOther - minPrice)) / scope;
            var maxOtherPercent = (100 * (maxOther - minPrice)) / scope;

            priceChartWrapper.append(chartLine);


            priceChartWrapper.append(chartrange);

            var pointsTooltip_minDk = $('<div class="dk-price-chart-points-tooltip"> <div class="price"><div>پایین ترین قیمت دیجی‌کالا</div><div>' + dk.core.basics.toPersianCurrency(minDk) + '</div></div> <div class="title"> ' + minDkTitle + '</div>    </div>');
            var pointsTooltip_maxDk = $('<div class="dk-price-chart-points-tooltip"> <div class="price"><div>بالاترین قیمت دیجی‌کالا</div><div>' + dk.core.basics.toPersianCurrency(maxDk) + '</div></div> <div class="title"> ' + maxDkTitle + '</div>    </div>');
            var pointsTooltip_minOther = $('<div class="dk-price-chart-points-tooltip"> <div class="price"><div>پایین ترین قیمت بازار</div><div>' + dk.core.basics.toPersianCurrency(minOther) + '</div></div>  <div class="title"> ' + minOtherTitle + '</div> </div>');//
            var pointsTooltip_maxOther = $('<div class="dk-price-chart-points-tooltip"> <div class="price"><div>بالاترین قیمت بازار</div><div>' + dk.core.basics.toPersianCurrency(maxOther) + '</div></div> <div class="title"> ' + maxOtherTitle + '</div>   </div>');//


            if (minOther == null && maxOther == null) {
                chartMinDk.append(pointsTooltip_minDk);
                chartMaxDk.append(pointsTooltip_maxDk);

                chartrange.append(chartMinDk);
                chartrange.append(chartMaxDk);
            } else if (minDk == null && maxDk == null) {
                chartMinOther.append(pointsTooltip_minOther);
                chartMaxOther.append(pointsTooltip_maxOther);

                chartrange.append(chartMinOther);
                chartrange.append(chartMaxOther);
            }

            else {

                chartMinDk.append(pointsTooltip_minDk);
                chartMaxDk.append(pointsTooltip_maxDk);
                chartMinOther.append(pointsTooltip_minOther);
                chartMaxOther.append(pointsTooltip_maxOther);

                chartrange.append(chartMinDk);
                chartrange.append(chartMaxDk);
                chartrange.append(chartMinOther);
                chartrange.append(chartMaxOther);
            }


            $(chartMinDk, chartrange).css("left", minDkPercent + "%");
            $(chartMaxDk, chartrange).css("left", maxDkPercent + "%");

            if (!(minOther == null || minOther == 0 || maxOther == null || maxOther == 0)) {

                if (!(minOther == maxOther)) {

                    $(chartMinOther, chartrange).css("left", minOtherPercent + "%");
                    $(chartMaxOther, chartrange).css("left", maxOtherPercent + "%");

                } else {
                    $(chartMaxOther, chartrange).css("display", "none");
                }

            }


            $("." + minmin, chartrange).css("left", -14 + "px ");

            chartrange.append(pointer);
            if (!data.maxRange && !data.mediumRange) {
                chartrange.append(chartGreyrange);
            }
            else {
                chartrange.append(chartMaxrange);
                chartrange.append(chartMediumrange);
                chartrange.append(chartMinrange);
                $(".max-range", chartrange).css("width", green + "%");
                $(".medium-range", chartrange).css("width", yellow + "%");
                $(".min-range", chartrange).css("width", red + "%");


            }


            chartMinDk.mouseenter(function () {
                pointsTooltip_minDk.show();

            }).mouseleave(function () {
                pointsTooltip_minDk.hide();
            });

            chartMaxDk.mouseenter(function () {
                pointsTooltip_maxDk.show();

            }).mouseleave(function () {
                pointsTooltip_maxDk.hide();
            });


            chartMinOther.mouseenter(function () {
                pointsTooltip_minOther.show();

            }).mouseleave(function () {
                pointsTooltip_minOther.hide();
            });


            chartMaxOther.mouseenter(function () {
                pointsTooltip_maxOther.show();

            }).mouseleave(function () {
                pointsTooltip_maxOther.hide();
            });


            //pointer

            wrapper = $(wrapper);
            wrapper.append(priceChartWrapper);


            eventHook.hookEvent('valueChange', function (input) {
                $(wrapper).removeClass('dk-price-green');
                $(wrapper).removeClass('dk-price-yellow');
                $(wrapper).removeClass('dk-price-red');
                $(wrapper).removeClass('dk-price-grey');

                if (input > maxPrice) {
                    pointer = 100;
                    $('.dk-price-chart-pointer').css("width", "100%");
                    $('.dk-price-chart-pointer').removeClass("under-min");
                    $('.dk-price-chart-pointer').addClass("upper-max");

                    $(wrapper).removeClass("under-min");
                    $(wrapper).addClass("upper-max");

                } else if (input < minPrice) {
                    pointer = 0;
                    $('.dk-price-chart-pointer').css("width", "0%");
                    $('.dk-price-chart-pointer').removeClass("upper-max");
                    $('.dk-price-chart-pointer').addClass("under-min");

                    $(wrapper).removeClass("upper-max");
                    $(wrapper).addClass("under-min");

                } else if (minPrice < input < maxPrice) {
                    $('.dk-price-chart-pointer').removeClass("upper-max");
                    $('.dk-price-chart-pointer').removeClass("under-min");

                    $(wrapper).removeClass("upper-max");
                    $(wrapper).removeClass("under-min");

                    var pointer = (100 * (input - minPrice)) / (scope);
                }

                $('.dk-price-chart-pointer').css("width", pointer + "%");

                var color = 'grey';
                var satisfactionWord = null;


                if (pointer <= green) {
                    color = 'green';
                } else if (green < pointer && pointer <= redStart) {
                    color = 'yellow';
                } else if (redStart < pointer && pointer <= 100) {
                    color = 'red';
                }


                if (!data.maxRange && !data.mediumRange) color = 'grey';

                $(wrapper).addClass('dk-price-' + color);
            });


            return wrapper;
        };
        //----- priceNotes

        var priceNotes = function (wrapper, data) {

            var priceNotesWrapper = $('<div class="dk-price-notes-wrapper"></div>');
            var priceNoteslist = $('<ul class="dk-price-notes-list"></ul>');
            priceNotesWrapper.append(priceNoteslist);
            //if ((data.priceChart == null || (data.priceChart.minDk.price == data.priceChart.maxDk.price))) {
            var priceNotes_Satisfaction_projectionPercent = $('<li>میزان رضایت مشتریان از این قیمت<span id="price-satisfaction">0</span>٪خواهد بود و می‌توانید<span id="sales-projection-percent">0</span>٪افراد متمایل به خرید را جذب نمایید.</li>');
            var priceNotes_Satisfaction = $('<li>میزان رضایت مشتریان از این قیمت<span id="price-satisfaction">0</span>٪خواهد بود .</li>');
            var priceNotes_ProjectionPercent = $('<li>می‌توانید<span id="sales-projection-percent">0</span>٪افراد متمایل به خرید را جذب نمایید.</li>');


            //var priceSatisfaction = null;
            //var priceSatisfactionList = data.priceNotes.priceSatisfaction;
            //var priceSatisfactionListArray = $.map(priceSatisfactionList, function (v, k) {
            //    var obj = {};
            //    obj.val = v;
            //    obj.key = k;
            //    return obj
            //});

            //var salesProjectionPercent = null;
            //var salesProjectionPercentList = data.priceNotes.salesProjectionPercent;
            //var salesProjectionPercentListArray = $.map(salesProjectionPercentList, function (v, k) {
            //    var obj = {};
            //    obj.val = v;
            //    obj.key = k;
            //    return obj
            //});

            if (data.priceNotes.priceSatisfaction && data.priceNotes.salesProjectionPercent) {
                var priceSatisfaction = null;
                var priceSatisfactionList = data.priceNotes.priceSatisfaction;
                var priceSatisfactionListArray = $.map(priceSatisfactionList, function (v, k) {
                    var obj = {};
                    obj.val = v;
                    obj.key = k;
                    return obj
                });

                var salesProjectionPercent = null;
                var salesProjectionPercentList = data.priceNotes.salesProjectionPercent;
                var salesProjectionPercentListArray = $.map(salesProjectionPercentList, function (v, k) {
                    var obj = {};
                    obj.val = v;
                    obj.key = k;
                    return obj
                });

                priceNoteslist.append(priceNotes_Satisfaction_projectionPercent);


                var salesProjectionPercent = null;
                var salesProjectionPercentList = data.priceNotes.salesProjectionPercent;
                var salesProjectionPercentListArray = $.map(salesProjectionPercentList, function (v, k) {
                    var obj = {};
                    obj.val = v;
                    obj.key = k;
                    return obj
                });
                eventHook.hookEvent('valueChange', function (input) {

                    var closestPS = priceSatisfactionListArray.sort(
                        (a, b) => Math.abs(input - a.key) - Math.abs(input - b.key)
                    )[0].val;

                    var closestSPP = salesProjectionPercentListArray.sort(
                        (a, b) => Math.abs(input - a.key) - Math.abs(input - b.key)
                    )[0].val;


                    $("#price-satisfaction").html(dk.core.basics.toPersianDigits(closestPS));
                    $("#sales-projection-percent").html(dk.core.basics.toPersianDigits(closestSPP));
                });


            } else if (data.priceNotes.priceSatisfaction && data.priceNotes.salesProjectionPercent == null) {
                var priceSatisfaction = null;
                var priceSatisfactionList = data.priceNotes.priceSatisfaction;
                var priceSatisfactionListArray = $.map(priceSatisfactionList, function (v, k) {
                    var obj = {};
                    obj.val = v;
                    obj.key = k;
                    return obj
                });


                priceNoteslist.append(priceNotes_Satisfaction);


                eventHook.hookEvent('valueChange', function (input) {

                    var closestPS = priceSatisfactionListArray.sort(
                        (a, b) => Math.abs(input - a.key) - Math.abs(input - b.key)
                    )[0].val;


                    $("#price-satisfaction").html(dk.core.basics.toPersianDigits(closestPS));
                });


            } else if (data.priceNotes.priceSatisfaction == null && data.priceNotes.salesProjectionPercent) {
                priceNoteslist.append(priceNotes_ProjectionPercent);
                eventHook.hookEvent('valueChange', function (input) {

                    var closestSPP = salesProjectionPercentListArray.sort(
                        (a, b) => Math.abs(input - a.key) - Math.abs(input - b.key)
                    )[0].val;


                    $("#sales-projection-percent").html(dk.core.basics.toPersianDigits(closestSPP));
                });

            }
            //}
            //else {
            if (data.priceChart.mediumRange && data.priceChart.maxRange) {

                var priceNotesSatisfactionWord = $('<li>میزان رضایت مشتریان شما از این قیمت:<span id="satisfaction-word"></span></li>');
                priceNoteslist.append(priceNotesSatisfactionWord);
            }
            //}
            if (data.priceNotes.buyBox) {
                var buyBox = data.priceNotes.buyBox;
                var priceNotesBuyBox = $('<li>قیمت برنده کمتر از<span class="green">' + dk.core.basics.toPersianCurrency(buyBox) + '</span></li>');

                priceNoteslist.append(priceNotesBuyBox);
            }
            //bopeshahp:start

            var showInappropriatePriceSection = true;
            var n_marginPercent = data.priceNotes.marginPercent;
            var n_minDk = data.priceChart.minDk.price;
            var n_maxDk = data.priceChart.maxDk.price;
            var n_minOther = data.priceChart.minOther.price;
            var n_maxOther = data.priceChart.maxOther.price;

            var n_points;

            if (n_minOther == null && n_maxOther == null && n_minDk == null && n_maxDk == null) {
                n_points = null;
            } else if (n_minOther == null && n_maxOther == null) {
                n_points = {
                    "minDk": n_minDk,
                    "maxDk": n_maxDk
                };
            } else if (n_minDk == null && n_maxDk == null) {
                n_points = {
                    "minOther": n_minOther,
                    "maxOther": n_maxOther
                };
            } else {
                n_points = {
                    "minDk": n_minDk,
                    "maxDk": n_maxDk,
                    "minOther": n_minOther,
                    "maxOther": n_maxOther
                };
            }
            if (data.priceNotes.currentPrice) {
                var n_currentPrice = data.priceNotes.currentPrice;

                n_points["currentP"] = n_currentPrice;
            } else {

                if (!n_points) {
                    showInappropriatePriceSection = false;
                }
            }

            if (showInappropriatePriceSection) {

                var n_pointsArray = $.map(n_points, function (v, k) {
                    var obj = {};
                    obj.val = v;
                    obj.key = k;
                    return obj;
                });
                var n_maxPrice = n_pointsArray.sort(
                    function (a, b) {
                        return b.val - a.val
                    }
                )[0].val;
                var n_minPrice = n_pointsArray.sort(
                    function (a, b) {
                        return a.val - b.val
                    }
                )[0].val;

                var minAccessable = n_minPrice - ((n_minPrice * n_marginPercent) / 100);
                var maxAccessable = n_maxPrice + ((n_maxPrice * n_marginPercent) / 100);


                var n_incorrectPrice = $('<li class="incorrect-price">به نظر قیمت نادرستی را انتخاب نموده اید.</li>');
                priceNoteslist.append(n_incorrectPrice);

                //--keyup priceNotes

                $(superSelf).unbind('keyup.priceNotess').bind("keyup.priceNotess", function () {
                    var input = ($(superSelf).val()).replace(/\,/g, '');
                    if (input < minAccessable || input > maxAccessable) {
                        n_incorrectPrice.css("display", "block");

                    } else {
                        n_incorrectPrice.css("display", "none");
                    }

                });


            }

            //bopeshahp:end


            if (data.priceNotes.salesProjectionList) {
                var salesProjection = null;
                var salesProjectionList = data.priceNotes.salesProjectionList;
                var salesProjectionListArray = $.map(salesProjectionList, function (v, k) {
                    var obj = {};
                    obj.val = v;
                    obj.key = k;
                    return obj
                });
                var minSalesProjection = salesProjectionListArray.sort(
                    function (a, b) {
                        return b.key - a.key
                    }
                )[0].val;
                var maxSalesProjection = salesProjectionListArray.sort(
                    function (a, b) {
                        return a.key - b.key
                    }
                )[0].val;
                var priceNotesSalesProjection = $('<li>احتمال فروش <span id="sales-projection">' + dk.core.basics.toPersianDigits(maxSalesProjection) + ' </span> عدد در روز به طور متوسط</li>');
                priceNoteslist.append(priceNotesSalesProjection);

                //--keyup priceNotes

                $(superSelf).unbind('keyup.priceNotes').bind("keyup.priceNotes", function () {
                    var input = ($(superSelf).val()).replace(/\,/g, '');

                    var closest = salesProjectionListArray.sort(
                        (a, b) => Math.abs(input - a.key) - Math.abs(input - b.key)
                    )[0];

                    var salesProjection = closest.val;
                    $("#sales-projection").html(dk.core.basics.toPersianDigits(salesProjection));


                    var satisfactionWord = null;
                    var satisfactionWordColor;
                    var satisfactionWordwrapper = $(wrapper);

                    if (satisfactionWordwrapper.hasClass("dk-price-green")) {
                        satisfactionWord = 'حداکثر';
                        satisfactionWordColor = 'green';

                    } else if (satisfactionWordwrapper.hasClass("dk-price-yellow")) {
                        satisfactionWord = 'متوسط';
                        satisfactionWordColor = 'yellow';

                    } else if (satisfactionWordwrapper.hasClass("dk-price-red")) {
                        satisfactionWord = 'حداقل';
                        satisfactionWordColor = 'red';
                    }

                    $("#satisfaction-word").removeClass('green');
                    $("#satisfaction-word").removeClass('yellow');
                    $("#satisfaction-word").removeClass('red');
                    $("#satisfaction-word").html(satisfactionWord).addClass(satisfactionWordColor);

                    if (wrapper.hasClass("upper-max") || wrapper.hasClass("under-min")) {
                        $(".incorrect-price").css("display", "block");
                    } else {
                        $(".incorrect-price").css("display", "none");
                    }


                    if (input < data.priceChart.minDk.price) {
                        $(".you-win").css("display", "block");
                    } else {
                        $(".you-win").css("display", "none");
                    }


                });

            }

            var incorrectPrice = $('<li class="incorrect-price">به نظر قیمت نادرستی را انتخاب نموده اید.</li>');

            var youWin = $('<li class="you-win">قیمت برنده در اختیار شما قرار گرفت. </li>');

            priceNoteslist.append(incorrectPrice);
            priceNoteslist.append(youWin);


            if (data.priceNotes.proposedPrice) {
                var proposedPrice = data.priceNotes.proposedPrice;
                var priceNotesProposedPrice = $('<li><div>قیمت پیشنهادی: </div><div class="proposed-price">' + dk.core.basics.toPersianCurrency(proposedPrice) + '</div></li>');

                priceNoteslist.append(priceNotesProposedPrice);
            }


            wrapper = $(wrapper);
            wrapper.append(priceNotesWrapper);
            return wrapper;
        };


        var initWrapper = function (callback) {

            var self = this;

            var containerPattern = $('<div class="dk-price-container"></div>');
            var headerPattern = $('<div class="dk-price-header"><div class="dk-price-title">وضعیت قیمت شما</div><button class="dk-price-header-close">&#215;</button></div>');
            var footerPattern = $('<div class="dk-price-footer"></div>');
            var WrapperPattern = $('<div dk-for="' + uniqueId + '" class="dk-price-wrapper dk-price-' + (attachType == 'contained' ? 'container' : 'popover') + '-wrapper"></div>');

            var Wrapper = null;
            var Container = null;
            var Header = null;
            var Footer = null;

            var close = function (option) {
                if (!Wrapper) return;
                Wrapper.fadeOut(function () {
                    $(this).remove();
                });
            };

            //  $('[dk-for="' + uniqueId + '"]').remove();

            Wrapper = WrapperPattern.clone();

            Container = containerPattern.clone();
            Header = headerPattern.clone();
            Footer = footerPattern.clone();

            Wrapper.append(Header);
            Wrapper.append(Container);
            Wrapper.append(Footer);

            if (attachType == 'attached') {
                Wrapper.removeClass('dk-wrapper-attached');

                if (!attachContext) {
                    attachContext = $('body');
                }

                if (!contextIsBody()) {
                    Wrapper.addClass('dk-wrapper-attached');
                }
            }


            if (options.wrapper.style) Wrapper.css(options.wrapper.style);

            $(attachContext).append(Wrapper.hide());

            getWrapper().find('.dk-price-close').click(close);

            if (attachType == "attached") {

                var off = function () {

                    // Kafiskari : start fart
                    var rowgroup = Wrapper.closest('[role=rowgroup]');

                    if (rowgroup.length > 0) {

                        rowgroup.css('position', 'relative');

                        var offsetRowgroup = rowgroup.offset();
                        var rowgroupHeight = rowgroup.height();
                        var rowgroupSpaceTop = offsetRowgroup.top + rowgroupHeight;
                        var offsetPopoverWrapper = Wrapper.offset().top + Wrapper.height() + 150;
                        var popOverHeight = Wrapper.height() + 150;

                        if (rowgroupSpaceTop - offsetPopoverWrapper < 0 && rowgroupHeight > popOverHeight) {
                            try {
                                var top = Wrapper.css('top');
                                //var top = new RegExp(/\d+/).exec(popoverWrapper.css('top'));
                                //top = parseInt(top, 10);
                                Wrapper.css({top: 'auto', bottom: top});

                            } catch (ex) {
                                console.log(ex);
                            }
                        }

                    }
                }


                //var positionRefresh = function () {

                //    if (tid) {
                //        clearTimeout(tid);
                //        tid = null;
                //    }

                //    var offset = popoverOffset();

                //    //tid = setTimeout(function () {

                //    Wrapper.css({ "top": (offset.top + $(superSelf).height() + 8) + "px", "left": offset.left + "px" });

                //    //popoverWrapperPattern.css({ "top": offset.top + $(superSelf).height() + 8 + "px", "left": offset.left + "px" });
                //    //}, 350);
                //};


                // Kafiskari : end fart


                //if (contextIsBody()) {


                //}

            }


            getContainer().html('');
            priceTranslate(getContainer());
            getContainer().append('<div class="dk-price-loading"> <div class="flex"><div class="loader"></div></div><div class="load-text">در حال دریافت اطلاعات ...</div>  </div>');
            if (attachType == "attached") {
                if (!contextIsBody()) {
                    off();
                } else {
                    positionRefresh();
                }

            }
            // add loading here to wrapper. show on start


        };

        var getData = function (callback) {
            $(superSelf).add(options.shadowElement).addClass('dk-input-loading');
            if (options.url != "") {
                $.ajax({
                    url: options.url,
                    data: {id: productConfigId},
                    success: function (data) {

                        if (typeof (data) == 'string') data = JSON.parse(data);

                        if (callback) callback(superSelf, data);

                        $(superSelf).add(options.shadowElement).removeClass('dk-input-loading');

                    },
                    error: function (response) {
                        $(superSelf).add(options.shadowElement).removeClass('dk-input-loading');
                        throw response;
                    }
                });
            }

        };

        var flag = false;
        var fn = {
            'for': function (id) {
                if (!attachType) throw 'please first define attachTo.';
                productConfigId = id;
                initWrapper();

                return fn;
            },
            show: function () {

                getWrapper().show();

                // show loading here
                /////////////// loading append
                if (options.url != "") {
                    if (flag == false) {

                        getData(function (input, data) {

                            // hide loading here
                            getContainer().find('.dk-price-loading').remove();

                            if (data.priceChart != null) {
                                if (data.priceChart.minDk.price != data.priceChart.maxDk.price || data.priceChart.minOther.price != data.priceChart.maxOther.price) {
                                    priceChart(getContainer(), data.priceChart);
                                }
                            }
                            if (data.priceNotes != null) {
                                priceNotes(getContainer(), data);
                            }


                        });
                        flag = true;
                    }
                }
                getContainer().find('.dk-price-loading').remove();
                flag = true;


                return fn;
            },
            hide: function () {
                getWrapper().hide();
                return fn;
            },
            attachTo: function (selector, setStyle) {

                if (selector == 'body') {

                    attachType = "attached";

                } else {
                    var closest = $(superSelf).closest(selector);

                    closest.css('position', 'relative');
                    attachContext = closest;
                    attachType = "attached";
                    if (setStyle) setStyle(closest);
                }


                return fn;
            },
            containedIn: function (selector, setStyle) {
                var container = $(selector);
                attachContext = container;
                attachType = "contained";
                if (setStyle) setStyle(container);
                return fn;
            }
        };

        $(superSelf).unbind('focus.dkprice').bind("focus.dkprice", fn.show);

        $(superSelf).unbind('blur.dkprice').bind("blur.dkprice", fn.hide);

        var valueChangeEvent = function () {
            var input = ($(superSelf).val()).replace(/\,/g, '');
            eventHook.invoke('valueChange', input);
        };

        //--keyup priceTranslate
        $(superSelf).unbind('keyup.priceTranslate').bind("keyup.priceTranslate", valueChangeEvent);
        //--keyup priceChart
        $(superSelf).unbind('keyup.priceChart').bind("keyup.priceChart", valueChangeEvent);
        //--keyup priceNote
        $(superSelf).unbind('keyup.priceNotesPs').bind("keyup.priceNotesPs", valueChangeEvent);

        //--keyup priceTranslate
        $(superSelf).unbind('focus.priceTranslate').bind("focus.priceTranslate", valueChangeEvent);
        //--keyup priceChart
        $(superSelf).unbind('focus.priceChart').bind("focus.priceChart", valueChangeEvent);
        //--keyup priceNote
        $(superSelf).unbind('focus.priceNotesPs').bind("focus.priceNotesPs", valueChangeEvent);

        if (contextIsBody()) {
            $(window).unbind('resize.dkprice').bind('resize.dkprice', function () {

                if (contextIsBody()) {
                    positionRefresh();
                }
                //.css({ "top": popoverOffset().top + $(superSelf).height() + 8 + "px", "left": popoverOffset().left + "px" });
            });
        }


        return fn;
    };

    dk.core = $.extend({}, dk.core, {
        type: function (obj) {
            return Object.prototype.toString.call(obj).replace(new RegExp(/\[object (\w+)\]/), '$1').toLowerCase();
        },
        isFunction: function (obj) {
            return dk.core.type(obj) === 'function';
        },
        isWindow: function (obj) {
            return obj != null && obj == obj.window;
        },
        isArray: function (obj) {
            return dk.core.type(obj) === 'array';
        },
        basics: {

            toPersianDigits: function (str) {
                if (!str) return "";
                var digits = ["٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩"];
                return str.replace(/0|1|2|3|4|5|6|7|8|9/g, function (matched) {
                    var index = parseInt(matched, 10);
                    return digits[index];
                });
            },
            toLatinDigits: function (str) {
                if (!str) return "";
                var digits = {"٠": 0, "١": 1, "٢": 2, "٣": 3, "٤": 4, "٥": 5, "٦": 6, "٧": 7, "٨": 8, "٩": 9};
                return str.replace(/٠|١|٢|٣|٤|٥|٦|٧|٨|٩/g, function (matched) {
                    return digits[matched];
                });
            },
            toPersianCurrency: function (str, currency) {
                if (!str) return "";
                if ($('.js-persian-currency-with-wrapper').length) {
                    str = str.toEnglishDigits();
                }
                var currency = currency || 'ریال';
                var value = (parseInt(str, 10) + '.').replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
                value = dk.core.basics.toPersianDigits(value.replace(/\./g, ''));
                return value + ' ' + currency;
            },
            money: function () {
                var suffix = {
                    'rial-ir': {
                        '1-digit': ['', 'یک', 'دو', 'سه', 'چهار', 'پنج', 'شش', 'هفت', 'هشت', 'نه'],
                        '2-digit': ['ده', 'یازده', 'دوازده', 'سیزده', 'چهارده', 'پانزده', 'شانزده', 'هفده', 'هجده', 'نوزده'],
                        'decimals': ['', 'ده', 'بیست', 'سی', 'چهل', 'پنجاه', 'شصت', 'هفتاد', 'هشتاد', 'نود'],
                        'hundreds': ['', 'صد', 'دویست', 'سیصد', 'چهارصد', 'پانصد', 'ششصد', 'هفتصد', 'هشتصد', 'نهصد'],
                        'else': ['', 'هزار', 'میلیون', 'میلیارد', 'هزار', 'صد هزار']
                    }
                };

                return {
                    translateToString: function (value, currencyText, currencyType) {
                        currencyType = currencyType || 'rial-ir';
                        currencyText = currencyText || 'ریال';

                        if ($('.js-persian-currency-with-wrapper').length) {
                            value = value.toEnglishDigits();
                        }

                        var translateToDigits = function (value) {
                            var translate = function (val, level, children) {
                                level = level || 0;
                                var arrD = [];
                                arrD.level = level;
                                if (children) arrD.push(children);
                                for (var i = 0; i < 3 - arrD.length; i++) {
                                    var step = 1;
                                    if (val >= 1) {
                                        var v = val;
                                        while (step / 1000 != 1 && v > 0) {
                                            var d = v % 10;
                                            v = Math.floor(v / 10);
                                            arrD.push(d);
                                            step *= 10;
                                        }

                                        val = Math.floor(val / 1000);
                                        if (val > 0) {
                                            var arr = translate(val, level + 1, arrD);
                                            return arr;
                                        }

                                    }
                                }
                                arrD.level = level;
                                return arrD;
                            };

                            return translate(value);
                        };

                        var digits = translateToDigits(value);

                        var getUnder1000Text = function (val) {
                            if (val == 0) return null;
                            if (val < 10) {
                                return suffix[currencyType]['1-digit'][val];
                            }
                            if (val < 20) {
                                return suffix[currencyType]['2-digit'][val - 10];
                            }
                            if (val >= 20 && val < 100) {
                                var d = Math.floor(val / 10);
                                var v = val - (d * 10);
                                return suffix[currencyType]['decimals'][d] + (v != 0 ? (function (v) {
                                    var r = getUnder1000Text(v);
                                    return r ? ' و ' + r : '';
                                })(v) : '');
                            }
                            if (val >= 100 && val < 1000) {
                                var d = Math.floor(val / 100);
                                var v = val - (d * 100);
                                return suffix[currencyType]['hundreds'][d] + (v != 0 ? (function (v) {
                                    var r = getUnder1000Text(v);
                                    return r ? ' و ' + r : '';
                                })(v) : '');
                            }
                            return null;
                        };

                        var translate = function (digits, str) {
                            if (digits.level > 4) return -1;
                            if (digits.length == 0) return '';
                            var strSuffix = suffix[currencyType]['else'][digits.level],
                                str = str || '',
                                val = 0,
                                counter = 0,
                                step = 1;

                            var vals = [];
                            var localVal = 0;
                            while (digits.length > 0 && !dk.core.isArray(digits[digits.length - 1])) {
                                vals.push(digits.pop());
                            }

                            for (var i = vals.length - 1; i >= 0; i--) {
                                localVal += vals[i] * step;
                                step *= 10;
                            }
                            var strCurrDigits = getUnder1000Text(localVal);
                            if (strCurrDigits) {
                                str += strCurrDigits + (strSuffix && localVal > 0 ? ' ' + strSuffix : '');
                            }

                            while (digits.length > 0) {
                                var txt = translate(digits.pop());
                                txt = txt.replace(new RegExp(/^[ ][و][ ]/), '');
                                str += (txt.length > 0 ? ' و ' : '') + txt;
                            }

                            return str;
                        };
                        var text = translate(digits);
                        var curr = (currencyText ? ' ' + currencyText : '');
                        if (!text) return '0' + curr;
                        if (text < 0) return 'خارج از محدوده!';
                        text = text.replace(new RegExp(/[ ][و][ ]$/), '');
                        return text + curr;
                    }
                };
            }()
        }
    });

}(dk, window, jQuery));



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



/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/subTableView.js]*/
var SubTableView = {
    init: function () {
        this.initDataSetTable();
    },

    initDataSetTable : function () {
        let $that = this;

        $(document).on('click', '.js-sub-table-container ul.js-sub-search-pager a', function () {
            let $page = $(this).data('page');
            let $tableContainer = $(this).parents('.js-sub-table-container');
            let $searchTable = $tableContainer.find('table.js-sub-search-table');

            if ($page === $that.getCurrentPage($tableContainer)) {
                return;
            }

            $that.search($tableContainer, $searchTable, $page, $that.getItemsPerPage($tableContainer));
        });

        $(document).on('change', '.js-sub-table-container select.js-sub-search-items-per-page', function () {
            let $tableContainer = $(this).parents('.js-sub-table-container');
            let $searchTable = $tableContainer.find('table.js-sub-search-table');

            $that.search($tableContainer, $searchTable, 1, $(this).val());
        });
    },

    getCurrentPage : function ($tableContainer) {
        let $aPage = $tableContainer.find('ul.js-sub-search-pager li.uk-active:first a');
        let $page;

        if ($aPage !== 'undefined' && ($page = $aPage.data('page'))) {
            return $page;
        }

        return 1
    },

    getSearchUrl : function ($searchTable) {
        return $searchTable.data('search-url');
    },

    getItemsPerPage : function ($tableContainer) {
        return $tableContainer.find('.js-sub-search-items-per-page').val();
    },

    isNewUI: function ($searchTable) {
        return $searchTable.data('new-ui');
    },

    search : function ($tableContainer, $searchTable, $page, $itemsPerPage) {
        const $that = this;
        $searchTable.find('.c-loading').removeClass('c-loading--hidden');
        $searchTable.find('.c-card__loading').addClass('is-active');
        let $staticFormData = [];

        $('.js-static-sub-form-data').each(function () {
            $staticFormData[$(this).attr('name')] = $(this).val();
        });

        window.Services.ajaxPOSTRequestHTML(
            $that.getSearchUrl($searchTable),
            $.extend(
                {
                    items: $itemsPerPage,
                    page: $page
                },
                $staticFormData
            ),
            function (data) {
                $tableContainer.html(data);

                if ($that.isNewUI($searchTable)) {
                    $that.initSelect2($tableContainer);
                }
            },
            false,
            false
        );
    },

    initSelect2 : function ($tableContainer) {
        const $selects = $tableContainer.find('.js-sub-search-items-per-page');
        if ($selects.length) {
            for (let i = 0, len = $selects.length; i < len; i++) {
                const $select = $($selects[i]);
                $select.select2({
                    placeholder: $select.attr('placeholder'),
                    minimumResultsForSearch: $select.hasClass('c-ui-select--search') ? 0 : Infinity,
                    language: window.Services.selectSearchLanguage
                }).data('select2').$dropdown.addClass('c-ui-select__dropdown c-ui-select__dropdown--gap');
            }
        }
    }
};

$(function () {
    SubTableView.init();
});



/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/controllers/adService/adServiceAjaxModals.js]*/
AdServiceAjaxModals = {
    init: function () {
        var functions = [
            this.initAllModals(),
        ];
    },
    initAllModals: function () {
        $('body').on('click', '.js-show-ajax-modal', (function () {
            const url = $(this).data('url');
            const thiz = $(this)
            const $spinner = $(thiz.data('modal-id') + " .js-modal-loading");
            $spinner.addClass("is-active");

            UIkit.modal(thiz.data('modal-id')).show();

            Services.ajaxGETRequestHTML(url, {}, function (html) {
                $(thiz.data('modal-id')).html(html);
                $spinner.removeClass("is-active");
            });
        }));
    }
};

$(function () {
    AdServiceAjaxModals.init();
});


/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/promotion.js]*/
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



/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/controllers/promotionEligibleVariantsController/modal.js]*/
var EligibleVariantsModal = {
    addedVariants: {},
    selectedCount: typeof selectedVariantsCount != 'undefined' ? selectedVariantsCount : 0,
    onClickAddToPromotionButton: function () {
    },
    init: function () {
        this.initSelectProductsModal();
    },
    initSelectProductsModal: function () {
        var self = this;
        // todo @ebi refactor getting promotion id
        var promotionId = $('#join-promotions-container').data('promotion-id') || 0;

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
                $('.js-add-variant-to-promotion', document).removeClass('uk-disabled c-join__btn--deactive');
            } else {
                $('.js-add-variant-to-promotion', document).addClass('uk-disabled c-join__btn--deactive');
            }
        });

        $(document).on('click', '.js-add-variant-to-promotion', function () {
            var selectedVariantsIds = [];
            $.each(EligibleVariantsModal.addedVariants, function (e, v) {
                selectedVariantsIds.push(v);
            });
            EligibleVariantsModal.onClickAddToPromotionButton(selectedVariantsIds);
            UIkit.modal('#js-select-products').hide();
        });

        var campainId = $("input[name='campain_id']").val();

        var url =  campainId + '/load-product-variants';
        $('.js-select-products').on('click', function (e) {
            e.preventDefault();
            var params = {'page': 1};
            EligibleVariantsModal.searchProductsVariants(url, params);
        });

        $(document).on('submit', '#js-select-products #searchForm', function (e) {
            e.preventDefault();
            var params = $('#js-select-products #searchForm').serialize();
            EligibleVariantsModal.searchProductsVariants(url, params);
        });

        $(document).on('change', '.js-search-sort', function (e) {
            e.preventDefault();
            var params = $('#js-select-products #searchForm').serialize();
            EligibleVariantsModal.searchProductsVariants(url, params);
        });

        $(document).on('change', '.submit-on-change', function (e) {
            e.preventDefault();
            var params = $('#js-select-products #searchForm').serialize();
            EligibleVariantsModal.searchProductsVariants(url, params);
            try {
                gtag('event', 'click', {
                    'event_category': 'Filter Usage',
                    'event_action': 'Click on Amazing Product only Filter',
                    'non_interaction': true
                });
            } catch (e) {
                console.log(e);
            }
        });

        $(document).on('click', '.js-sub-table-container ul.js-sub-search-pager a', function () {
            let $page = $(this).data('page');
            var params = $('#js-select-products #searchForm').serialize();
            params += "&page=" + $page;
            EligibleVariantsModal.searchProductsVariants(url, params);
        });
    },
    searchProductsVariants: function (url, params) {
        var $spinner = $('.js-modal-loading'), self = this;
        $spinner.addClass('is-active');
        Services.ajaxPOSTRequestHTML(url, params, function (response) {
                $('#js-select-products .uk-modal-body').html(response);
                let $tableContainer = $('#js-select-products').find('.js-sub-table-container');
                EligibleVariantsModal.initSelect2($tableContainer.find('.js-sub-search-items-per-page'));
                EligibleVariantsModal.initSelect2($tableContainer.find('.js-re-init-select2-after-ajax'));
                UIkit.modal('#js-select-products').show();
                $('.js-selected-variants-count').text(Services.convertToFaDigit(self.selectedCount));
                $spinner.addClass('is-active');
                EligibleVariantsModal.checkAlreadyAddedVariants();
            },
            function (response) {
                $spinner.removeClass('is-active');
                UIkit.notification(response, {status: 'danger', pos: 'bottom-right', timeout: 10000});
                EligibleVariantsModal.initManageLayout();
            },
            true,
            true
        );
    },
    initSelect2: function ($selects) {
        if ($selects.length) {
            for (let i = 0, len = $selects.length; i < len; i++) {
                const $select = $($selects[i]);
                $select.select2({
                    placeholder: $select.attr('placeholder'),
                    minimumResultsForSearch: $select.hasClass('c-ui-select--search') ? 0 : Infinity,
                    language: window.Services.selectSearchLanguage
                }).data('select2').$dropdown.addClass('c-ui-select__dropdown c-ui-select__dropdown--gap');
            }
        }
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
    EligibleVariantsModal.init();
});


/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/controllers/periodicPricesController/indexAction.js]*/
var IndexAction = {
    init: function () {
        this.initModal();
        this.initSelect();
        this.initManageLayout();
        this.initExcelModel();
        this.initUpdateVariant();
        this.initBatchInputBoxes();
        this.initSearchEvents();
        this.afterCancelButtonClickedEvents();
        this.closeGuide();
        this.selectPeriodicPriceProduct();
        this.switchTable();
        this.initBatchConfirm();
        this.initRedirectToSuccessPage();
        EligibleVariantsModal.onClickAddToPromotionButton = IndexAction.addVariantsToTable;
    },

    initModal: function () {
        $('.js-select-products').on('click', function (e) {

            UIkit.modal('#js-select-products').show();
        });
    },
    initSelect: function () {
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
    addVariantsToTable: function (variantsIds) {
        var nonExistVariantIds = [];
        for (let i = 0; i < variantsIds.length; i++) {
            if ($('.variant-'+variantsIds[i]).length===0) {
                nonExistVariantIds.push(variantsIds[i])
            }
        }
        Services.ajaxPOSTRequestJSON(
            '/campains/render-add-variants-rows',
            {'variantIds': nonExistVariantIds},
            function (response) {
                if (isModuleActive('collective_promotions_module')) {
                    $('.js-remove-in-add-form').remove();
                    $('.js-paginator').remove();
                    $('.js-show-on-add').removeClass('uk-hidden');
                    $('.js-table-container tr:not(:nth-child(1)):not("tr.added-by-js")').remove();
                }
                $(response).insertAfter('.js-table-container .c-join__group-edit');
                IndexAction.initRemovePromotionVariant();
                // IndexAction.initSubmitNewPromotionVariant();
                IndexAction.initManageLayout();
                Promotion.initDatePickers()
                Promotion.initNumericInput();
            },
            function (response) {
                UIkit.notification(response, {status: 'danger', pos: 'top-left', timeout: 10000});
            },
            true,
            true
        )
    },
    initRemovePromotionVariant: function () {
        $(document).on('click','tr.added-by-js .js-remove-variant',function () {
            var tr = $(this).parents('tr');
            $(tr).fadeOut(1000, function () {
                $(tr).remove();
                IndexAction.initManageLayout();
            });
        });
    },
    initManageLayout: function () {

        let minimumNumberOfRows = 2;

        $('.page-layout').hide();
        if ($('.layout-active .c-periodic-prices__table tr').length > minimumNumberOfRows) {
            $('.layout-active').show()
        } else if ($('.layout-ended .c-periodic-prices__table tr').length > minimumNumberOfRows) {
            $('.layout-ended').show()
        } else {
            $('.layout-empty').show()
        }
        $(document).on('click', '.js-empty-layout-add-btn', function () {
            $('.page-layout').fadeOut(100);
            $('.layout-add').fadeIn(500);

            $('.js-back-to-products-list').attr('disabled', false);
            $('.js-back-to-products-list').click(function () {
                $('.layout-empty').addClass('uk-hidden')
                $('.page-layout').fadeIn(100);
                $('.layout-add').fadeOut(500)
            });

        });

    },
    initSubmitNewPromotionVariant:function () {

    },
    initExcelModel: function () {
        $('.js-products-file').on('change', function (e) {
            e.preventDefault();
            var formData = new FormData();

            var el = $('#excel_file').length ? $('#excel_file')[0] : null;
            var file = (el && el.files != undefined) ? el.files[0] : null;
            formData.append('periodic_price_excel_file', file);
            $.ajax({
                url: '/ajax/campains/excel/import/',
                type: 'POST',
                data: formData,
                cache: false,
                header: {
                    "Content-Type": "multipart/form-data"
                },
                processData: false,
                contentType: false,
                beforeSend: function () {},
                error: function (response) {
                    UIkit.notification('خطایی در آپلود فایل رخ داد', {status: 'danger', pos: 'top-left'});
                },
                success: function (response) {
                    if (response.status) {
                        UIkit.notification('فایل شما بارگذاری شد. برای مشاهده وضعیت آن به منوی گزارشات/گزارش پروموشن ها مراجعه نمایید.', {status: 'success', pos: 'bottom-right'});
                    } else {
                        UIkit.notification(response.data.errors, {status: 'danger', pos: 'top-left'});
                    }
                }
            });
        });
    },
    initRedirectToSuccessPage: function () {
        $(document).on('onSuccessfullyAdd', '.js-save-promotion-price-record-changes', function (e) {

            if ($('tr.added-by-js').length === $('tr.js-successfully-added').length && $('tr.js-successfully-added').length !== 0) {
                window.location.href = '/campains/done/index';
            }
        });
    },
    initUpdateVariant: function () {
        $(document).on('click', '.js-save-promotion-price-record-changes', function (e) {
            e.preventDefault();
            var self = $(this);

            if (isModuleActive('collective_promotions_module')) {
                if (self.parents('tr').hasClass('js-successfully-added')) {
                    return;
                }
            }

            var isToggleRow = self.closest('tr').hasClass('js-table-swap-row');
            var toggleHandleContainerRow = isToggleRow ? self.closest('tr').prev('tr') : self.closest('tr');

            var isOpen = toggleHandleContainerRow.hasClass('is-active-swap');

            /**
             * @type {{promotionVariantId: Number, order_limit: Number, limit: Number, promotion_price: Number}}
             */
            var data = {
                promotion_variant_id: self.data('promotion-variant-id'),
                id: self.data('product-variant-id'),
                campain_id: $("input[name='campain_id']").val(),
                promotion_order_limit: 0,
                promotion_limit: 0,
                promotion_price: 0,
                start_at: 0,
                end_at: 0,
            };

            var fields =

                $(this).closest('tr').find('input[name*=variant]'), fieldsArray = fields.toArray();

            for (var i = 0; i < fieldsArray.length; ++i) {
                var name = /^variant\[(\w+)](\[(\w+)])?$/.exec($(fieldsArray[i]).attr('name'))[1];
                var value = $(fieldsArray[i]).val();
                if ($(fieldsArray[i]).prop('type') === 'checkbox') {
                    value = $(fieldsArray[i]).is(':checked') ? 1 : 0;
                }
                data[name] = value;
            }

            self.closest('tbody').children('tr.is-active-swap').removeClass('is-active-swap');
            Services.ajaxPOSTRequestJSON(
                '/campains/save',
                data,
                function (response) {
                    var viewer = self.closest('tr').siblings('[data-variant="' + data.promotion_variant_id + '"]');

                    viewer.find('.js-variant-order-limit').text(Services.convertToFaDigit(data.promotion_order_limit));
                    viewer.find('.js-variant-limit').text(Services.convertToFaDigit(data.promotion_limit));
                    viewer.find('.js-selling-price').text(Services.convertToFaDigit(Services.formatCurrency(data.promotion_price, false, '')));

                    self.closest('tr.is-active-swap').removeClass('is-active-swap');

                    if (isModuleActive('collective_promotions_module')) {
                        self.closest('tr.added-by-js').addClass('js-successfully-added');
                        self.closest('tr').find('.js-edit-actions button')
                    } else {
                        self.closest('tr.added-by-js').removeClass('added-by-js');
                    }

                    self.closest('tr').find('.js-save-promotion-price-record-changes').data('promotion-variant-id',response.promotion_variant_id);
                    self.closest('tr').find('.js-remove-variant').data('promotion-variant-id',response.promotion_variant_id);
                    self.closest('tr').find('.js-undo-remove-button').data('promotion-variant-id',response.promotion_variant_id);

                    if (!isOpen) {
                        toggleHandleContainerRow.addClass('is-active-swap');
                    }

                    self.closest('tr').find('.js-edit-actions button').prop('disabled', true);

                    if (self.closest('tr').find(".variant_status").first().is(":checked")) {
                        self.closest('tr').find(".variant_status").first().attr('data-reset', 'checked');
                    } else if (!self.closest('tr').find(".variant_status").first().is(":checked")) {
                        self.closest('tr').find(".variant_status").first().attr('data-reset', 'not-checked');
                    }


                    if (self.closest('tr').find(".time_status").first().is(":checked")) {
                        self.closest('tr').find(".time_status").first().attr('data-reset', 'checked');
                    } else if(!self.closest('tr').find(".time_status").first().is(":checked")){
                        self.closest('tr').find(".time_status").first().attr('data-reset', 'not-checked');

                        self.closest('tr').find(".start_at").first().val('');
                        self.closest('tr').find(".start_at_hidden").first().val('');
                        self.closest('tr').find(".end_at").first().val('');
                        self.closest('tr').find(".end_at_hidden").first().val('');

                        self.closest('.c-ui-table__row').find('.start_at').val('');
                        self.closest('.c-ui-table__row').find('.start_at_hidden').val('');
                        self.closest('.c-ui-table__row').find('.end_at_hidden').val('');
                        self.closest('.c-ui-table__row').find('.end_at').val('');

                    }



                    if (isModuleActive('collective_promotions_module')) {
                        $('.added-by-js-messages-' + self.data('productVariantId'))
                            .removeClass('uk-hidden')
                            .html('با موفقیت ذخیره شد.')
                            .removeClass('c-mega-campaigns-join-list__container-table-error')
                            .addClass('c-mega-campaigns-join-modal__body-table-input--success');
                        $('.added-by-js-messages-' + self.data('productVariantId')).parents('tr')
                            .removeClass('c-join__table-row--danger')
                        self.trigger('onSuccessfullyAdd');
                    } else {
                        UIkit.notification({
                            message: 'انجام شد',
                            status: 'success',
                            pos: 'top-left',
                            timeout: 8000
                        });
                    }
                },
                function (response) {
                    var errors = Object.values(response.errors);
                    if (isModuleActive('collective_promotions_module')) {
                        errorMessage = errors.map(function (err) {return err;}).join('');
                        $('.added-by-js-messages-' + self.data('productVariantId')).html(errorMessage)
                            .removeClass('uk-hidden')
                            .addClass('c-mega-campaigns-join-list__container-table-error')
                            .removeClass('c-mega-campaigns-join-modal__body-table-input--success');
                        $('.added-by-js-messages-' + self.data('productVariantId')).parents('tr')
                            .addClass('c-join__table-row--danger')
                    } else {
                        if (errors.length > 0) {
                            UIkit.notification({
                                message: errors[0],
                                status: 'danger',
                                pos: 'top-left',
                                timeout: 8000
                            });
                        } else {
                            UIkit.notification({
                                message: 'قیمت کالا با شرایط پروموشن هم‌خوانی ندارد',
                                status: 'danger',
                                pos: 'top-left',
                                timeout: 8000
                            });
                        }
                    }
                }
            );
        });
    },
    initBatchConfirm: function () {
        $('.js-confirm-promotion').click(function () {
            $('.js-save-promotion-price-record-changes').trigger('click');
        });
    },
    initBatchInputBoxes: function () {

        function initPricingInput(target, id) {
            const dkPrice = target.dkprice({
                displayMode: window.DISPLAY_MODES.popover,
                shadowElement: target.parent(),
                wrapper: {
                    style: {}
                }
            });
            dkPrice.attachTo("body").for(id);
        }

        function initPricing(e) {
            const input = e.target;
            const id = input.closest("tr").dataset.id;
            const $input = $(input);

            $(".dk-price-wrapper").remove();
            initPricingInput($input, id);
            $input.trigger("focus");
        }

        $('.js-all-variants-discount-percent').keyup(function () {
            $('tr.added-by-js .js-discount-value').val($(this).val()).trigger('change');
        });
        $('.js-all-variants-promotion-limit').keyup(function () {
            $('tr.added-by-js .js-input-promotion-limit').val($(this).val()).trigger('change');
        });
        $('.js-all-variants-order-limit').keyup(function () {
            $('tr.added-by-js .js-input-order-limit').val($(this).val()).trigger('change');
        });

        $(document).on('click', '.js-promotion-price', initPricing);
        $(document).on('keyup', '.js-promotion-price', function () {
            var thiz = $(this)
            var discountField = $(this).parents('tr').find('.js-discount-value');
            discountField.val(thiz.data('crossed_price') != 0 ? Math.round(((thiz.data('crossed_price') - $(this).val()) / thiz.data('crossed_price')) * 100) : 0);
        });
        $(document).on('change', '.js-number-input', function () {
            $(this).keyup();
        });
    },
    initSearchEvents: function () {
        $(document).on('onSearchFinished', '.js-table-container', function () {
            Promotion.initDatePickers();
        });
    },
    afterCancelButtonClickedEvents: function () {
        $(document).on('afterResetEvent', '.js-promotion-date-picker', function () {
            Promotion.initDatePickers();
        });
    },

    closeGuide: function(){
        var $close = $('.js-close-guide');
        if(!$close) return;

        $close.on('click', function(){

            $('.js-guide-container').fadeOut(500, function(){
                $(this).addClass('uk-hidden');
            });
        });
    },

    selectPeriodicPriceProduct: function() {
        //todo @ebi can be removed after implementing all pages
        $('.js-add-product-to-smart-promotion-list').on('click', function () {
            $('.js-empty-smart-promotion').fadeOut(500, function () {
                $(this).addClass('uk-hidden');
            });
            $('.js-guide-container').fadeIn(500, function () {
                $(this).removeClass('uk-hidden');
            });
            $('.js-add-product-container').fadeIn(500, function () {
                $(this).removeClass('uk-hidden');
            });
        });

        // var periodicProduct = $('.js-select-periodic-price-products-modal');
        // if(!periodicProduct) return;
        // UIkit.modal('#js-active-campaign-list-modal').show();

        $('.js-select-periodic-products').on('click', function () {
            UIkit.modal('#js-select-periodic-price-products-modal').show();
        });

        $('.js-active-campaign-list').on('click', function () {
            UIkit.modal('#js-select-periodic-price-products-modal').hide();
            UIkit.modal('#js-active-campaign-list-modal').show();
        });

        $('.js-add-to-promotion-list').on('click', function () {
            location.href = '/dkstatic/smart-promotion/list/'
        });

        if (location.href.includes('/campains/active/#select')) {
            UIkit.modal('#js-select-periodic-price-products-modal').show();
        }

        $('.js-back-to-select-product-modal').on('click', function () {

            if (location.href.includes('/campains/active/')) {
                UIkit.modal('#js-active-campaign-list-modal').hide();
                UIkit.modal('#js-select-periodic-price-products-modal').show();
            } else {
                location.href = '/campains/active/#select'
            }
        });

        $('.js-show-active-campaign-list').on('click', function () {
            UIkit.modal('#js-active-campaign-list-modal').show();
        });

        $('.js-back-to-campaign-list').on('click', function () {
            location.href = '/campains';
        });

        $('.js-back-promotion-management').on('click', function () {
            location.href = '/dkstatic/smart-promotion/products/';
        });

        $('.js-add-product-to-promotion-list').on('click', function () {
            location.href = '/campains/active/';
        });
    },



    switchTable: function () {

        if(!$('.js-active-discount')) return;
        var $activeTab = $('.js-active-discount'),
            $deactiveTab = $('.js-deactive-discount');

        var swichClass = function ($element) {
            $element.on('click', function () {
                $(this).toggleClass('c-mega-campaigns-join-list__options-item--active');
                $(this).siblings('span').toggleClass('c-mega-campaigns-join-list__options-item--active');
                $('.js-active-discount-list').toggleClass('uk-hidden');
                $('.js-deactive-discount-list').toggleClass('uk-hidden');
            });
        }

        swichClass($activeTab);
        swichClass($deactiveTab);
    }
};

$(function () {
    IndexAction.init();
});



/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/controllers/promotionManagementController/detailsAction.js]*/
var detailsAction = {
    displayName: "detailsAction",

    init: function () {
        var fns = [
            this.initSelect,
            this.initTableInput,
            this.initUpdateVariant,
            this.initRemoveVariant,
            this.initBindPrices,
            this.initPager
        ];

        for (var i = 0; i < fns.length; ++i) {
            try {
                fns[i].bind(this)();
            } catch (e) {
                console.log("Error in " + this.displayName + ": ", e);
            }
        }
    },

    initSelect: function () {
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

    initTableInput: function () {
        $(document).on('change', '.js-edit-row input', function () {
            $(this).closest('tr').find('.js-edit-actions button').prop('disabled', false);
        });
    },

    initUpdateVariant: function () {
        var thiz = this;
        $(document).on('click', '.js-edit-cancel-button', function (e) {
            e.preventDefault();
            $(this).closest('tr').find('.js-edit-actions button').prop('disabled', true);

            if ($(this).closest('tr').find(".time_status").first().attr('data-reset') == 'checked') {
                $(this).closest('tr').find(".time_status").first().prop('checked', true);
            } else {
                $(this).closest('tr').find(".time_status").first().prop('checked', false);
            }

            if ($(this).closest('tr').find(".variant_status").first().attr('data-reset') == 'checked') {
                $(this).closest('tr').find(".variant_status").first().prop('checked', true);
            } else {
                $(this).closest('tr').find(".variant_status").first().prop('checked', false);
            }

            thiz.resetInputs($(this));
        });

        $('.js-variant-save-changes').off();
        $(document).on('click', '.js-variant-save-changes', function (e) {
            e.preventDefault();

            var self = $(this);
            var isToggleRow = self.closest('tr').hasClass('js-table-swap-row');
            var toggleHandleContainerRow = isToggleRow ? self.closest('tr').prev('tr') : self.closest('tr');

            var isOpen = toggleHandleContainerRow.hasClass('is-active-swap');

            /**
             * @type {{promotionVariantId: Number, order_limit: Number, limit: Number, promotion_price: Number}}
             */
            var data = {
                promotion_variant_id: self.data('variant'),
                promotion_order_limit: 0,
                promotion_limit: 0,
                promotion_price: 0
            };

            var fields = $(this).closest('tr').find('input[name*=variant]'), fieldsArray = fields.toArray();

            for (var i = 0; i < fieldsArray.length; ++i) {
                var name = /^variant\[(\w+)]$/.exec($(fieldsArray[i]).attr('name'))[1];
                var value = $(fieldsArray[i]).val();
                if ($(fieldsArray[i]).prop('type') === 'checkbox') {
                    value = $(fieldsArray[i]).is(':checked') ? 1 : 0;
                }
                data[name] = value;
            }

            var promotionId = !!window.promotionId ? window.promotionId : self.data('promotion');

            self.closest('tbody').children('tr.is-active-swap').removeClass('is-active-swap');
            Services.ajaxPOSTRequestJSON(
                '/ajax/seller/' + promotionId + '/save/variant/',
                data,
                function (response) {
                    var viewer = self.closest('tr').siblings('[data-variant="' + data.promotion_variant_id + '"]');

                    viewer.find('.js-variant-order-limit').text(Services.convertToFaDigit(data.promotion_order_limit));
                    viewer.find('.js-variant-limit').text(Services.convertToFaDigit(data.promotion_limit));
                    viewer.find('.js-selling-price').text(Services.convertToFaDigit(Services.formatCurrency(data.promotion_price, false, '')));

                    self.closest('tr.is-active-swap').removeClass('is-active-swap');

                    if (!isOpen) {
                        toggleHandleContainerRow.addClass('is-active-swap');
                    }

                    self.closest('tr').find('.js-edit-actions button').prop('disabled', true);
                },
                function (response) {
                    var errors = Object.values(response.errors);
                    if (errors.length > 0) {
                        UIkit.notification({
                            message: errors[0],
                            status: 'danger',
                            pos: 'bottom-right',
                            timeout: 8000
                        });
                    } else {
                        UIkit.notification({
                            message: 'قیمت کالا با شرایط پروموشن هم‌خوانی ندارد',
                            status: 'danger',
                            pos: 'bottom-right',
                            timeout: 8000
                        });
                    }

                }
            );
        });
    },

    initRemoveVariant: function () {
        var thiz = this;
        var timeOuts = {};


        $(document).on('click', '.js-remove-variant', function (e) {
            e.preventDefault();

            var self = $(this),
                promotionVariantId = self.data('promotion-variant-id');
            if (typeof promotionVariantId == 'undefined' || promotionVariantId.length === 0) {
                return;
            }
            var promotionId = !!window.promotionId ? window.promotionId : (self.data('promotion') || 0);

            self.closest('tr').addClass('c-join__table-row--is-deleted');
            self.closest('tr').find('.js-action-buttons').addClass('uk-hidden');
            self.closest('tr').find('.js-undo-remove').removeClass('uk-hidden');
            self.closest('tr').find('.js-edit-actions button').prop('disabled', true);
            timeOuts[promotionVariantId] = setTimeout(function () {
                Services.ajaxPOSTRequestJSON(
                    promotionId + '/delete',
                    {
                        promotionVariantId: promotionVariantId
                    },
                    function (response) {
                        self.closest('tr').remove();
                    },
                    function (error) {
                        UIkit.notification({
                            message: error.errors,
                            status: 'danger',
                            pos: 'bottom-right',
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

        var variantTimeOut;
        $(document).on('click', '.js-remove-product-variant', function (e) {
            e.preventDefault();

            var self = $(this),
                productVariantId = self.data('variant');

            self.addClass('uk-hidden');
            $('.js-undo-remove-variant-button', document).removeClass('uk-hidden');
            variantTimeOut = setTimeout(function () {
                Services.ajaxPOSTRequestJSON(
                    '/ajax/promotion-management/products/delete/variant/' + productVariantId + '/',
                    {},
                    function (response) {
                        window.location.reload();
                    },
                    function (error) {
                        UIkit.notification({
                            message: error.errors.permission,
                            status: 'danger',
                            pos: 'bottom-right',
                            timeout: 8000
                        });
                    }
                );
            }, 5000);
        });

        $(document).on('click', '.js-undo-remove-variant-button', function (e) {
            e.preventDefault();

            var self = $(this);
            clearTimeout(variantTimeOut);

            self.addClass('uk-hidden');
            $('.js-remove-product-variant', document).removeClass('uk-hidden');
        });
    },

    initBindPrices: function () {
        function initPricingInput(target, id) {
            const dkPrice = target.dkprice({
                displayMode: window.DISPLAY_MODES.popover,
                shadowElement: target.parent(),
                wrapper: {
                    style: {}
                }
            });
            dkPrice.attachTo("body").for(id);
        }

        function initPricing(e) {
            const input = e.target;
            const id = input.closest("tr").dataset.id;
            const $input = $(input);

            $(".dk-price-wrapper").remove();
            initPricingInput($input, id);
            $input.trigger("focus");
        }
        $(document).on('click', '.js-promotion-price', initPricing);
        $(document).on('change', '.js-discount-value', function () {
            var $row = $(this).closest('tr'),
                discountValue = parseInt($(this).val()),
                $promotionPriceInput = $row.find('.js-promotion-price'),
                promotion_price;

            if (isModuleActive('adservice_sku_price')) {
                promotion_price = Math.round($promotionPriceInput.data('crossed_price') * (100 - discountValue) / 100);
            } else {
                promotion_price = Math.round($promotionPriceInput.data('selling_price') * (100 - discountValue) / 100);
            }

            $promotionPriceInput.val(promotion_price);

            if ((typeof promotionTag !== 'undefined' && promotionTag === 'incredible_offer') || $row.data('promotion-tag') === 'incredible_offer') {
                var $orderLimitInput = $row.find('.js-input-order-limit');
                $orderLimitInput.val($orderLimitInput.data(promotion_price > 1500 * 1000 ? 'min' : 'max'));
            }
        });

        $(document).on('change', '.js-promotion-price', function () {
            var $this = $(this),
                $row = $this.closest('tr'),
                $discountValueInput = $row.find('.js-discount-value'),
                discount_amount;
            var promotion_price = Math.floor(parseInt($(this).val())/100) * 100;

            if (isModuleActive('adservice_sku_price')) {
                discount_amount = Math.round((parseInt($this.data('crossed_price')) - promotion_price) * 100 / parseInt($this.data('crossed_price')));
            } else {
                discount_amount = Math.round((parseInt($this.data('selling_price')) - promotion_price) * 100 / parseInt($this.data('selling_price')));
            }

            $discountValueInput.val(discount_amount);
        });
    },

    resetInputs: function ($button) {
        $button.closest('tr').find('input').each(function(index, element) {
            var $element = $(element);
            $element.val($element.prop('defaultValue'));
            $element.trigger('afterResetEvent');
        });
    },

    initPager: function () {
        $(document).on('click', '.js-adservice-pager a', function (e) {
            e.preventDefault();

            var url = '/ajax/promotion-management/products/' + $('.js-products-pager', document).data('variant') + '/';
            var $spinner = $('.js-modal-loading');
            $spinner.addClass('is-active');
            Services.ajaxGETRequestHTML(
                url + '?page=' + $(this).data('page'),
                $('#select-search-form').serialize(),
                function (html) {
                    $('.js-products-content').html(html);
                    $spinner.removeClass('is-active');
                }
            );
        });
    }
};

$(function () {
    detailsAction.init();
});
