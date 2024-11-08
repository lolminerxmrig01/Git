<div class="c-content-categories__wrapper js-category-column cat-box appended-box" data-id="{{ $id }}">
    <ul class="c-content-categories__list">
        @foreach($categories->where('parent_id', $id) as $category)
            <li class="c-content-categories__item
            {{ $categories->where('parent_id', $category->id)->count() > 0 ? 'has-children' : '' }}">
                <label class="c-content-categories__link js-category-link">
                    <input type="radio" name="category" value="{{ $category->id }}" 
                        class="uk-hidden js-category-data" data-id="{{ $category->id }}" data-theme="">
                    {{ $category->name }}
                </label>
            </li>
        @endforeach
    </ul>
</div>
