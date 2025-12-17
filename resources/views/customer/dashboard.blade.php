@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">

    <h2 class="mb-4 text-white">Hello, {{ Auth::user()->name }}</h2>

    <div class="d-flex justify-content-center gap-3 flex-wrap">

        <!-- My Complaints Button -->
        <a href="{{ route('customer.complaints.index') }}" class="btn btn-warning btn-lg px-4">
            📌 My Complaints
        </a>

        <!-- Create Complaint Button -->
        <a href="{{ route('customer.complaints.create') }}" class="btn btn-success btn-lg px-4">
            ➕ New Complaint
        </a>

    </div>

    <div class="mt-5 text-white">
        <p>You can submit a new repair request and track your device repair status here.</p>
    </div>

</div>
@endsection
