@if ($paginator->hasPages())
    <!-- Pagination -->
    <div class="pagination w-100 text-center">
        <ul class="pagination" style="margin: auto">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                
            @else
                <li class="pagi-prev">
                    <a href="{{ $paginator->previousPageUrl() }}">
                        <i class="fa fa-angle-left icon icon-prev" aria-hidden="true"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a href="{{ $url }}">{{ $page }}</a></li>
                        @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage())
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @elseif ($page == $paginator->lastPage() - 1 || $page == $paginator->lastPage() - 2 || $paginator->currentPage())
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="pagi-next">
                    <a href="{{ $paginator->nextPageUrl() }}">
                        <i class="fa fa-angle-right icon icon-next" aria-hidden="true"></i>
                    </a>
                </li>
            @endif
        </ul>
    </div>
    <!-- Pagination -->
@endif
<style>
    .pagination {
        padding: 10px 0;
    }
    .pagination ul > li {
        margin-right: 10px;
    }
</style>
