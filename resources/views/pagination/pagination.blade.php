@if ($paginator->hasPages())
<ul class="pagination">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <!-- Comment out or remove this part -->
    @else
    <li class="page-item">
        <!-- <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a> -->
        <a class="page-link" href="{{ $paginator->appends(request()->query())->previousPageUrl() }}" rel="prev">&laquo;</a>

    </li>
    @endif

    {{-- Pagination Elements --}}
    <?php
    $maxPages = 4; // Nombre maximum de liens de page à afficher
    $halfMax = floor($maxPages / 2);
    $startPage = max($paginator->currentPage() - $halfMax, 1);
    $endPage = min($startPage + $maxPages - 1, $paginator->lastPage());
    ?>
    @if ($startPage > 1)
    <li class="page-item"><a class="page-link" href="{{ $paginator->url(1) }}">1</a></li>
    @if ($startPage > 2)
    <li class="page-item disabled"><span class="page-link">&hellip;</span></li>
    @endif
    @endif
    @for ($page = $startPage; $page <= $endPage; $page++) @if ($page==$paginator->currentPage())
        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
        @else
        <li class="page-item"><a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
        @endif
        @endfor
        @if ($endPage < $paginator->lastPage())
            @if ($endPage < $paginator->lastPage() - 1)
                <li class="page-item disabled"><span class="page-link">&hellip;</span></li>
                @endif
                <li class="page-item"><a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                <li class="page-item">
                    <!-- <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"> &raquo;</a> -->
                    <a class="page-link" href="{{ $paginator->appends(request()->query())->nextPageUrl() }}" rel="next"> &raquo;</a>

                </li>
                @else
                <!-- Comment out or remove this part -->
                @endif
</ul>
@endif