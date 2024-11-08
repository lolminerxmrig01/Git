@foreach($category->types()->orderBy('position', 'asc')->get() as $type)
<div class="c-grid__row c-grid__row--gap-lg c-grid__row--negative-gap-attr type-field-box appended-box" id="item-{{ $type->id }}">
    <div class="c-content-upload__drag-handler c-content-upload__drag-handler--outer ui-sortable-handle" style="margin-right: 0px;">
        <span class="c-content-upload__drag-handler c-content-upload__drag-handler--up js-sort-up ui-sortable-handle" style="margin-top: -23px;"></span>
        <span class="c-content-upload__drag-handler c-content-upload__drag-handler--bg ui-sortable-handle" style="padding-top: 2px;padding-bottom: 2px;"></span>
        <span class="c-content-upload__drag-handler c-content-upload__drag-handler--down js-sort-down ui-sortable-handle"></span>
    </div>
    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">
        <div class="field-wrapper">
            <input type="text" data-old="{{ $type->id }}" data-id="{{ $type->id }}" value="{{ $type->name }}" 
                class="c-content-input__origin c-ui-input--deactive js-suggested-title-fa js-edit-mode-suggested-title-fa type_field database_data"
                 name="database_data" style="margin-left: 10px;" disabled>
            <a class="c-ui-fields-box edit-form-sectionbtn c-ui-btn--outline-blue edit-field-btn">ویرایش نوع</a>
            <a type="button" class="c-content-categories__search-reset remove-field-btn" style="min-height: 39px !important;height: 39px;"></a>
        </div>
    </div>
</div>
@endforeach
