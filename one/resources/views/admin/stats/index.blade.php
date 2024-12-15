@extends('admin_layout')

@section('content')
<div class="container py-5" style="background-color: #F3E9DC; border-radius: 10px;">
    <!-- 페이지 제목 -->
    <h1 class="mb-4 text-center" style="color: #6B4226;">통계 관리</h1>

    <!-- 상품별 판매 통계 -->
    <div class="mt-5">
        <h2 style="color: #6B4226;">상품별 판매 통계</h2>
        <div class="chart-container" style="position: relative; height:40vh; width:80vw; margin: auto;">
            <canvas id="productSalesChart"></canvas>
        </div>
    </div>

    <!-- 구분선 -->
    <hr class="my-5" style="border: 1px solid #C4A484;">

    <!-- 날짜별 매출 -->
    <div class="mt-5">
        <h2 style="color: #6B4226;">날짜별 매출</h2>
        <div class="chart-container" style="position: relative; height:40vh; width:80vw; margin: auto;">
            <canvas id="dailySalesChart"></canvas>
        </div>
    </div>
</div>

<script>
    // 커피 테마 색상
    const coffeeColors = {
        brownLight: 'rgba(210, 180, 140, 0.6)', // 라이트 브라운
        brownDark: 'rgba(139, 69, 19, 0.9)',   // 다크 브라운
        beige: 'rgba(245, 245, 220, 0.6)',     // 베이지
        cream: 'rgba(255, 248, 220, 0.8)',     // 크림
        caramel: 'rgba(205, 133, 63, 0.8)',    // 카라멜
        mocha: 'rgba(165, 42, 42, 0.8)',       // 모카
        border: 'rgba(139, 69, 19, 1)'         // 테두리 브라운
    };

    // 상품별 판매 차트
    const productNames = @json($productNames);
    const productSales = @json($productSales);

    const productColors = [coffeeColors.brownLight, coffeeColors.caramel, coffeeColors.mocha, coffeeColors.beige, coffeeColors.cream];

    const ctx1 = document.getElementById('productSalesChart').getContext('2d');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: productNames,
            datasets: [{
                label: '총 매출 (₩)',
                data: productSales,
                backgroundColor: productNames.map((_, index) => productColors[index % productColors.length]),
                borderColor: coffeeColors.border,
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    align: 'end',
                    labels: {
                        color: '#6B4226' // 범례 색상
                    }
                },
                title: {
                    display: true,
                    color: '#6B4226',
                    font: {
                        size: 18,
                        family: 'Georgia'
                    }
                }
            },
            scales: {
                x: {
                    ticks: { color: '#6B4226' },
                    grid: { color: 'rgba(210, 180, 140, 0.2)' }
                },
                y: {
                    beginAtZero: true,
                    ticks: { color: '#6B4226' },
                    grid: { color: 'rgba(210, 180, 140, 0.2)' }
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
                backgroundColor: coffeeColors.cream,
                borderColor: coffeeColors.mocha,
                borderWidth: 3,
                pointBackgroundColor: coffeeColors.caramel,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    align: 'end',
                    labels: {
                        color: '#6B4226'
                    }
                },
                title: {
                    display: true,
                    color: '#6B4226',
                    font: {
                        size: 18,
                        family: 'Georgia'
                    }
                }
            },
            scales: {
                x: {
                    ticks: { color: '#6B4226' },
                    grid: { color: 'rgba(210, 180, 140, 0.2)' }
                },
                y: {
                    beginAtZero: true,
                    ticks: { color: '#6B4226' },
                    grid: { color: 'rgba(210, 180, 140, 0.2)' }
                }
            }
        }
    });
</script>
@endsection
