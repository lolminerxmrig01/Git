/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/controllers/registerController/indexAction.js]*/
const RegistrationAction = {
    init: function () {
        this.initNewEmailForm();
        this.initPasswordTypeSwitcher();

        if (window.isModuleActive('marketplace_google_authorization')) {
            this.initGoogleSignUp();
        }
    },

    initNewEmailForm : function () {
        const $form = $('#email-form');

        $('#btnSubmit').click(function () {
            $form.submit();
        });

        $form.find('input').first().focus();

        $form.validate({
            rules : {
                'email' : {
                    required : true,
                    email : true,
                    maxlength : 255
                },
                'password' : {
                    required : true,
                    minlength: 4,
                    maxlength : 255
                },
                'register_phone': {
                    required: true,
                    validate_persian_and_english_digits: true,
                    minlength: 11,
                    maxlength: 11,
                    mobile_phone: true
                    // unique_phone: true,
                }
            },
            messages : {
                'email' : {
                    'required' : 'وارد نمودن ایمیل اجباری است',
                    'email' : 'آدرس ایمیل صحیح نمی‌باشد',
                    'maxlength' : 'form.general.email.validation.toolong'
                },
                'password' : {
                    'required' : 'وارد کردن رمز عبور اجباری می‌باشد',
                    'minlength' : 'طول رمز عبور کوتاه است',
                    'maxlength' : 'کلمه عبور فعلی بسیار بلند است'
                },
                'register_phone': {
                    required: 'وارد نمودن مقدار شماره موبایل اجباری است',
                    validate_persian_and_english_digits: 'لطفا اعداد انگلیسی وارد نمایید',
                    minlength: 'شماره همراه باید با ۰۹ شروع شود و ۱۱ رقم باشد',
                    maxlength: 'شماره همراه باید با ۰۹ شروع شود و ۱۱ رقم باشد',
                    mobile_phone: 'شماره همراه باید با 09 شروع شود و 11 رقم باشد',
                },
            }
        }).showBackendErrors();
    },

    initPasswordTypeSwitcher : function () {
        $('.c-ui-input__btn--password').on('click', function () {
            const $input = $(this).siblings('input');
            $input.prop('type', $input.prop('type') === 'password' ? 'text' : 'password');
        });
    },

    initGoogleSignUp: function () {
        const googleBtn = document.querySelector('#google-auth');
        let form = document.getElementById('google-form');
        let input = document.getElementById('google-user-id');

        let startApp = function () {
            gapi.load('auth2', function() {
                auth2 = gapi.auth2.init({
                    client_id: form.dataset.api,
                    scope: 'profile'
                });

                attachSignin(document.getElementById('google-auth'));
            });
        };

        function attachSignin(element) {
            auth2.attachClickHandler(
                element,
                {},
                function (googleUser) {
                    let id = googleUser.getAuthResponse().id_token;
                    input.value = id;
                    form.submit();
                }, function(error) {
                    alert(JSON.stringify(error, undefined, 2));
                }
            );
        }

        startApp();

        googleBtn.addEventListener('click', function loginByGoogle(e)
        {
            e.preventDefault();
        });
    }
};

$(function () {
    RegistrationAction.init();
});
