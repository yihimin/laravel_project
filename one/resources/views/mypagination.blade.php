@if (isset($paginator) && $paginator->lastPage() > 1)

<nav aria-label="Page navigation" class="mt-4">
    <ul class="pagination pagination-sm justify-content-center" style="margin: 0;">

        <?php
            $interval = isset($interval) ? abs(intval($interval)) : 2;
            $from = $paginator->currentPage() - $interval;
            if ($from < 1) $from = 1;

            $to = $paginator->currentPage() + $interval;
            if ($to > $paginator->lastPage()) $to = $paginator->lastPage();
        ?>

        <!-- 처음, 이전 버튼 -->
        @if ($paginator->currentPage() > 1)
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url(1) }}" aria-label="First" 
                   style="background-color: #8C6450; color: #FFF; border: none;">
                    ◀
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url($paginator->currentPage() - 1) }}" aria-label="Previous"
                   style="background-color: #A67B5B; color: #FFF; border: none;">
                    ◁
                </a>
            </li>
        @endif

        <!-- 페이지 번호 -->
        @for($i = $from; $i <= $to; $i++)
            <?php $isCurrentPage = $paginator->currentPage() == $i; ?>
            <li class="page-item {{ $isCurrentPage ? 'active' : '' }}">
                @if(!$isCurrentPage)
                    <a class="page-link" href="{{ $paginator->url($i) }}" 
                       style="background-color: #F3E9DC; color: #6B4226; border: 1px solid #C4A484;">
                        {{ $i }}
                    </a>
                @else
                    <a class="page-link" href="#" 
                       style="background-color: #6B4226; color: #FFF; border: none;">
                        {{ $i }}
                    </a>
                @endif
            </li>
        @endfor

        <!-- 다음, 끝 버튼 -->
        @if($paginator->currentPage() < $paginator->lastPage())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url($paginator->currentPage() + 1) }}" aria-label="Next"
                   style="background-color: #A67B5B; color: #FFF; border: none;">
                    ▷
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" aria-label="Last"
                   style="background-color: #8C6450; color: #FFF; border: none;">
                    ▶
                </a>
            </li>
        @endif

    </ul>
</nav>

@endif
