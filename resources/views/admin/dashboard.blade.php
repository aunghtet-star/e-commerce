@extends('admin.layout.master')
@section('content')
<style>
    .dashboard-i{
        font-size: 50px !important;
    }
</style>
<div class="row">
    <div class="col-3">
        <div class="card bg-primary p-3">
            <div class="d-flex">
                <div class="p-3 d-flex align-items-center justify-content-center">
                    <i class="fa fa-money text-white dashboard"></i>
                </div>
                <div class="p-3 d-flex align-items-center flex-column justify-content-center">
                    <h5 class="text-white">Today Income</h5>
                    <h2 class="text-white">{{$todayIncomeCount}} Ks</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card bg-primary p-3">
            <div class="d-flex">
                <div class="p-3 d-flex align-items-center justify-content-center">
                    <i class="fa fa-money text-white dashboard"></i>
                </div>
                <div class="p-3 d-flex align-items-center flex-column justify-content-center">
                    <h5 class="text-white">Today Outcome</h5>
                    <h2 class="text-white">{{$todayOutcomeCount}} Ks</h2>
                </div>
            </div>
        </div>
    </div><div class="col-3">
        <div class="card bg-primary p-3">
            <div class="d-flex">
                <div class="p-3 d-flex align-items-center justify-content-center">
                    <i class="fa fa-user text-white dashboard"></i>
                </div>
                <div class="p-3 d-flex align-items-center flex-column justify-content-center">
                    <h5 class="text-white">Users</h5>
                    <h2 class="text-white">{{$userCount}}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card bg-primary p-3">
            <div class="d-flex">
                <div class="p-3 d-flex align-items-center justify-content-center">
                    <i class="fa fa-heart text-white dashboard"></i>
                </div>
                <div class="p-3 d-flex align-items-center flex-column justify-content-center">
                    <h5 class="text-white">Total Products</h5>
                    <h2 class="text-white">{{$productCount}}</h2>
                </div>
            </div>
        </div>
    </div>

    {{--chart--}}
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h4>Monthly Sales Chart</h4>
                <canvas id="saleChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h4>Income-Outcome Chart</h4>
                <canvas id="inoutChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Correct the naming for consistency
    const labels = @json($months);
    const saleData = @json($saleData);

    const data = {
        labels: labels,
        datasets: [{
            label: 'Monthly Sales Chart',
            backgroundColor: 'rgb(255,99,132)',
            borderColor: 'rgb(255,99,132)',
            data: saleData,
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {}
    };

    const saleChartElement = document.getElementById('saleChart');
    if (saleChartElement) {
        new Chart(saleChartElement, config);
    }

    // Income-Outcome chart
    const inoutLabels = @json($dayMonths);
    const incomeCount = @json($incomeCount);
    const outcomeCount = @json($outcomeCount);

    const inoutData = {
        labels: inoutLabels,
        datasets: [{
            label: 'Income',
            backgroundColor: 'green', // Make sure to add a background color for bar charts
            borderColor: 'green',
            data: incomeCount,
        },
        {
            label: 'Outcome',
            backgroundColor: 'red', // Same here
            borderColor: 'red',
            data: outcomeCount,
        }]
    };

    const inoutConfig = {
        type: 'line',
        data: inoutData,
        options: {}
    };

    const inoutChartElement = document.getElementById('inoutChart');
    if (inoutChartElement) {
        new Chart(inoutChartElement, inoutConfig);
    }
</script>
@endsection

