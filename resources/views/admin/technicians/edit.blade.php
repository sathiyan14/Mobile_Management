<div>
    <!-- An unexamined life is not worth living. - Socrates -->
    @extends('layouts.admin')

    @section('admin-content')

    <div class="container mt-4">

        <h3>Edit Technician</h3>

        <form action="{{ route('technicians.update', $tech->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ $tech->name }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ $tech->email }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" value="{{ $tech->phone }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control">{{ $tech->address }}</textarea>
            </div>

            <button class="btn btn-success">Update Technician</button>

        </form>
    </div>
    @endsection

</div>