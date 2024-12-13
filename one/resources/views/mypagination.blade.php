@if (isset($paginator) && $paginator->lastPage() > 1)

	<nav aria-label="Page navigation example">
		<ul class="pagination pagination-sm justify-content-center mymargin5">
        
	<?
		$interval = isset($interval) ? abs(intval($interval)) : 2 ;
		$from = $paginator->currentPage() - $interval;
		if ($from < 1)	$from = 1;
			
		$to = $paginator->currentPage() + $interval;
		if ($to > $paginator->lastPage()) $to = $paginator->lastPage();
	?>
        
	@if ($paginator->currentPage() > 1)		<!-- 처음, 이전 -->
		<li class="page-item">
			<a class="page-link" href="{{ $paginator->url(1) }}" aria-label="First">
				<span aria-hidden="true" style="color:steelblue">◀</span>
			</a>
		</li>

		<li class="page-item">
			<a class="page-link" href="{{ $paginator->url($paginator->currentPage() - 1) }}" aria-label="Previous">
				<span aria-hidden="true" style="color:steelblue">◁</span>
			</a>
		</li>
	@endif
     
	@for($i = $from; $i <= $to; $i++)				<!--  페이지번호들... -->
	<?
		$isCurrentPage = $paginator->currentPage() == $i;
	?>
		<li class="page-item {{ $isCurrentPage ? 'active' : '' }}">
	@if( !$isCurrentPage)
			<a class="page-link" href="{{ $paginator->url($i) }}" style="color:#666666">{{ $i }}</a>
	@else
			<a class="page-link" href="#" style="color:white;background-color:steelblue">{{ $i }}</a>
	@endif

		</li>
	@endfor
        
	@if($paginator->currentPage() < $paginator->lastPage())	<!-- 다음, 끝 -->
		<li class="page-item">
			<a class="page-link" href="{{ $paginator->url($paginator->currentPage() + 1) }}" aria-label="Next">
				<span aria-hidden="true" style="color:steelblue">▷</span>
			</a>
		</li>

		<li class="page-item">
			<a class="page-link" href="{{ $paginator->url($paginator->lastpage()) }}" aria-label="Last">
				<span aria-hidden="true" style="color:steelblue">▶</span>
			</a>
		</li>
	@endif
        
		</ul>
	</nav>

@endif