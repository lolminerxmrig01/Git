@extends('layouts.staff.master')
@section('title') مدیریت دیدگاه ها | {{ $fa_store_name }}  @endsection
@section('head')
<link rel="stylesheet" href="{{ asset('mehdi/staff/css/tagify.css') }}">
<script src="{{ asset('mehdi/staff/js/jQuery.tagify.min.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/tagify.min.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/ratingAction.js') }}"></script>
<script src="{{ asset('mehdi/staff/js/jalali-moment.browser.js') }}"></script>
<style>
    tags {
        background: white;
        border-color: #e6e9ed!important;
    }

    .tagify .tagify__tag {
        background-color: #ebedf3;
        display: -webkit-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        padding: 0 .5rem !!important;
        border-radius: .42rem !important;
    }

    .select2-search--dropdown {
        display: none !important;
    }
</style>
@endsection
@section('content')
    <main class="c-main">
        <div class="uk-container uk-container-large">
            <div class="c-grid">
                <div class="c-grid__row">
                    <div class="c-grid__col">
                        <div class="c-card c-card--transparent c-ui--my-5">
                            <h1 class="c-card__title c-card__title--dark c-card__title--desc">
                                جزییات امتیاز محصول
                                <span>در این بخش می‌توانید جزییات امتیاز و نظرات مربوط به کالای خود را ببینید.</span>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="c-grid__row">
                    <div class="c-grid__col">
                        <div class="c-card">
                            <div class="c-card__header">
                                <div class="c-card__title">نظرات کاربران</div>
                            </div>
                            <div class="c-card__wrapper">
                                <div class="c-card__header uk-flex uk-flex-bottom">
                                    <form method="GET" id="searchForm">
                                        <div class="uk-flex uk-flex-between">
                                            <div class="uk-width-1-3 c-ui-form__col c-ui-form__col--group-item c-ui-form__col--xs-12 c-ui-form__col--wrap-xs">
                                                <label class="c-ui-form__label uk-text-right">
                                                    مرتب‌سازی بر اساس:
                                                </label>
                                                <div class="uk-flex">
                                                    <div class="c-profile-rating__details-filter uk-text-nowrap js-user-comment" data-sort="buyers">
                                                        نظرات خریداران
                                                    </div>
                                                    <div class="c-profile-rating__details-filter uk-text-nowrap js-user-comment" data-sort="">
                                                        نظرات کاربران
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="search[mode]" class="js-filter-comment">
                                            <input type="hidden" name="search[variantId]" value="">
                                            <div class="uk-width-1-4 c-ui-form__col c-ui-form__col--group-item c-ui-form__col--xs-12
                                                 c-ui-form__col--wrap-xs c-ui-form__col--xs-full c-mega-campaigns-join-list__container-filters-select">
                                                <label class="c-ui-form__label uk-text-right">مرتب‌سازی بر اساس:</label>
                                                <select id="sortType" class="js-select2 c-ui-select--with-svg-icon c-ui-select c-ui-select--common
                                                    c-ui-select--small select2-hidden-accessible" name="sortType" tabindex="-1" aria-hidden="true">
                                                    <option value="all">همه دیدگاه‌ها</option>
                                                    <option value="not_checked">در انتظار برررسی</option>
                                                    <option value="accepted">تایید شده</option>
                                                    <option value="rejected">رد شده</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button id="submitButton" class="uk-icon-button uk-icon-button--search uk-invisible"
                                            uk-tooltip="title: جستجو; pos: top-center" type="submit" title="" aria-expanded="false"></button>
                                    </form>
                                </div>

                                <div class="c-ui--px-5">
                                    <div class="c-grid__row js-table-container">
                                        <div class="c-grid__col">
                                            <div class="c-card">
                                                <div class="c-card__wrapper">
                                                    <div class="c-card__header c-card__header--table">
                                                        <div class="c-card__paginator">
                                                            <div class="c-ui-paginator js-paginator">
                                                                @if(count($comments))
                                                                    <div class="c-ui-paginator__total" data-rows="">
                                                                        تعداد نتایج: <span>{{ persianNum($comments->total()) }} مورد</span>
                                                                    </div>
                                                                @else
                                                                    <div class="c-ui-paginator__total" data-rows="۰">
                                                                        جستجو نتیجه‌ای نداشت
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="c-card__body c-ui-table__wrapper">
                                                        <table class="c-ui-table   js-search-table " data-sort-column="" data-sort-order=""
                                                            data-search-url="{{ route('staff.comments.searchComment') }}" data-auto-reload-seconds="0"
                                                             data-new-ui="1" data-is-header-floating="1" data-has-checkboxes="">
                                                            <thead>
                                                            <tr class="c-ui-table__row">
                                                                <th class="c-ui-table__header c-ui-table__header--nowrap ">
                                                                    <span class="js-search-table-column">ردیف</span>
                                                                </th>
                                                                <th class="c-ui-table__header c-ui-table__header--nowrap " colspan="3">
                                                                    <span class="js-search-table-column">عنوان دیدگاه</span>
                                                                </th>
                                                                <th class="c-ui-table__header c-ui-table__header--nowrap " colspan="3">
                                                                    <span class="js-search-table-column">عنوان محصول</span>
                                                                </th>
                                                                <th class="c-ui-table__header c-ui-table__header--nowrap " colspan="2">
                                                                    <span class="js-search-table-column">تاریخ ثبت نظر</span>
                                                                </th>
                                                                <th class="c-ui-table__header c-ui-table__header--nowrap " colspan="2">
                                                                    <span class="js-search-table-column">وضعیت</span>
                                                                </th>
                                                                <th class="c-ui-table__header c-ui-table__header--nowrap " colspan="1">
                                                                    <span class="js-search-table-column"></span>
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td class="c-ui-table__cell-gap"></td>
                                                            </tr>

                                                            @foreach($comments as $key => $comment)
                                                                <tr class="c-ui-table__row c-ui-table__row--collapsable c-ui-table__row--body
                                                                    c-profile-rating__expanded-product-row">
                                                                    <td class="c-ui-table__cell">
                                                                        {{ persianNum($comments->firstItem() + $key) }}
                                                                    </td>

                                                                    <td class="c-ui-table__cell c-ui-table__cell--item-title uk-width-1-3" colspan="3">
                                                                        {{ persianNum($comment->title) }}
                                                                    </td>

                                                                    <td class="c-ui-table__cell c-ui-table__cell--item-title c-ui-table__cell--text-blue uk-width-1-3" colspan="3">
                                                                        <a href="#">{{ isset($comment->product) ? persianNum($comment->product->title_fa) : '' }}</a>
                                                                    </td>

                                                                    <td class="c-ui-table__cell" colspan="2">
                                                                        <span class="span-time"  data-value="{{ $comment->created_at }}"></span>
                                                                    </td>

                                                                    <td class="c-ui-table__cell" colspan="2">
                                                                        @if($comment->publish_status == 'accepted')
                                                                            <div class="c-wallet__body-card-status-no-circle c-wallet__body-card-status-no-circle--active uk-text-nowrap">
                                                                                تایید شده
                                                                            </div>
                                                                        @elseif($comment->publish_status == 'not_checked')
                                                                            <div class="c-wallet__body-card-status-no-circle c-wallet__body-card-status-no-circle--alert uk-text-nowrap">
                                                                                در انتظار بررسی
                                                                            </div>
                                                                        @elseif($comment->publish_status == 'rejected')
                                                                            <div class="c-wallet__body-card-status-no-circle c-wallet__body-card-status-no-circle--danger uk-text-nowrap">
                                                                                رد شده
                                                                            </div>
                                                                        @endif
                                                                    </td>
                                                                    <td class="c-ui-table__cell c-ui-table__expander" data-expand="{{ $comment->id }}">
                                                                        <span class="c-ui-table__expander-control js-expand-comment" data-id="{{ $comment->id }}"></span>
                                                                        <span class="c-ui-table__expander-control  c-ui-table c-join__btn--icon-delete delete-btn" data-id="{{ $comment->id }}"
                                                                            style="margin-left: 15px;color: #60667a;font-weight: bold;"></span>
                                                                    </td>
                                                                </tr>
                                                                <tr class="c-ui-table__expand-row c-ui-table__expand-row--first c-ui-table__expand-row--last js-expanded-row
                                                                    c-ui-table__expand-row--hidden" data-expand-target="{{ $comment->id }}" style="color: #81858b !important;">
                                                                    <td class="c-profile-rating__details-more second-td" colspan="12">
                                                                        <table class="c-ui-table js-table-expandable js-search-table js-table-fixed-header">
                                                                            <tbody>
                                                                                <tr class="c-ui-table__row">
                                                                                    <td class="uk-flex uk-flex-middle" style="width: 26%;float: right;">
                                                                                        {{ $comment->customer->first_name . ' ' . $comment->customer->last_name }}
{{--                                                                                        (خریدار)--}}
                                                                                    </td>

                                                                                    <td class="uk-flex uk-flex-middle" style="width: 15%;float: right;">
                                                                                        <div class="c-profile-rating__vote c-profile-rating__vote--thumbs-up">
                                                                                            {{ persianNum($comment->feedbacks ? $comment->feedbacks()->where('status', 'like')->count() : 0) }}
                                                                                        </div>
                                                                                    </td>

                                                                                    <td class="uk-flex uk-flex-middle" style="width: 15%;float: right;">
                                                                                        <div class="c-profile-rating__vote c-profile-rating__vote--thumbs-down" style="margin-top: 0px;">
                                                                                            {{ persianNum($comment->feedbacks ? $comment->feedbacks()->where('status', 'deslike')->count() : 0) }}
                                                                                        </div>
                                                                                    </td>
                                                                                    @if((!is_null($comment->recommend_status)) || ($comment->recommend_status !== " "))
                                                                                        <td class="uk-flex uk-flex-middle" style="width: 20%;float: right;">
                                                                                            @if($comment->recommend_status == 'recommended')
                                                                                                <div class="c-profile-rating__vote c-profile-rating__vote--thumbs-up c-profile-rating__vote--small uk-text-nowrap" style="margin-top: 0px;">
                                                                                                    توصیه می‌کنم
                                                                                                </div>
                                                                                            @elseif($comment->recommend_status == 'not_recommended')
                                                                                                <div class="c-profile-rating__vote c-profile-rating__vote--thumbs-down c-profile-rating__vote--small uk-text-nowrap" style="margin-top: 0px;">
                                                                                                    توصیه نمی کنم
                                                                                                </div>
                                                                                            @elseif($comment->recommend_status == 'no_idea')
                                                                                                <div class="c-profile-rating__vote c-profile-rating__vote--doubt c-profile-rating__vote--small uk-text-nowrap" style="margin-top: 0px;">
                                                                                                    مطمئن نیستم
                                                                                                </div>
                                                                                            @endif
                                                                                        </td>
                                                                                    @endif

                                                                                    <td class="uk-flex uk-flex-middle" style="width: 7%;">
                                                                                        <div class="c-profile-rating__details-user uk-text-nowrap c-profile-rating__details-user--normal">
                                                                                            کاربر عادی
                                                                                        </div>
                                                                                    </td>

                                                                                    <td class="uk-flex uk-flex-middle c-profile-rating__details-more-title" style="width: 100%;"></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>

                                                                        <div class="c-grid__row c-grid__row--gap-lg" style="width: 100%;margin: auto;margin-top: 28px;">
                                                                            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6"
                                                                                style="padding-right: 0px;float: right;">
                                                                                <label class="uk-form-label uk-flex uk-flex-between" style="color: #81858b !important;">
                                                                                    عنوان دیدگاه:
                                                                                    <span class="uk-float-left uk-padding-medium-left"></span>
                                                                                </label>
                                                                                <div class="field-wrapper">
                                                                                    <input type="text" class="c-content-input__origin js-attribute-old-value" name="title"
                                                                                        id="title" value="{{ $comment->title }}" style="background: white;border-color: #e6e9ed!important;">
                                                                                </div>
                                                                            </div>

                                                                            <div class="uk-width-1-4 c-ui-form__col c-ui-form__col--group-item c-ui-form__col--xs-12 c-ui-form__col--wrap-xs
                                                                                c-ui-form__col--xs-full c-mega-campaigns-join-list__container-filters-select">
                                                                                <label class="uk-form-label uk-flex uk-flex-between" style="color: #81858b !important;">
                                                                                    وضعیت:
                                                                                    <span class="uk-float-left uk-padding-medium-left"></span>
                                                                                </label>
                                                                                <select id="status-{{ $comment->id }}" class="js-select2 c-ui-select--with-svg-icon c-ui-select
                                                                                    c-ui-select--common c-ui-select--small select2-hidden-accessible" name="status" tabindex="-1" aria-hidden="true">
                                                                                    <option value="not_checked" {{ $comment->publish_status == 'not_checked' ? 'selected' : '' }}>در انتظار برررسی</option>
                                                                                    <option value="accepted" {{ $comment->publish_status == 'accepted' ? 'selected' : '' }}>تایید شده</option>
                                                                                    <option value="rejected" {{ $comment->publish_status == 'rejected' ? 'selected' : '' }}>رد شده</option>
                                                                                </select>
                                                                            </div>

                                                                            @if(!is_null($comment->recommend_status))
                                                                               <div class="uk-width-1-4 c-ui-form__col c-ui-form__col--group-item c-ui-form__col--xs-12
                                                                                    c-ui-form__col--wrap-xs c-ui-form__col--xs-full c-mega-campaigns-join-list__container-filters-select">
                                                                                    <label class="uk-form-label uk-flex uk-flex-between" style="color: #81858b !important;">
                                                                                        توصیه خرید
                                                                                        <span class="uk-float-left uk-padding-medium-left"></span>
                                                                                    </label>
                                                                                    <select name="recommend_status" id="recommend_status-{{ $comment->id }}" class="js-select2 c-ui-select--with-svg-icon
                                                                                        c-ui-select c-ui-select--common c-ui-select--small select2-hidden-accessible" tabindex="-1" aria-hidden="true" >
                                                                                        <option value="recommended" {{ ($comment->recommend_status == 'recommended')? 'selected' : '' }}>پیشنهاد می کنم</option>
                                                                                        <option value="not_recommended" {{ ($comment->recommend_status == 'not_recommended')? 'selected' : '' }}>پیشنهاد نمی کنم</option>
                                                                                        <option value="no_idea" {{ ($comment->recommend_status == 'no_idea')? 'selected' : '' }}>نظری ندارم</option>
                                                                                    </select>
                                                                                </div>
                                                                            @endif
                                                                        </div>

                                                                        <div class="c-grid__row c-grid__row--gap-lg" style="width: 100%; margin: auto;">
                                                                            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--sm-12 c-grid__col--xs-gap"
                                                                                style="padding-right: 0px;margin-top: 20px;">
                                                                                <label for="" class="uk-form-label" style="color: #81858b !important;">متن دیدگاه:</label>
                                                                                <div class="field-wrapper field-wrapper--textarea enabled">
                                                                                    <textarea name="text" id="text" class="c-content-input__origin c-content-input__origin--textarea js-textarea-words"
                                                                                        rows="5" maxlength="2000" style="background: white;border-color: #e6e9ed!important;">{{ $comment->text }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="c-grid__row c-grid__row--gap-lg" style="width: 100%; margin: auto;">
                                                                            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--sm-12 c-grid__col--xs-gap"
                                                                                style="padding-right: 0px;margin-top: 20px;">
                                                                                <label for="" class="uk-form-label" style="color: #81858b !important;">نقاط قوت:</label>
                                                                                <div class="field-wrapper field-wrapper--textarea enabled">
                                                                                    <input id="advantages" class="form-control tagify" name="advantages" value="{{ $comment->advantages }}"
                                                                                        autofocus="" style="background: white !important; border-color:#e6e9ed!important; width: 100% !important;">
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        <div class="c-grid__row c-grid__row--gap-lg" style="width: 100%; margin: auto; margin-bottom: 40px !important;">
                                                                            <div class="c-grid__col c-grid__col--gap-lg c-grid__col--flex-initial c-grid__col--sm-12 c-grid__col--xs-gap"
                                                                                style="padding-right: 0px;margin-top: 20px;">
                                                                                <label for="" class="uk-form-label" style="color: #81858b !important;">نقاط ضعف:</label>
                                                                                <div class="field-wrapper field-wrapper--textarea enabled">
                                                                                    <input id="disadvantages" class="form-control tagify" name="disadvantages" value="{{ $comment->disadvantages }}"
                                                                                        autofocus="" style="background: white !important; border-color:#e6e9ed!important; width: 100% !important;">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        @if(count($comment->ratings))
                                                                            <div class="c-profile-rating__details-user-vote js-product-score-board"
                                                                                style="height: auto;min-height: 95px;width: 100%;margin: auto;margin-right: 0px !important; background: unset;">
                                                                                @foreach($comment->ratings as $rating)
                                                                                    <div class="c-rating-chart__details-bar c-rating-chart__details-bar--profile js-product-score-item"
                                                                                        style="width: 45% !important;float: right;padding-top: 0px !important;margin-left: 5%;">
                                                                                        <div class="c-profile-rating__details-user-vote-item c-profile-rating__details-user-vote-item--title js-product-score-item-label">
                                                                                            {{ (strlen($rating->rating->name) > 35)? substr($rating->rating->name, 0, 31) . '...' : $rating->rating->name  }}
                                                                                        </div>
                                                                                        <div class="c-rating-chart__details-progress c-profile-rating__details-user-vote-score">
                                                                                            <div class="c-profile-rating__details-user-vote-score--fill js-product-score-item-progress"
                                                                                                style="width: {{ ($rating->score)*20 }}%;"></div>
                                                                                        </div>
                                                                                        <div class="c-rating-chart__details-value c-profile-rating__details-user-vote-item js-product-score-item-value uk-flex-right">
                                                                                            {{ ($rating->score == 1)? 'خیلی بد' : (($rating->score == 2)? 'بد' : (($rating->score == 3)? 'معمولی' : (($rating->score == 4)? 'خوب' : 'عالی'  )))     }}
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        @endif

                                                                        <div class="c-variant__btn-controls" style="width: 99%;">
                                                                            <button class="c-ui-btn c-ui-btn--bad-at mr-a cancell-btn" data-id="{{ $comment->id }}">لغو</button>
                                                                            <button class="c-ui-btn c-ui-btn--next saveData" data-id="{{ $comment->id }}">
                                                                                ذخیره
                                                                            </button>
                                                                        </div>

                                                                    </td>
                                                                </tr>

                                                                <tr><td class="c-ui-table__cell-gap"></td></tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>


                                                    <div class="c-card__footer" style="width: auto;">
                                                        <a href="#" style="visibility: hidden;">
                                                            <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">
                                                            </div>
                                                        </a>

                                                        {{ $comments->links('staffcomment::layouts.pagination.custom-pagination') }}
                                                        <div class="c-ui-paginator js-paginator">
                                                            <div class="c-ui-paginator js-paginator">
                                                                @if(count($comments))
                                                                    <div class="c-ui-paginator__total" data-rows="">
                                                                        تعداد نتایج: <span>{{ persianNum($comments->total()) }} مورد</span>
                                                                    </div>
                                                                @else
                                                                    <div class="c-ui-paginator__total" data-rows="۰">
                                                                        جستجو نتیجه‌ای نداشت
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="c-card__loading"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @include('staffcomment::layouts.modal')
                                <div class="c-card__loading"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

@endsection
@section('script')
<script>
// توکن csrf
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function (){
    tagifyLoader();
});

