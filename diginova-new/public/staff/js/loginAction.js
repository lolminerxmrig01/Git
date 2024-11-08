/*[PATH @digikala/supernova-digikala-desktop/assets/local/js/controllers/accountController/loginAction.js]*/
var LoginAction = {
    init: function () {
      this.initLoginForm();

      if (isModuleActive('new_login')) {
        this.initLoginError();
      }
    },

    initLoginForm: function () {
      var $form = $('#loginForm');
      setTimeout(function () {
        $form.find('input').first().focus();
      }, 100)

      $form.validate({
        rules: {
          'email_phone': {
            required: true,
            email_phone: true,
            maxlength: 255
          },
          'login[password]': {
            required: true,
            minlength: 4,
            maxlength: 50
          }
        },
        messages: {
          'email_phone': {
            'required': 'ایمیل یا شماره موبایل را وارد نمایید',
            'email_phone': 'ایمیل یا شماره موبایل نامعتبر است',
            'maxlength': 'ایمیل طولانی است'
          },
          'login[password]': {
            'required': 'رمز عبور را وارد نمایید',
            'minlength': 'رمز عبور باید بیش از ۶ حرف یا عدد باشد',
            'maxlength': 'رمز عبور وارد شده طولانی است'
          }
        }
      });

      if (!isModuleActive('new_login')) {
        $form.find('button').on('click', function (e) {
          e.preventDefault();
          e.stopPropagation();
          $form.submit();
        });
      }
    },

    initLoginError: function () {
      var $errorContainer = $('.js-invalid-login-message');
      if (!!$errorContainer.data('invalid')) {
        window.DKToast($errorContainer.text());
      } else if (window.invalidLoginMessage) {
        window.DKToast(window.invalidLoginMessage);
      }
    },
  };

  $(function () {
    LoginAction.init();
  });
