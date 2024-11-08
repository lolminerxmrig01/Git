/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/controllers/accountController/changePasswordAction.js]*/
var ChangePasswordAction = {
    init: function () {
        this.initChangePasswordForm();
    },

    initChangePasswordForm : function () {
        $(function () {
            const $status = $('#status');
            if ($status.text().trim() === '1') {
                window.UIkit.notification('تغییر کلمه عبور با موفقیت انجام شد', {
                    status: 'success',
                    pos: 'bottom-right',
                    timeout: 5000
                });
            } else if ($status.text().trim()=== '-1') {
                $('#changepassword\\5b password_old\\5d -error').hide();
                window.UIkit.notification('تغییر کلمه عبور انجام نشد ، لطفا مجددا تلاش نمایید', {
                    status: 'danger',
                    pos: 'bottom-right',
                    timeout: 5000
                });
            }
        });

        let $form = $('#changePasswordForm');

        $('#btnSubmit').click(function () {
             $form.submit();
        });

        $form.find('input').first().focus();

        $form.validate({
            rules : {
                'changepassword[password_old]' : {
                    required : true,
                    minlength : 4,
                    maxlength : 255
                },
                'changepassword[password]' : {
                    required : true,
                    minlength : 4,
                    maxlength : 255
                },
                'changepassword[password2]' : {
                    required : true,
                    minlength : 4,
                    maxlength : 255,
                    equalTo: "#txtPassword"
                }
            },
            messages : {
                'changepassword[password_old]' : {
                    'required' : 'فیلد کلمه عبور فعلی خالی است',
                    'minlength' : 'کلمه عبور فعلی بسیار کوتاه است',
                    'maxlength' : 'form.general.password_old.validation.toolong'
                },
                'changepassword[password]' : {
                    'required' : 'فیلد کلمه عبور جدید خالی است',
                    'minlength' : 'کلمه عبور جدید بسیار کوتاه است',
                    'maxlength' : 'کلمه عبور جدید بسیار بلند است'
                },
                'changepassword[password2]' : {
                    'required' : 'فیلد تکرار کلمه عبور جدید خالی است',
                    'minlength' : 'تکرار کلمه عبور جدید بسیار کوتاه است',
                    'maxlength' : 'تکرار کلمه عبور جدید بسیار بلند است',
                    'equalTo' :  'کلمه عبور جدید با تکرار کلمه عبور یکسان نیست'
                }
            }
        }).showBackendErrors();
    },
};

$(function () {
    ChangePasswordAction.init();
});