function persianNum() {
    String.prototype.toPersianDigits= function(){
        var id= ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
        return this.replace(/[0-9]/g, function(w){
            return id[+w]
        });
    }
}
function convertDate() {
    $(".span-time").each(function (){
        var output="";
        var input = $(this).data('value');
        var m = moment(input);
        if(m.isValid()){
            m.locale('fa');
            output = m.format("YYYY/M/D");
        }
        $(this).text(output.toPersianDigits());
    });
}
function tagifyLoader() {
    $("input[name=advantages]").each(function () {
        new Tagify(this);
    });

    $("input[name=disadvantages]").each(function () {
        new Tagify(this);
    });
}

function initExpandRow() {
    var $expandBtn = $('.js-expand-comment'),
        $expandRow = $('.js-expanded-row');

    $expandBtn.on('click', function () {
        // toggle class of expand button parent row
        $(this).parents('tr').toggleClass('c-profile-rating__expanded-product-row');

        var expandeData = $(this).parent('td').data('expand'),
            expandedRow = $(this).parents('tr').next();

        $(this).toggleClass('c-ui-table__expander-control--expanded');
        expandedRow.toggleClass('c-ui-table__expand-row--hidden');
    });
}
function initSelect2() {

    const $selects = $('select.c-ui-select--common');

    if ($selects.length) {
        for (let i = 0, len = $selects.length; i < len; i++) {
            const $select = $($selects[i]);

            $select.select2({
                placeholder: $select.attr('placeholder'),
                tags: true,
                clear: true,
                closeOnSelect: true
            }).data('select2').$dropdown.addClass('c-ui-select__dropdown c-ui-select__dropdown--gap');
        }
    }
}

