/*[PATH @digikala/supernova-digikala-desktop/assets/local/js/controllers/accountController/otpAction.js]*/
var OtpAction = {
    init: function () {
        this.initForm();
        this.initCounter();
        this.handleResendOtp();

        if(isModuleActive('new_login')) {
            this.initLoginError();
        }
    },

    initForm: function () {
        var $form = $('#authForm');

        setTimeout(function () {
            $form.find('input').first().focus();
        }, 500)

        $('input[name="code"]').on('keyup', function (e){
            if(e.target.value.length === 5) {
                $form.submit();
            }
        });

        $form.validate({
            rules: {
                'code': {
                    required: true,
                    maxlength: 5,
                    minlength: 5,
                },
                'password': {
                    required: true,
                    minlength: 4,
                    maxlength: 50
                }
            },
            messages: {
                'code': {
                    'required' : 'کد را وارد نمایید',
                    'minlength' : 'کد را کامل وارد نمایید',
                    'maxlength' : 'کد طولانی است'
                },
                'password': {
                    'required': 'رمز عبور را وارد نمایید',
                    'minlength': 'رمز عبور باید بیش از ۶ حرف یا عدد باشد',
                    'maxlength': 'رمز عبور وارد شده طولانی است'
                }
            }
        });
    },

    handleResendOtp: function() {
        var self = this;

        $('.js-send-otp-confirm-code').click(function () {
            var url,
                $form = $('#authForm'),
                $this = $(this),
                mode = $this.data('mode');

            if(mode === 'login') {
                url = '/ajax/users/login-with-otp/send-confirm-code/';
            } else {
                url = '/ajax/users/register/send-confirm-code/';
            }

            window.Services.ajaxPOSTRequestJSON(
                url,
                {
                    phone_number: $form.data('phone-number') + '',
                },
                function (data) {
                    $('.js-phone-code-counter').data('countdownseconds', data.phoneCodeTtl);
                    $('.js-send-otp-confirm-code').addClass('u-hidden');
                    $('.js-phone-code-container').removeClass('u-hidden');
                    self.initCounter();
                },
                function (data) {
                    console.log(data);
                },
                false,
                true
            );
        });
    },

    initCounter: function () {
        var $counter = $('.js-phone-code-counter');

        $counter.countdown('destroy');
        var seconds = $counter.data('countdownseconds'),
            now;

        now = new Date();
        now.setSeconds(now.getSeconds() + seconds);

        if (!now) return;

        $counter.countdown({
            date: now,
            hoursOnly: true,
            rtlTemplate: '%i:%s',
            template: '%i:%s',
            leadingZero: true,
            onComplete: function () {
                $('.js-send-otp-confirm-code').removeClass('u-hidden');
                $('.js-phone-code-container').addClass('u-hidden');
            }
        });
    },

    initLoginError: function () {
        if(window.invalidLoginMessage) {
            window.DKToast(window.invalidLoginMessage);
        }
    },
};

$(function () {
    OtpAction.init();
});
