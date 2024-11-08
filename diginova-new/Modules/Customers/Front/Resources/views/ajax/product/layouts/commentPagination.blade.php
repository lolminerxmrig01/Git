@if ($paginator->hasPages())

<?php

  if ($paginator->currentPage() >= 5) {
    $begin = $paginator->currentPage() - 4;
  }
  elseif ($paginator->currentPage() <= 4) {
    $begin = 1;
  }
  if(($paginator->lastPage() - $paginator->currentPage()) <= 4) {
    $begin = $paginator->lastPage() - 9;
    if ($begin = $paginator->lastPage() - 9 < 0) {
      $begin = 1;
    } else {
      $begin = $paginator->lastPage() - 9;
    }
  }

  $end = ($paginator->lastPage() - $begin > 9)? $begin + 8 : $paginator->lastPage();


  $customItems = [];

  for($i = $begin; $i <= $end; $i++){
    $customItems[$i] = route('front.ajax.productComments', $product_code) . "?page=$i";
  }

?>


<ul class="c-pager__items">

  @if (!$paginator->onFirstPage())
    <li class="js-pagination-item ">
      <a class="c-pager__prev" href="{{ $paginator->toArray()['first_page_url'] }}" data-page="1"></a>
    </li>
  @endif

  @foreach ($customItems as $page => $url)
    @if ($page == $paginator->currentPage())
      <li class="js-pagination-item ">
        <a class="c-pager__item is-active" href="javascript:" data-page="{{ $page }}">{{ persianNum($page) }}</a>
      </li>
    @else
      <li class="js-pagination-item ">
        <a class="c-pager__item" href="{{ $url }}" data-page="{{ $page }}">{{ persianNum($page) }}</a>
      </li>
    @endif
  @endforeach

  @if ($paginator->hasMorePages())
    <li class="js-pagination-item ">
      <a class="c-pager__next" href="{{ $paginator->url($paginator->lastPage()) }}" data-page="{{ $paginator->lastPage() }}"></a>
    </li>
  @endif

</ul>
@endif

