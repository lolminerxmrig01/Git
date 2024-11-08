/*[PATH @digikala/supernova-digikala-desktop/assets/local/js/controllers/cartController/indexAction.js]*/
var IndexAction = {

    init: function () {
        var functions = [
            this.initPageNavigation,
            this.bindEvents,
            this.initSelects,
            this.initRemoveFromCart,
            this.initRemoveFromSave,
            this.initPreOrderModal,
            this.initFailedAddToCart,
            this.initErrorViewer,
            this.initDuplicateOrderItemPopup,
            this.initOptionalShipment,
            this.initSaveForLaterEvents,
            this.initQuantitySelector,
            this.getSimilarProducts,
            this.initShipmentTypeEvents
        ];

        if(isModuleActive('save_for_later_data_layer')) {
            functions.push(this.initSaveForLaterCardClick);
        }

        if(isModuleActive('add_item')) {
            functions.push(this.initAddItemCart);
        }

        if(isModuleActive('data_layer')) {
            functions.push(
                this.setGAUserStatus,
                this.initGAImpressionClickHandler
            );
        }

        if(isModuleActive('cart_swiper_ab_test')) {
            functions.push(this.initSideBarRecommendation);
        }

        if(isModuleActive('digipay_cart_credit')) {
            functions.push(this.initDigipayCreditBanner);
        }

        var self = this;
        for (var i = 0; i < functions.length; ++i) {
            try {
                var fn = functions[i].bind(self);
                fn();
            } catch (e) {
                window.Sentry && window.Sentry.captureException(e);
                // eslint-disable-next-line no-console
                console.warn(e);
            }
        }
    },

    initDigipayCreditBanner: function () {
        var $bannerContainer = $('.js-digipay-credit'),
            $partialMessage = $('.js-digipay-credit-partial'),
            amount = $bannerContainer.data('amount');

        if(typeof(amount) === 'undefined') {
            return;
        }

        Services.ajaxGETRequestJSON(
            '/credit/offer/' + amount + '/',
            {},
            function (response) {
                var installmentText = Services.convertToFaDigit(Services.formatCurrency(response.installment_amount, true, 'تومان'))
                    + ' ماهانه (' + Services.convertToFaDigit(response.installment_count) + ' قسط)';

                $('.js-digipay-credit-pre-payment')
                    .text(Services.convertToFaDigit(Services.formatCurrency(response.pre_payment_amount, true, 'تومان پیش پرداخت')));
                $('.js-digipay-credit-installment-amount')
                    .text(installmentText);

                if(response.is_partial) {
                    $partialMessage.removeClass('u-hidden');
                }

                $bannerContainer.removeClass('u-hidden');
            },
            function (response) {
            },
            false,
            false
        );
    },

    initSideBarRecommendation: function() {
        new window.Swiper(".js-shipping-fresh-carousel", {
            slidesPerView: 1,
            slidesPerGroup: 1,
            lazy: {
                enabled: true
            },
            navigation: {
                nextEl: ".js-fmcg-recommend-next",
                prevEl: ".js-fmcg-recommend-prev"
            },
            keyboard: {
                enabled: true,
                onlyInViewport: true
            },
            on: {
                // slideChange: function () {
                //     try{
                //         ga('require', 'ec');
                //     } catch (e) {
                //     }
                //
                //     var activeIndex = this.activeIndex;
                //     for (var i=activeIndex * 4; i<activeIndex * 4 + 4; i++) {
                //         var product = window.userRecommendationSidebar.products[i];
                //
                //         try {
                //             ga('ec:addImpression', {
                //                 'id': '' + product.id,
                //                 'name': product.name,
                //                 'category': product.category,
                //                 'brand': product.brand,
                //                 'list': 'Cart-Side-Recommendation-' + pageNumber,
                //                 'price': product.price,
                //                 'status': product.status,
                //                 'position': i + 1
                //             });
                //         } catch (e) {
                //         }
                //     }
                // }
            }
        });

        $('.js-shipping-add-to-cart').click(function () {
            var $this = $(this);
                // idx = $this.data('index'),
                // product = window.userRecommendationSidebar.products[idx];

            Services.ajaxGETRequestHTML(
                $this.data('add-to-cart-url'),
                null,
                function () {
                    window.location.reload();
                },
                function (data) {
                },
                true,
                true,
            );

            // try {
            //     ga('ec:addProduct', {
            //         'id': product.id,
            //         'name': product.name,
            //         'category': product.category,
            //         'brand': product.brand,
            //         'variant': product.buy_box_winner,
            //         'price': product.price
            //     });
            //     ga('ec:setAction', 'add');
            //     ga('send', 'event', 'Cart Recommendation', 'add to cart', 'add product from cart side recommendation');
            // } catch(e) {
            // }
        });
    },

    initGAImpressionClickHandler: function() {
        $(document).on('click', '.js-product-url', function() {
            var $productLink = $(this),
                $productItem = $productLink.closest('.js-product-box'),
                productId = $productLink.data('id') || $productItem.data('id');

            try {
                var productData = Services.retrieveProductFromDataLayer({
                    productId: productId,
                    eventName: 'eec.productImpression',
                    pathArray: ['ecommerce', 'impressions']
                });
                var impressionObject = createImpressionObj(productData);

                window.dataLayer.push(impressionObject);
            } catch (e) {
                window.Sentry && window.Sentry.captureException(e);
                // eslint-disable-next-line no-console
                console.warn(e);
            }
        });

        function createImpressionObj(productObject) {
            var productObjectCopy = Object.assign({}, productObject),
                list = Main.gaListName;

            delete productObjectCopy.list;

            return {
                'event': 'eec.impressionClick',
                'ecommerce': {
                    'click': {
                        'actionField': {
                            'list': list
                        },
                        'products': [productObjectCopy]
                    }
                }
            }
        }
    },

    setGAUserStatus: function () {
        var user = new UserClass(),
            userStatus = user.isLogged() ? 'Logged in' : 'Not Logged in';

        window.dataLayer.push({
            event: 'eec.checkoutOption',
            ecommerce: {
                checkout_option: {
                    actionField: {
                        step: 1,
                        option: userStatus
                    }
                }
            }
        });
    },

    setGARemoveFromCartImpressionEvent: function(productId) {
        try {
            var productData = Services.retrieveProductFromDataLayer({
                productId: productId,
                eventName: 'eec.checkout',
                pathArray: ['ecommerce','checkout','products']
            });
            var impressionObject = createImpressionObj(productData);

            window.dataLayer.push(impressionObject);
        } catch (e) {
            window.Sentry && window.Sentry.captureException(e);
            // eslint-disable-next-line no-console
            console.warn(e);
        }

        function createImpressionObj(productData) {
            return {
                'event': 'eec.removeFromCart',
                'ecommerce': {
                    'currencyCode': 'EUR',
                    'remove': {
                        'products': [{
                            'name': productData.name,
                            'id': productData.id,
                            'price': productData.price,
                            'brand': productData.brand,
                            'category': productData.category,
                            'variant': productData.variant,
                        }]
                    }
                }
            }
        }
    },

    initSaveForLaterEvents: function () {
        var thiz = this;

        $('.js-add-to-cart-from-sfl').click(function () {
            var variantId = $(this).data("variant-id");
            Services.ajaxGETRequestJSON(
                '/ajax/save-for-later/move/cart/' + variantId,
                {},
                function (response) {
                    if(isModuleActive('data_layer')) {
                        window.Main.setImpressionEventOnAjax(response.data_layer);
                    }
                    window.location.reload();
                },
                function (response) {
                    if (response.errors !== undefined) {
                        DKAlert(response.errors[0]);
                    }
                },
                false,
                true
            );
        });

        $('.js-move-all-from-sfl-to-cart').click(function () {
            Services.ajaxGETRequestJSON(
                '/ajax/save-for-later/move/all/cart',
                {},
                function (response) {
                    window.location.reload();
                },
                function (response) {
                    if (response.errors !== undefined) {
                        DKAlert({message: response.errors[0]});
                    }
                },
                false,
                true
            );
        });

        $('.js-move-this-shipping-category-to-card').click(function () {
            var shippingKey = $(this).data("shipping-key");
            Services.ajaxGETRequestJSON(
                '/ajax/save-for-later/move/shipping-category/cart/' + shippingKey + '/',
                {},
                function (response) {
                    if(isModuleActive('data_layer')) {
                        window.Main.setImpressionEventOnAjax(response.data_layer);
                    }
                    window.location.reload();
                },
                function (response) {
                    if (response.errors !== undefined) {
                        DKAlert(response.errors[0]);
                    }
                },
                false,
                true
            );
        });

        $(document).on('click', '.js-add-to-sfl', function () {
            self.deleteTargetId = $(this).data('id');
            self.deleteTargetVariantId = $(this).data('variant');
            self.movedProductId = $(this).data('product');
            Services.ajaxGETRequestJSON(
                '/ajax/cart/move/save-for-later/' + self.deleteTargetVariantId,
                // '/ajax/cart/move/save-for-later/' + self.deleteTargetId + '/' + self.deleteTargetVariantId,
                {},
                function (response) {
                    if(isModuleActive('data_layer')) {
                        window.Main.setImpressionEventOnAjax(response.data_layer);
                    }
                    try {
                        ga('set', 'nonInteraction', true);
                        ga('send', 'event', {
                            eventCategory: 'funnel',
                            eventAction: 'add_to_next_purchase',
                            eventLabel: self.movedProductId
                        });
                    } catch (e) {
                        window.Sentry && window.Sentry.captureException(e);
                        // eslint-disable-next-line no-console
                        console.warn(e);
                    }
                    window.location.reload();
                },
                function (data) {
                    if (data.error !== undefined) {
                        DKAlert(data.error[0]);
                    } else if(data.errors !== undefined) {
                        DKAlert(data.errors);
                    }
                },
                true,
                true
            );
        });

        if($('.js-cart-tab-main').hasClass('u-hidden')) {
            thiz.activeCartTab = 'sfl';
        } else {
            thiz.activeCartTab = 'main';
        }

        var saveForLatertCartContainer = $('.js-cart-tab-sfl'),
            mainCartContainer = $('.js-cart-tab-main');

        $('.js-cart-tab').click(function () {
            var item = $(this),
                newUrl,
                tabType = item.data('type');

            if (tabType === thiz.activeCartTab) {
                return null;
            }

            thiz.activeCartTab = tabType;

            $('.js-cart-tab').removeClass('c-checkout__tab-pill--active');
            item.addClass('c-checkout__tab-pill--active');

            if (tabType === 'main') {
                if (history.pushState) {
                    newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
                    window.history.pushState({path: newUrl}, '', newUrl);
                }

                saveForLatertCartContainer.addClass('u-hidden');
                mainCartContainer.removeClass('u-hidden');
            } else {
                if (history.pushState) {
                    newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=sfl';
                    window.history.pushState({path: newUrl}, '', newUrl);
                }

                saveForLatertCartContainer.removeClass('u-hidden');
                mainCartContainer.addClass('u-hidden');
            }

            Main.getGaListName(null, true);
        });
    },

    initOptionalShipment: function () {
        $(document).on('click', '.js-optional-shipment', function () {
            var $this = $(this);
            DKConfirm(
                'با خرید این کالاها، بقیه کالاهای موجود در سبد خرید شما به “لیست خرید بعدی” منتقل می‌شوند.',
                function () {
                    $this.closest('form').submit();
                },
                function () {
                },
                'تایید و ثبت سفارش',
                'انصراف'
            );
        })
    },

    initErrorViewer: function () {
        var errorToggles = $('.js-checkout-counter-error');
        errorToggles.on('click', function (e) {
            e.stopPropagation();
            e.preventDefault();
            $('body').click();
            var self = $(this);
            self.addClass('is-active');
            setTimeout(function () {
                self.removeClass('is-active');
            }, 5000);
        });

        $('body').on('click', function () {
            errorToggles.removeClass('is-active');
        })
    },

    bindEvents: function () {
        $(document).on('change', '.js-quantity-select select', function () {
            var $this = $(this);
            var quantity = $this.val();
            var variantId = $this.closest('.js-quantity-select').data('variant-id');

            var thiz = this;

            Services.ajaxGETRequestJSON(
                '/cart/change/' + variantId + '/' + quantity,
                {},
                function (response) {
                    $('.js-checkout-aside').html($(response.data).find('.js-checkout-aside').html());
                    $('.js-checkout').html($(response.data).find('.js-checkout').html());
                    $('.js-ui-select').selectric('refresh');
                }, function (response) {
                    $('.js-checkout').html($(response.data).find('.js-checkout').html());
                    $('.js-ui-select').selectric('refresh');
                    if (response.errors !== undefined) {
                        DKAlert(response.errors[0]);
                    }
                },
                false,
                true
            );

            var itemData = enhanced_ecommerce[variantId];

            var gaEvent = quantity > itemData['quantity'] ? "add" : "remove";
            var event = quantity > itemData['quantity'] ? "add to cart" : "remove from cart";
            var eventDescription = quantity > itemData['quantity'] ? "Add from cart page" : "Remove from cart page";

            itemData['quantity'] = quantity;

            var snt_params = {"item": "change-quantity", "item_option": quantity.toString()};
            snt('dkCartPageClick', snt_params, true);

            try {
                ga('ec:addProduct', itemData);
                ga("ec:setAction", gaEvent);

                if (event === "add to cart") {
                    var gaDimensionData = {
                        "page-path": window.decodeURI(document.URL),
                        "referrer-path": window.decodeURI(document.referrer),
                        "user-id": window.userId,
                        "variant-id": variantId,
                        "cart-id": ((typeof (window.cart) == 'undefined') ? "" : window.cart.cartId)
                    };
                    ga('set', 'dimension5', JSON.stringify(gaDimensionData));
                }

                ga("send", 'event', "ecommerce", event, eventDescription);
            } catch (e) {
            }
        });
    },
    initRemoveFromCart: function () {
        $(document).on('click', '.js-remove-from-cart', function (e) {
            e.preventDefault();
            var removeButton = $(this);
            var href = removeButton.attr('href');
            var productId = removeButton.data('product');
            var variantData = removeButton.data('enhanced-ecommerce');
            self.deleteTargetId = removeButton.data('id');
            self.deleteTargetVariantId = removeButton.data('variant');

            DKConfirm('آیا مایل به حذف این کالا هستید؟',
                function () {
                    Services.ajaxGETRequestJSON(
                        '/ajax/cart/move/save-for-later/' + self.deleteTargetVariantId,
                        // '/ajax/cart/move/save-for-later/' + self.deleteTargetId + '/' + self.deleteTargetVariantId,
                        {},
                        function (response) {
                            if(isModuleActive('data_layer')) {
                                window.Main.setImpressionEventOnAjax(response.data_layer);
                            }
                            window.location.reload();
                        },
                        function (data) {
                            if (data.error !== undefined) {
                                DKAlert(data.error[0]);
                            }
                        },
                        true,
                        true
                    );
                },
                function () {
                    var snt_params = {"item": "remove-from-cart", "item_option": null};
                    // SN-Tracker Click Event
                    // snt('dkCartPageClick', snt_params, true);
                    // try {
                    //     // Google Analytics
                    //     ga('ec:addProduct', variantData);
                    //     ga("ec:setAction", 'remove');
                    //     ga("send", 'event', "ecommerce", "remove from cart", "remove from cart page");
                    // } catch (e) {
                    // }
                    if(isModuleActive('data_layer')) {
                        IndexAction.setGARemoveFromCartImpressionEvent(productId)
                    }
                    document.location = href;
                },
                'انتقال به لیست خرید بعدی',
                'حذف'
            );
        });
    },

    initRemoveFromSave: function () {
        var $save = $('.js-remove-from-save');
        $save.on('click', function () {
            var thiz = this;
            var variantId = $(this).data("variant-id");
            var productId = $(this).data("product-id");

            DKConfirm('آیا مایل به حذف این کالا هستید؟', function () {
                var csrf = $(this).data('token');

                Services.ajaxPOSTRequestJSON(
                    '/ajax/save-for-later/variant/remove/' + variantId,
                    {token: csrf},
                    function (response) {
                    //     try {
                    //         ga('set', 'nonInteraction', true);
                    //         ga('send', 'event', {
                    //             eventCategory: 'funnel',
                    //             eventAction: 'remove_from_next_purchase',
                    //             eventLabel: productId
                    //         });
                    //     } catch (e) {
                    //         console.log("ga event problem : " + e.toString());
                    //     }
                    //     $(thiz).closest('.js-sfl-cart-fade').fadeOut(300);
                    //     window.location.reload();
                    },
                    function (response) {
                        if (response.errors !== undefined) {
                            DKAlert({message: response.errors[0]});
                        }
                    },
                    false,
                    true
                );
            });
        });
    },

    getSimilarProducts: function () {
        var sameProductModal = $("[data-remodal-id=sameProduct]").remodal();

        $(".js-same-product-modal").click(function () {
            var $this = $(this),
                productId = $this.data('product'),
                variantId = $this.data('variant'),
                cartItemId = $this.data('id'),
                isFromSfl = !!$this.data('is-from-sfl');

            Services.ajaxGETRequestHTML(
                '/ajax/browsing-history/product/show-similar/' + productId + '/' + variantId + '/',
                {},
                function (res) {

                    $('.js-related-product-container').html(res);

                    sameProductModal.open();

                    if(isFromSfl) {
                        $('.js-add-to-sfl-button').addClass('u-hidden');
                    } else {
                        $('.js-add-to-sfl-button')
                            .attr('data-id', cartItemId)
                            .attr('data-product', productId)
                            .attr('data-variant', variantId);
                    }

                    $('.js-remove-item-user-history').addClass('u-hidden')

                    new window.Swiper(
                        ".js-swiper-same-products",
                        {
                            slidesPerView: 4,
                            slidesPerGroup: 3,
                            lazy: {
                                enabled: true
                            },
                            navigation: {
                                nextEl: ".js-swiper-button-next",
                                prevEl: ".js-swiper-button-prev"
                            },
                            keyboard: {
                                enabled: true,
                                onlyInViewport: true
                            }
                        }
                    );
                },
                function () {
                },
                true,
                true
            );
        });
    },

    initSelects: function () {
        $('.js-ui-select').selectric();
    },
    initPreOrderModal: function () {

    },
    initFailedAddToCart: function () {
        if (typeof failedAddToCartVariant === 'undefined') {
            return;
        }

        DKConfirm('امکان خرید هم زمان کالاهای پیش فروش با سایر کالاها وجود ندارد. برای ادامه ثبت سفارش نیاز است که سبد خرید خالی شود', function () {
            Services.ajaxGETRequestJSON(
                '/ajax/cart/empty/',
                {},
                function () {
                    location.href = '/cart/add/' + failedAddToCartVariant + '/';
                },
                function (data) {
                    if (data.error !== undefined) {
                        DKAlert(data.error[0]);
                    }
                },
                false,
                true
            );
        }, null, 'تایید و ادامه', 'انصراف');
    },

    initPageNavigation: function () {
        window.addEventListener("pageshow", function (event) {
            var historyTraversal = event.persisted ||
                (typeof window.performance !== typeof undefined &&
                    window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD);
            if (historyTraversal) {
                $('.js-notice.error').hide();
            }
        });
    },

    initDuplicateOrderItemPopup: function () {
        if ($('[data-remodal-id=duplicate-order-item]').length === 0) {
            return;
        }

        var duplicateOrderItemModal = $('[data-remodal-id=duplicate-order-item]').remodal({
            closeOnEscape: false,
            closeOnOutsideClick: false
        });
        duplicateOrderItemModal.open();
    },

    changeItemQuantity: function (itemData) {
        var self = this;
        Services.ajaxGETRequestJSON(
            '/cart/change/' + itemData.variantId + '/' + itemData.count,
            {},
            function (response) {
                if(isModuleActive('data_layer')) {
                    window.Main.setImpressionEventOnAjax(response.data_layer);
                }
                $('.js-checkout-aside').html($(response.data).find('.js-checkout-aside').html());
                $('.js-checkout').html($(response.data).find('.js-checkout').html());
                $('.js-ui-select').selectric('refresh');
                $("#mini-cart").html(response.miniCartData);
                self.initSideBarRecommendation();
            }, function (response) {
                $('.js-checkout').html($(response.data).find('.js-checkout').html());
                $('.js-ui-select').selectric('refresh');
                if (response.errors !== undefined) {
                    DKAlert(response.errors[0]);
                }
            },
            false,
            true
        );
    },

    getQuantityData: function (thiz) {
        var $countDiv = thiz.closest('.c-quantity-selector').find('.js-quantity-selector-count');

        return {
            variantId: $countDiv.data('id'),
            count: Number(Services.convertToEnDigit($countDiv.text())),
        };
    },

    initQuantitySelector: function () {
        var thiz = this;

        $(document).on('click', '.js-quantity-selector-add', function () {
            var $this = $(this);
            if(isModuleActive('change_disclaimer') && ($this.parents('.c-cart-item__price-row').siblings('.c-cart-item__price-row').children().children('.js-product-warehouse-stock').length)){
                var disclaimerModal = $('.js-disclaimer-modal').remodal();
                disclaimerModal.open();

                $('.js-add-and-disclaimer').on('click', function () {
                    var itemData = thiz.getQuantityData($this);
                    itemData.count += 1;
                    thiz.changeItemQuantity(itemData);
                    disclaimerModal.close();
                });

                $('.js-close-disclaimer').on('click', function () {
                    disclaimerModal.close();
                })
            } else {
                var itemData = thiz.getQuantityData($this);
                itemData.count += 1;
                thiz.changeItemQuantity(itemData);
            }
        });

        $(document).on('click', '.js-quantity-selector-remove', function () {
            var $this = $(this);
            var itemData = thiz.getQuantityData($this);
            itemData.count -= 1;
            thiz.changeItemQuantity(itemData);
        });
    },
    initAddItemCart: function() {
        $('.js-add-item-cart-close').on('click', function(){
            $(this).closest('.c-add-item-cart').hide();
        });
    },
    initShipmentTypeEvents: function() {
        setTimeout(function(){
            var checkoutGroup = $('.js-checkout .c-checkout__group');
                isMultiShipment = (checkoutGroup.length > 1),
                shipmentType = isMultiShipment ? "Multi Shipment" : "Single Shipment",
                shipmentCode = '';

            checkoutGroup.each(function(){
                shipmentCode = (shipmentCode === '') ?
                    $(this).find('.c-checkout__header').data('shipment-type') : shipmentCode + ', ' + $(this).find('.c-checkout__header').data('shipment-type');
            });

            // try {
            //     ga('set', 'nonInteraction', true);
            //     ga('send', 'event', {
            //         eventCategory: 'Cart Page',
            //         eventAction: shipmentType,
            //         eventLabel: shipmentCode,
            //     });
            // } catch (e) {
            //     console.warn(e);
            // }
        }, 1000);
    },

    handleGAClick: function (productId) {
        try {
            var productData = Services.retrieveProductFromDataLayer({
                productId: productId,
                eventName: 'eec.productImpression',
                pathArray: ['ecommerce', 'impressions']
            });
            var impressionObject = createImpressionObj(productData);

            window.dataLayer.push(impressionObject);
        } catch (e) {
            window.Sentry && window.Sentry.captureException(e);
            // eslint-disable-next-line no-console
            console.warn(e);
        }

        function createImpressionObj(productObject) {
            var productObjectCopy = Object.assign({}, productObject),
                list = Main.gaListName;

            delete productObjectCopy.list;

            return  {
                'event': 'eec.impressionClick',
                'ecommerce': {
                    'click': {
                        'actionField': {
                            'list': list
                        },
                        'products': [productObjectCopy]
                    }
                }
            }
        }
    },

    initSaveForLaterCardClick: function () {
        var thiz = this;
        $('.js-save-for-later-card').on('click', function () {
            var productId = $(this).data("product-id");
            thiz.handleGAClick(productId);
        });
    }
};

$(function () {
    IndexAction.init();
});
