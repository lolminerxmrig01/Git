@if ($paginator->hasPages())
<ul class="c-ui-paginator__control js-search-pager">
    {{-- صفحه قبل --}}
    @if ($paginator->onFirstPage())
        <li class="c-ui-paginator__control-item">
            <a class="pagination-link c-ui-paginator__control-prev c-ui-paginator__control-prev--disabled"
             aria-hidden="true" data-page=""></a>
        </li>
    @else
        <li class="c-ui-paginator__control-item">
            <a class="c-ui-paginator__control-prev" data-page="{{ ($paginator->currentPage())-1 }}"></a>
        </li>
    @endif

    @foreach ($elements as $element)
    @if (is_string($element))
    <li class="c-ui-paginator__control-item" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
    @endif

    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <li class="c-ui-paginator__control-item uk-active">
        <a data-page="{{ $page }}" class="c-ui-paginator__control-digit c-ui-paginator__control-digit--current">
            {{ persianNum($page) }}
        </a>
    </li>
    @else
    <li class="c-ui-paginator__control-item">
        <a data-page="{{ $page }}" class="c-ui-paginator__control-digit">{{ persianNum($page) }}</a>
    </li>
    @endif
    @endforeach
    @endif
    @endforeach
    @if ($paginator->hasMorePages())

        <li class="c-ui-paginator__control-item">
            <a class="c-ui-paginator__control-next" data-page="{{ ($paginator->currentPage())+1 }}"></a>
        </li>
    @else
        <li class="c-ui-paginator__control-item" aria-disabled="true" aria-label="@lang('pagination.next')">
            <a class="pagination-link c-ui-paginator__control-next c-ui-paginator__control-next--disabled"
             aria-hidden="true" data-page="" rel="next" aria-label="@lang('pagination.next')"></a>
        </li>
    @endif
</ul>
@endif
