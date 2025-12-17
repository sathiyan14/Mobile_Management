<div>
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->

    @extends('customer.dashboard')

    @section('content')
    <div class="container mt-4 w-50">

        <h3>Register Complaint</h3>

        <form method="POST" action="{{ route('customer.complaints.store') }}">
            @csrf

            <label>Brand</label>
            <input type="text" name="brand" class="form-control mb-2">

            <label>Model</label>
            <input type="text" name="model" class="form-control mb-2">

            <label>IMEI (optional)</label>
            <input type="text" name="imei" class="form-control mb-2">

            <label>Issue Description</label>
            <textarea name="issue_description" class="form-control mb-2"></textarea>

            <button class="btn btn-dark w-100">Submit</button>

        </form>
    </div>
    @endsection

</div>