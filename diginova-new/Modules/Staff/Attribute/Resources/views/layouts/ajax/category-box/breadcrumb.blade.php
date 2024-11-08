<ul class="js-selected-category c-content-categories__selected-list" id="breadcrumbs">
@if ($category->parent_id == 0)
  <li class="c-content-categories__selected-category  appended-box">
      {{ $category->name }}
  </li>
@else
  <?php
    if (isset($main_cat)){
      unset($main_cat);
    }

    if (isset($lists)){
      unset($lists);
    }

    do {
        $main_cat=$category->parent;
        $lists[] = $category;
        $category = $category->parent;
    } while (isset($category->parent));
    $lists = array_reverse($lists,true);

  ?>
  <li class="c-content-categories__selected-category appended-box">
      <?php  $main_cat = Modules\Staff\Category\Models\Category::find($main_cat->id) ?>
      {{ $main_cat->name }}
  </li>
  @foreach ($lists as $cate)
      <li class="c-content-categories__selected-category appended-box">
          {{ $cate->name }}
      </li>
  @endforeach
@endif
</ul>
