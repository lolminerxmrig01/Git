/*[PATH @digikala/supernova-digikala-desktop/assets/local/js/controllers/accountController/rememberPasswordAction.js]*/
var rememberPasswordAction = {

    init: function () {
        this.initRememberForm();
    },

    initRememberForm: function () {

        var $form = $('#rememberForm');

        if (!$form.length) {
            return;
        }

        $('#btnSubmit').click(function (e) {
            e.preventDefault();
            $form.submit();
        });

        $form.find('input').first().focus();

        $form.validate({
            rules: {
                'email_phone': {
                    required: true,
                    email_phone: true,
                    maxlength: 255
                },
                'remember[captcha]': {
                    required: true
                }
            },
            messages: {
                'email_phone': {
                    'required': 'ایمیل یا شماره موبایل را وارد نمایید',
                    'email_phone': 'ایمیل یا شماره موبایل نامعتبر است',
                    'maxlength': 'ایمیل طولانی است'
                },
                'remember[captcha]': {
                    'required': 'حاصل عبارت وارد نشده است'
                }
            }
        }).showBackendErrors();
    },
};

$(function () {
    rememberPasswordAction.init();
});
