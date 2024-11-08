@if(count($categories))
  <div class="c-content-categories__wrapper c-content-categories__wrapper--results">
    <div class="c-content-categories__search-summary">
      <span class="c-content-categories__search-label">نتایج جستجو گروه‌ها</span>
      <span class="c-content-categories__search-result">
            تعداد نتایج:
            <span class="em">{{ persianNum($categories->count()) }} نتیجه</span>
        </span>
    </div>
    <ul class="c-content-categories__search-results results__list">
      @foreach($categories as $category)
        <li class="c-content-categories__results-item">
          <label for="category_{{$category->id}}" class="c-ui-radio c-content-categories__results-label">
            <input type="radio" name="search-results" id="category_{{$category->id}}"
               class="js-category-change c-ui-radio__origin" value="{{$category->id}}" data-theme="colored"/>
            <span class="c-ui-radio__check"></span>
            <span class="c-ui-radio__label">{{ $category->name }}</span>
            <ul class="c-content-categories__selected-list c-content-categories__selected-list--search">
              @if ($category->parent_id == 0)
                <li class="c-content-categories__selected-category c-content-categories__selected-category--search">
                  {{ $category->name }}
                </li>
              @else
                <?php
                unset($main_cat);
                unset($lists);
                unset($lists);
                do {
                  $main_cat=$category->parent;
                  $lists[] = $category;
                  $category = $category->parent;
                } while (isset($category->parent));
                $lists = array_reverse($lists,true);
                ?>

                <li class="c-content-categories__selected-category c-content-categories__selected-category--search">
                  <?php  $main_cat = Modules\Staff\Category\Models\Category::find($main_cat->id) ?>
                  {{ $main_cat->name }}
                </li>

                @foreach ($lists as $cate)
                  <li class="c-content-categories__selected-category c-content-categories__selected-category--search">
                    {{ $cate->name }}
                  </li>
                @endforeach
              @endif
            </ul>
          </label>
        </li>
      @endforeach
    </ul>
  </div>
@else
  <div class="c-content-categories__wrapper c-content-categories__wrapper--empty js-category-column" style="border: none;">
    جستجو شما نتیجه‌ای نداشت.
  </div>
@endif
