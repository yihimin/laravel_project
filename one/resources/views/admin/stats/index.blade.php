@extends('admin_layout')
@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center" style="color: #6C757D;">통계 관리</h1>

    <!-- 상품별 판매 통계 -->
    <div class="mt-5">
        <h2>상품별 판매 통계</h2>
        <div class="chart-container" style="position: relative; height:40vh; width:80vw; margin: auto;">
            <canvas id="productSalesChart"></canvas>
        </div>
    </div>

    <!-- 구분선 -->
    <hr class="my-5" style="border: 1px solid #6C757D;">

    <!-- 날짜별 매출 -->
    <div class="mt-5">
        <h2>날짜별 매출</h2>
        <div class="chart-container" style="position: relative; height:40vh; width:80vw; margin: auto;">
            <canvas id="dailySalesChart"></canvas>
        </div>
    </div>
</div>

<script>
    // 상품별 판매 차트
    const productNames = @json($productNames);
    const productSales = @json($productSales);

    const ctx1 = document.getElementById('productSalesChart').getContext('2d');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: productNames,
            datasets: [{
                label: '총 매출 (₩)',
                data: productSales,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: '상품별 매출'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // 날짜별 매출 차트
    const dailyDates = @json($dailyDates);
    const dailyTotals = @json($dailyTotals);

    const ctx2 = document.getElementById('dailySalesChart').getContext('2d');
    new Chart(ctx2, {
        type: 'line',
        data: {
            labels: dailyDates,
            datasets: [{
                label: '총 매출 (₩)',
                data: dailyTotals,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: '날짜별 매출'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
