@if($counter)
  <div class=" show-more  ">
    <ul class="c-catalog__list--depth ">
      <li class="c-catalog__cat-item ">
            <?php  $counter = $counter-1;  ?>
            @if(isset($fullCategoryList[$j]))
            <span class="c-catalog__cat-item {{ filled($fullCategoryList[$j]->children)? 'c-catalog__cat-item--arrow-down' : '' }}">
                <a class="c-catalog__link {{ ($counter == 1)? 'is-active' : '' }}"
                data-snt-event="dkSearchPageClick"
                data-snt-params='{"item":"catalog-filter","item_option":"{{ $fullCategoryList[$j]->name }}"}'
                href="{{  route('front.categoryPage', ['slug' => $fullCategoryList[$j]->slug ]) }}">{{ $fullCategoryList[$j]->name }}</a>
            </span>
                @if($counter == 1 && count($other_categories))
                    @foreach ($other_categories as $item)
                        <div class=" show-more  ">
                            <ul class="c-catalog__list--depth ">
                                <li class="c-catalog__cat-item ">
                                    <a data-snt-event="dkSearchPageClick" data-snt-params='{"item":"catalog-filter","item_option":"{{ $item->name }}"}'
                                    class="c-catalog__link "
                                    href="{{  route('front.categoryPage', ['slug' => $item->slug ]) }}">{{ $item->name }}</a></li>
                            </ul>
                        </div>
                    @endforeach
                @endif
            @elseif($other_categories && count($fullCategoryList) == 1)
                @foreach ($other_categories as $item)
                <div class=" show-more  ">
                    <ul class="c-catalog__list--depth ">
                        <li class="c-catalog__cat-item ">
                            <a data-snt-event="dkSearchPageClick" data-snt-params='{"item":"catalog-filter","item_option":"{{ $item->name }}"}'
                            class="c-catalog__link "
                            href="{{  route('front.categoryPage', ['slug' => $item->slug ]) }}">{{ $item->name }}</a></li>
                    </ul>
                </div>
                @endforeach
            @endif
            <?php $j = $j+1;  ?>
            @include('front::layouts.category-menu', ['fullCategoryList' => $fullCategoryList, 'counter' => $counter, 'j' => $j])
      </li>
    </ul>
  </div>
@endif


