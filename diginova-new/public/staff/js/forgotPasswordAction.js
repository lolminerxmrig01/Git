/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/controllers/accountController/forgotPasswordAction.js]*/
var forgotPasswordAction = {
    init: function () {
        this.initForgotForm();
    },

    initForgotForm: function () {
        const $form = $('#forgot-form');

        if (!$form.length) {
            return;
        }

        $('#btnSubmit').click(function () {
            $form.submit();
        });

        $form.find('input').first().focus();

        $form.validate({
            rules: {
                'email': {
                    required: true,
                    email: true,
                    maxlength: 255
                }
            },
            messages: {
                'email': {
                    'required': 'وارد نمودن ایمیل اجباری است',
                    'email': 'آدرس ایمیل صحیح نمی‌باشد',
                    'maxlength': 'form.general.email.validation.toolong'
                }
            }
        }).showBackendErrors();
    },
};

$(function () {
    forgotPasswordAction.init();
});
