/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/econtract.js]*/
var ContractAction = {
    init: function initMain()
    {
        if (window.isModuleActive('marketplace_electronic_contract')) {
            this.initNewElectronicContractModalNotification();
        }
    },

    initNewElectronicContractModalNotification: function () {
        let $econtractModal,
            $form,
            postponeContract,
            approveContract,
            rejectContract,
            $postponeContractBtn,
            $rejectContractBtn,
            $approveContractBtn;
        /** @var isLoggedSeller */
        /** @var existNewElectronicContract */
        /** @var isContractRejected */
        /** @var hasAccessToContract */
        const approvedContractPopup = document.querySelector('#new-electronic-contract-approved');

        if (approvedContractPopup) {
            const $approvedContractPopup = $(approvedContractPopup);
            UIkit.modal($approvedContractPopup).show();
            const closeApprovedModal = approvedContractPopup.querySelector('.js-close-approved-econtract');

            $(closeApprovedModal).on('click', function () {
                UIkit.modal($approvedContractPopup).hide();
            });
            return;
        }

        const isElectronicContractExists = (!Services.checkCookie('new-electronic-contract-3month-notify') && window.isContractRejected) ||
            (!Services.checkCookie('new-electronic-contract-7days-notify') && window.existNewElectronicContract);
        if (Services.checkUserLogged() && (window.existNewElectronicContract || window.isContractRejected)) {
            $econtractModal = $(document.querySelector('#new-electronic-contract'));
            if (!$econtractModal.length || !window.hasAccessToContract) {
                $(document.querySelector('#review-contract-btn')).on('click', function (e) {
                    e.preventDefault();
                    Services.commonModalNotification(
                        '<span class="c-modal-notification__danger-text">توجه!</span>',
                        'دسترسی پنل شما محدود شده است. در صورت نیاز به اطلاعات بیشتر با واحد پشتیبانی فروشندگان تماس بگیرید.',
                        false,
                        [
                            {
                                text: 'متوجه شدم',
                                url: location.href.replace(location.hash,"")
                            }
                        ]
                    );
                });
                return;
            }

            $form = $econtractModal.find('form');
            postponeContract = $econtractModal[0].querySelector('[name="action"][value="decide_later"]');
            approveContract = $econtractModal[0].querySelector('[name="action"][value="confirm"]');
            rejectContract = $econtractModal[0].querySelector('[name="action"][value="reject"]');

            $postponeContractBtn = $econtractModal.find('button.js-postpone-contract:not(.uk-close)');
            $rejectContractBtn = $econtractModal.find('button.js-reject-contract');
            $approveContractBtn = $econtractModal.find('.js-approve-contract');

            $('.js-reject-contract').on('click', rejectElectronicContract);
            $('.js-postpone-contract').on('click', postponeElectronicContract);

            $(approveContract).on('change', checkContractAgreement);
            $(rejectContract).on('change', checkContractAgreement);
            $(postponeContract).on('change', checkContractAgreement);

            if (isElectronicContractExists) {
                approveEcontract();
            }

            $(document.querySelector('#review-contract-btn')).on('click', function (e) {
                e.preventDefault();
                approveEcontract();
            });

            $approveContractBtn.on('click', submitContractForm);
            $postponeContractBtn.on('click', postponeElectronicContract);
        } else {

        }

        function submitContractForm(e)
        {
            e.preventDefault();

            $form.submit();
        }

        function checkContractAgreement()
        {
            const isUserAgree = approveContract.checked;
            const isPostpone = !window.existNewElectronicContract && window.isContractRejected ? false : postponeContract.checked;

            if (isUserAgree) {
                $rejectContractBtn.addClass('uk-hidden');
                $postponeContractBtn.addClass('uk-hidden');
                $approveContractBtn.removeClass('uk-hidden');
                $approveContractBtn.prop('disabled', false);
            } else if (isPostpone) {
                $rejectContractBtn.addClass('uk-hidden');
                $postponeContractBtn.removeClass('uk-hidden');
                $approveContractBtn.addClass('uk-hidden');
            } else {
                $rejectContractBtn.removeClass('uk-hidden');
                $postponeContractBtn.addClass('uk-hidden');
                $approveContractBtn.addClass('uk-hidden');
            }
        }

        function approveEcontract()
        {
            const $loader = $econtractModal.find('.c-card__loading');
            const $contractContainer = $econtractModal.find('#econtract-content');

            $rejectContractBtn.addClass('uk-hidden');
            $approveContractBtn.removeClass('uk-hidden');
            $postponeContractBtn.addClass('uk-hidden');
            $contractContainer.removeClass('scrolled');
            $approveContractBtn.prop('disabled', true);
            approveContract.disabled = true;
            checkTooltip(approveContract.closest('.c-ui-tooltip__anchor'), true);

            /** @var UIkit.modal */
            $loader.addClass('is-active');
            UIkit.modal($econtractModal).show();

            $contractContainer.html('');
            Services.ajaxGETRequestHTML(
                '/ajax/profile/new/contract-content/',
                null,
                function (data) {
                    $loader.removeClass('is-active');
                    $contractContainer.html(data);

                    $contractContainer.on('scroll', checkContractView);
                },
                true,
                false
            );
        }

        function checkContractView()
        {
            const $this = $(this);

            if (!$this.hasClass('scrolled')) {
                const gaps = parseInt($this.css('padding-top')) + parseInt($this.css('padding-bottom'));
                const SAFE_EXTRA_GAP = 20;

                if ($this.scrollTop() + $this.height() >= $this[0].scrollHeight - gaps - SAFE_EXTRA_GAP) {
                    $this.addClass('scrolled');
                    $this.off('scroll', checkContractView);
                    approveContract.disabled = false;

                    checkTooltip(approveContract.closest('.c-ui-tooltip__anchor'), false);
                }
            }
        }

        function rejectElectronicContract(e)
        {
            e.preventDefault();

            UIkit.modal($econtractModal).hide();
            Services.commonModalNotification(
                '<span class="c-modal-notification__danger-text">توجه!</span>',
                'فروشنده عزیز، عدم موافقت شما با شرایط همکاری به منزله تمایل شما به خاتمه همکاری تلقی شده و دسترسی شما به پنل فروشندگان محدود خواهد شد.<br> در این حالت تمامی تنوع‌های کالایی غیرفعال شده و امکان اضافه و فعال کردن تنوع وجود ندارد، اما شما همچنان قادر به مشاهده و ارسال سفارشات خود هستید. از آنجا که مبلغ فروش سفارشات موجود در پنل در صورت ارسال سفارش در محاسبات پرداختی شما لحاظ خواهد شد، پس لطفا در اسرع وقت جهت ارسال سفارشات خود اقدام فرمایید.<br> کلیه پرداختی های شما مطابق با شرایط کنونی قرارداد پرداخت خواهد شد.<br> در صورت موافقت با این شرایط روی دکمه ثبت کلیک کنید و یا با کلیک روی دکمه بازگشت به صفحه قبل برگردید.',
                false,
                [
                    {
                        text: 'ثبت',
                        classes: ['secondary'],
                        cb: confirmRejectElectronicContract
                    },
                    {
                        text: 'بازگشت',
                        cb: approveEcontract
                    }
                ]
            );
        }

        function postponeElectronicContract(e)
        {
            e.preventDefault();
            /** @var contractDaysLeft */
            UIkit.modal($econtractModal).hide();
            Services.commonModalNotification(
                '<span class="c-modal-notification__danger-text">توجه!</span>',
                'فروشنده عزیز، شما «{0} روز» فرصت دارید تا در مورد رد یا پذیرش شرایط همکاری تصمیم‌گیری نمایید. طی این مدت، پنل شما بدون محدودیت مطابق قبل در دسترس شما خواهد بود.<br> در صورتی که پس از پایان این مدت، اقدامی از جانب شما جهت رد یا قبول شرایط همکاری صورت نگرفت، این امر به منزله فسخ و خاتمه قرارداد تلقی و دسترسی شما به پنل محدود خواهد شد. در طی این مدت، پیغام مربوط به رد یا قبول شرایط همکاری هر ۶ ساعت یکبار در زمان ورود شما به پنل، نمایش داده خواهد شد.'.replace('{0}', window.contractDaysLeft),
                false,
                [
                    {
                        text: 'متوجه شدم',
                        cb: postponeContractApproval
                    }
                ]
            );
        }

        function confirmRejectElectronicContract(e)
        {
            e.preventDefault();

            if (!approveContract.checked) {
                Services.setCookie('new-electronic-contract-3month-notify', 1, 1);
            }

            $form.submit();
        }

        function postponeContractApproval(e)
        {
            e.preventDefault();

            Services.setCookie('new-electronic-contract-7days-notify', 1, 0.25);
            $form.submit();
        }

        function checkTooltip(el, isDisabled)
        {
            if (!el) {
                return;
            }

            const $el = $(el);
            const elTooltipText = $el.data('ui-back-tooltip') || $el.data('ui-tooltip');

            if (elTooltipText) {
                if (!isDisabled) {
                    $el.removeAttr('data-ui-tooltip');
                    $el.data('ui-back-tooltip', elTooltipText);
                } else {
                    $el.removeData('ui-back-tooltip');
                    $el.attr('data-ui-tooltip', elTooltipText);
                }
            }
        }
    },

};

$(function () {
    ContractAction.init();
});
