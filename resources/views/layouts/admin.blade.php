<div>
    @extends('layouts.app')

@section('content')
<div class="container mt-4">

    <!-- <div class="mb-4">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light me-2">Dashboard</a>
        <a href="{{ route('technicians.index') }}" class="btn btn-outline-primary me-2">Technicians</a>
        <a href="{{ route('admin.complaints.index') }}" class="btn btn-outline-warning me-2">Complaints</a>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-info me-2">Customers</a>
    </div> -->

    @yield('admin-content')

</div>
@endsection

</div>
