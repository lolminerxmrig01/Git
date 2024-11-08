var CategoryFormAction = {
    init: function () {
        this.initForgotForm();
    },

    initForgotForm: function () {
        const $form = $('#warranty_form');

        if (!$form.length) {
            return;
        }

        $form.find('input').first().focus();

        $form.validate({
            rules: {
                'name': {
                    required: true,
                },

                // 'time': {
                    // required: true,
                    // regex: '^[0-9]{6}-[0-9]{4}$',
                // },
            },
            messages: {
                'name': {
                    'required': 'وارد نمودن نام گارانتی اجباری است',
                },
                'time': {
                    'required': 'وارد نمودن مدت زمان به صورت عددی اجباری است',
                },
            },
            // ignore: [],

            // errorPlacement: function (error, element) {
            //     if (element.attr("name") == "name" || element.attr("name") == "time"){
            //         error.insertAfter(element).addClass('error-msg');
            //     }
            //     else if(element.attr("name") == "category_group"){
            //         error.appendTo(".js-selected-category").addClass('error-text');
            //     }
            // },
        }).showBackendErrors();
    },
};

$(function () {
    CategoryFormAction.init();
});
