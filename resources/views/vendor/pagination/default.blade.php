
<?php $link_limit = 7;  ?>
@if ($paginator->lastPage() > 1)
    @if ($paginator->currentPage() > 1)
        <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }} list-inline-item">
            <a href="{{ $paginator->url( $paginator->currentPage() - 1 ) }}" rel="First"><i class="fa fa-angle-double-left"></i> Prev</a>
        </li>
    @endif
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <?php
        $half_total_links = floor($link_limit / 2);
        $from = $paginator->currentPage() - $half_total_links;
        $to = $paginator->currentPage() + $half_total_links;
        if ($paginator->currentPage() < $half_total_links) {
           $to += $half_total_links - $paginator->currentPage();
        }
        if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
            $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
        }
        ?>
        @if ($from < $i && $i < $to)
            <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }} list-inline-item">
                <a href="{{ $paginator->url($i) }}" class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
            </li>
        @endif
    @endfor
    @if ($paginator->currentPage() < $paginator->lastPage())
            <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }} list-inline-item">
            <a href="{{ $paginator->url( $paginator->currentPage() + 1 ) }}" rel="next">Next <i class="fa fa-angle-double-right"></i></a>
        </li>
    @endif
   
   
@endif
