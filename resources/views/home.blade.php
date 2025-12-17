@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center text-white">

    <h2>Welcome, {{ Auth::user()->name }}</h2>
    <p>Track and manage your phone repairs.</p>

    @if($pending + $repairing + $ready + $delivered == 0)

        <div class="alert alert-info mt-4">
            You haven’t submitted any repair request yet.
        </div>

        <a href="{{ route('customer.complaints.create') }}" class="btn btn-success px-4 py-2 mt-3">
            + Add First Complaint
        </a>

    @else

        <div class="row text-center mt-4">
            <div class="col-md-3 mb-3">
                <div class="card bg-dark p-3 shadow">
                    <h4>{{ $pending }}</h4>
                    <p>Pending</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-dark p-3 shadow">
                    <h4>{{ $repairing }}</h4>
                    <p>Repairing</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-dark p-3 shadow">
                    <h4>{{ $ready }}</h4>
                    <p>Ready</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-dark p-3 shadow">
                    <h4>{{ $delivered }}</h4>
                    <p>Delivered</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('customer.complaints.index') }}" class="btn btn-primary px-4 py-2">
                View My Complaints
            </a>
        </div>

        @if($latestUpdate)
        <div class="card bg-dark text-white mt-5 p-3 shadow text-start">
            <h5>Latest Update</h5>
            <p><strong>Status:</strong> {{ $latestUpdate->status }}</p>
            <p><strong>Note:</strong> {{ $latestUpdate->note ?? 'No message yet.' }}</p>
        </div>
        @endif

    @endif

</div>
@endsection
