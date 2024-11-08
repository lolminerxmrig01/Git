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


function TextAbstract(text, length) {
    text = text.replace(/\s\s+/g, '');

    if (text == null) {
        return "";
    }
    if (text.length <= length) {
        return text;
    }
    text = text.substring(0, length);
    // last = text.lastIndexOf(" ");
    // text = text.substring(0, last);
    return text + "...";
}

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

    if ($('.select2-selection__choice').length > 5) {
        var cat_lable = TextAbstract(cat_lable, 8);
        $(".select2-selection__choice__remove").each(function (){
            var value = $(this).html();
            $(this).html(TextAbstract(value, 8));
        });
    }

    if ($('.select2-selection__choice').length > 8) {
        var cat_lable = TextAbstract(cat_lable, 5);
        $(".select2-selection__choice__remove").each(function (){
            var value = $(this).html();
            $(this).html(TextAbstract(value, 5));
        });
    }



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


// وقتی کلیک شد رو اسم دسته‌بندی اون هاور بشه
$(document).on('click', "input[name='category']", function (e) {
    $(this).closest("div").nextAll().remove();
    $("li").removeClass('is-active');
    $(this).closest("li").addClass("is-active");

    $("#categoryStepNext").removeClass('disabled');
});

