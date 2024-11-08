//  breadcrumb
$(document).on('click', ".remove-breadcrumb", function(e) {
    var cat_id = $(this).attr('data-cat-id');
    $("input[type='radio']").removeAttr('checked');
    $(".c-content-categories__item").removeClass('is-active');

    $("#categoryStepNext").addClass('disabled');
    $("li[data-cat-id=" + cat_id + "]").remove();
    $("input:text[value=" + cat_id + "]").remove();

    if($(document).find('.category_group').length == 0){
        var hidden_input = '<input type="text" name="category_group" class="category_group" id="hidden_cat_group" style="visibility: hidden">';
        $("#top-fields").append(hidden_input);
    }
});


//  ریلود دسته‌بندی وقتی دکمه امتخاب دسته کلیک میشه
$(document).on('click', "#categoryStepNext", function(e) {
    $(this).addClass('disabled');
    $("#hidden_cat_group-error").remove();

    $("input[type='radio']").removeAttr('checked');
    $(".c-content-categories__item").removeClass('is-active');

    // ای دی دسته ای که انتخاب شده
    var cat_id = $("input[name='category']:checked").attr('data-cat-id');
    var li_id = $("li[data-cat-id=" + cat_id + "]").attr('data-cat-id');

    var cat_lable = $("label[data-cat-id=" + cat_id + "]").text();

    var li = '<li class="select2-selection__choice" data-cat-id="' + cat_id + '" style="background: #889098;color: #ffffff;height: 25px;border-radius: 33px;font-size: 12px;padding: 5px 11px 0px 11px;margin-left: 5px;">';
    li += '<span class="select2-selection__choice__remove" role="presentation">' +  cat_lable + '</span>';
    li += '<a class="select2-selection__choice__remove remove-breadcrumb" data-cat-id="' + cat_id + '" role="presentation" style="margin-right: 5px; font-weight: bold; padding-right: 2px; color: white;">×</a> </li>';

    var input = '<input type="text" name="category_group" class="category_group" value="' + cat_id + '"  style="visibility: hidden">';

    if(cat_id !== li_id){
        if($("#hidden_cat_group")) {
            $("#hidden_cat_group").remove();
        }
        $("#breadcrumbs").append(li);
        $("#top-fields").append(input);
    }

});

// تابع نمایش فایل آپلود شده
var loadFile = function(event) {
    var output = document.getElementById('preview_uploading');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
};

// تابع تبدیل بایت
function formatBytes(bytes, decimals = 0) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

// // نمایش حجم عکس و نام عکس در فرانت
$(document).on("change", "#uploadImage", function () {
    $('.js-upload-size').text(formatBytes(this.files[0].size));
    var filename = $("#uploadImage").val().split('\\').pop();
    $('.js-upload-name').text(filename);
});

// وقتی کلیک شد رو اسم دسته‌بندی اون هاور بشه
$(document).on('click', "input[name='category']", function (e) {
    $(this).closest("div").nextAll().remove();
    $("li").removeClass('is-active');
    $(this).closest("li").addClass("is-active");

    $("#categoryStepNext").removeClass('disabled');
});

// تغییر پدینگ فیلد نامک
var buttonWidth = $('#button-urls').width() + 20;
$(".url-inputs").css({
    'padding-left': buttonWidth
});
$("form").removeClass('c-grid__row');
