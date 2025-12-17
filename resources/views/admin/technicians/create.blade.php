<div>
    <!-- Very little is needed to make a happy life. - Marcus Aurelius -->

    @extends('layouts.app')


    @section('content')
    <div class="container mt-4">

        <h3>Add Technician</h3>

        <form action="{{ route('technicians.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Mobile Number</label>
                <input type="text" name="phone" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control">
            </div>

            <button class="btn btn-success">Save</button>

        </form>
    </div>
    @endsection

</div>