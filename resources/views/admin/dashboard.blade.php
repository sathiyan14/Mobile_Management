@extends('layouts.admin')

@section('admin-content')
<div class="container mt-4">

    <h2 class="mb-4">Hello, {{ Auth::user()->name }}</h2>

    <div class="row text-center mt-4">

        <!-- Complaints Card -->
        <div class="col">
            <a href="{{ route('admin.complaints.index') }}" class="text-decoration-none">
                <div class="card stats-card p-3">
                    <h4>{{ $totalComplaints }}</h4>
                    <p>Total Complaints</p>
                </div>
            </a>
        </div>

        <!-- Technicians Card -->
        <div class="col">
            <a href="{{ route('technicians.index') }}" class="text-decoration-none">
                <div class="card stats-card p-3">
                    <h4>{{ $technicians }}</h4>
                    <p>Technicians</p>
                </div>
            </a>
        </div>

        <!-- Customers Card -->
        <div class="col">
            <a href="{{ route('admin.customers.index') }}" class="text-decoration-none">
                <div class="card stats-card p-3">
                    <h4>{{ $customers }}</h4>
                    <p>Customers</p>
                </div>
            </a>
        </div>

    </div>

    <!-- Chart -->
    <div class="chart-container mt-4">
        <canvas id="statusChart"
            data-pending="{{ $pending }}"
            data-repairing="{{ $repairing }}"
            data-ready="{{ $ready }}"
            data-delivered="{{ $delivered }}"
            height="120">
        </canvas>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/adminChart.js') }}"></script>

<style>
    /* CARD STYLE */
    .stats-card {
        background-color: #fff;
        color: #000;
        border: 1px solid #ddd;
        border-radius: 12px;
        cursor: pointer;
        transition: 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        border-color: #ffc107;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    .chart-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 12px;
        position: relative;
        height: 300px;
    }

    /* DARK MODE SUPPORT */
    .dark-mode .stats-card {
        background-color: #1f1f1f;
        color: #fff;
        border: 1px solid #444;
    }

    .dark-mode .chart-container {
        background-color: #1f1f1f;
    }
</style>
@endpush