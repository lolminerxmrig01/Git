@if ($paginator->hasPages())
<ul class="c-ui-paginator__control">
    {{-- صفحه قبل --}}
    @if ($paginator->onFirstPage())
        <li class="c-ui-paginator__control-item" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <a class="pagination-link c-ui-paginator__control-prev c-ui-paginator__control-prev--disabled" aria-hidden="true" data-page=""></a>
        </li>
    @else
        <li class="c-ui-paginator__control-item">
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-link c-ui-paginator__control-prev js-content-pager-item"
               aria-hidden="true" aria-label="@lang('pagination.previous')"></a>
        </li>
    @endif

    @foreach ($elements as $element)
    @if (is_string($element))
    <li class="c-ui-paginator__control-item" aria-disabled="true">
        <span class="page-link">{{ $element }}</span>
    </li>
    @endif

    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <li class="c-ui-paginator__control-item uk-active">
        <a href="{{ $url }}" data-page="" class="pagination-link c-ui-paginator__control-digit 
        c-ui-paginator__control-digit--current">
        {{ persianNum($page) }}
    </a>
    </li>
    @else
    <li class="c-ui-paginator__control-item">
        <a href="{{ $url }}" data-page="" class="pagination-link c-ui-paginator__control-digit
         js-content-pager-item">{{ persianNum($page) }}</a>
    </li>
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <li class="c-ui-paginator__control-item">
            <a class="pagination-link c-ui-paginator__control-next js-content-pager-item"
               href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"></a>
        </li>
    @else
        <li class="c-ui-paginator__control-item" aria-disabled="true" aria-label="@lang('pagination.next')">
            <a class="pagination-link c-ui-paginator__control-next c-ui-paginator__control-next--disabled" data-page=""  aria-hidden="true"></a>
        </li>
    @endif
</ul>
@endif