function displayError(errors) {
    var message = '';
    if (typeof errors === typeof  "") {
        message = errors;
    } else if (typeof errors === typeof {}) {
        try {
            message = Object.values(errors).join('<br/>');
        } catch (e) {
            message = errors;
        }
    }
    UIkit.notification({
        message: message,
        status: 'danger',
        pos: 'bottom-right',
        timeout: 8000
    });
}

persianNum();
convertDate();

$(document).on('change',"#sortType" ,function (){
    console.log('cklicked...');
    $.ajax({
        type: 'post',
        url: '{{ route('staff.comments.searchComment') }}',
        data: {
            sortType: $(this).val(),
        },
        success: function (response) {
            $('.js-table-container').replaceWith(response);
        }

    });

});

$(document).on('click', '.saveData',function (){

    var $this = $(this).closest('.second-td');

    var title = $this.find("#title").val();
    var text = $this.find("#text").val();
    var advantages = $this.find("#advantages").val();
    var disadvantages = $this.find("#disadvantages").val();
    var publish_status = $this.find("select[name=status]").val();
    var recommend_status = $this.find("select[name=recommend_status]").val();
    var comment_id = $(this).data('id');

    $.ajax({
        type: 'post',
        url: '{{ route('staff.comments.update') }}',
        data: {
            title: title,
            text: text,
            advantages: advantages,
            disadvantages: disadvantages,
            comment_id: comment_id,
            recommend_status: recommend_status,
            publish_status: publish_status,
        },
        success: function (response) {
            $('.js-table-container').replaceWith(response);
        },
        error: function (errors) {
            displayError(errors.responseJSON.data.errors);
        }
    });
});

