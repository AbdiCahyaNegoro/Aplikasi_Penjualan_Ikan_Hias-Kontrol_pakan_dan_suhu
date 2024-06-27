<!-- resources/views/admin/SuhuAir.blade.php -->

@extends('layouts.beranda.masterberanda')

@section('content')
    <div class="container-fluid">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Suhu Air</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/chart.js') }}"></script>
    <script>
        var suhuData = @json($data);
    </script>
    <script src="{{ asset('assets/js/myAreaChart.js') }}"></script>
@endsection
