<div>
  @extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h2>Hello, {{ Auth::user()->name }}</h2>
    <p>All Assigned Repair Tasks</p>

    <a href="{{ route('tech.complaints.index') }}" class="btn btn-primary mt-3">
        View Assigned Complaints
    </a>
</div>
@endsection


</div>