$(document).on('click', '.cancell-btn', function () {
    var comment_id = $(this).data('id');
    $('span[data-id=' + comment_id + ']').removeClass('c-ui-table__expander-control--expanded');
    $('tr[data-expand-target=' + comment_id + ']').addClass('c-ui-table__expand-row--hidden');
});


$(document).on('click', '.delete-btn', function () {

    var comment_id = $(this).data('id');


    $('.c-header__nav').hide();
    $(".uk-modal-container").addClass('uk-open');
    $(".uk-modal-container").css('display', 'block');


    $(document).on('click', '.uk-close', function () {
        $('.c-header__nav').show();
        comment_id = null;
    });

    $(document).on('click', '.no', function () {
        $('.c-header__nav').show();
        comment_id = null;
    });


    $(document).on('click', '.yes', function () {

        $('.c-header__nav').show();

        if (comment_id !== null)
        {
            $.ajax({
                method: 'post',
                url: "{{route('staff.comments.delete')}}",
                data: {
                    'id': comment_id,
                },
                success: function (response) {
                    $('.js-table-container').replaceWith(response);
                    $(window).scrollTop(0);
                    UIkit.notification({
                        message: 'دیدگاه حذف شد',
                        status: 'success',
                        pos: 'top-left',
                        timeout: 3000
                    });
                },
            });
        }
    });
});

</script>
@endsection
