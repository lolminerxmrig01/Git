/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/controllers/accountController/changePasswordEmailAction.js]*/
let changePasswordEmailAction = {
    init: function () {
        this.initChangePasswordForm();
    },

    initChangePasswordForm: function () {
        const $form = $('#changePasswordForm');

        $('#btnSubmit').click(function () {
            $form.submit();
        });

        $form.find('input').first().focus();

        $form.validate({
            rules: {
                'password': {
                    required: true,
                    minlength: 4,
                    maxlength: 255
                },
                'password_confirmation': {
                    required: true,
                    minlength: 4,
                    maxlength: 255,
                    equalTo: "#txtPassword"
                }
            },
            messages: {
                'password': {
                    'required': 'وارد کردن رمز عبور اجباری می‌باشد',
                    'minlength': 'طول رمز عبور کوتاه است',
                    'maxlength': 'کلمه عبور فعلی بسیار بلند است'
                },
                'password_confirmation': {
                    'required': 'وارد کردن رمز عبور اجباری می‌باشد',
                    'minlength': 'طول رمز عبور کوتاه است',
                    'maxlength': 'کلمه عبور فعلی بسیار بلند است',
                    'equalTo':  'رمز عبور های وارد شده یکسان نمی‌باشد.'
                }
            }
        }).showBackendErrors();
    }
};

$(function () {
    changePasswordEmailAction.init();
});
