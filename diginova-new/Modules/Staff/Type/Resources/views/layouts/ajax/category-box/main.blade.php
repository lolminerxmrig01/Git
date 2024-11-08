<div class="c-content-categories__wrapper js-category-column cat-box">
  <ul class="c-content-categories__list">
    @foreach($categories->where('parent_id', 0) as $category)
      <li class="c-content-categories__item
         {{ $categories->where('parent_id', $category->id)->count() > 0 ? 'has-children' : '' }}">
        <label class="c-content-categories__link js-category-link">
          <input type="radio" name="category" value="{{ $category->id }}" class="js-category-data uk-hidden"
                 data-id="{{ $category->id }}" data-theme="" data-status="ziro_parent" style="visibility: hidden;">
          {{ $category->name }}
        </label>
      </li>
    @endforeach
  </ul>
</div>
