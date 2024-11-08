<div class="c-content-categories__wrapper js-category-column">
    <ul class="c-content-categories__list">
        @foreach($categories->where('parent_id', 0) as $category)
            <li class="c-content-categories__item {{ (count($category->children) > 0) ? 'has-children' : '' }}">
                <label class="c-content-categories__link js-category-link">
                    <input type="radio" class="uk-hidden js-category-data" data-id="{{ $category->id }}" value="{{ $category->name }}" data-theme="">
                    {{ $category->name }}
                </label>
            </li>
        @endforeach
    </ul>
</div>
