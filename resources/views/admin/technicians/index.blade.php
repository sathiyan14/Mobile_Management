<div>
    <!-- Nothing worth having comes easy. - Theodore Roosevelt -->

    @extends('layouts.admin')

    @section('admin-content')
    <div class="container mt-4">
        <h3>Technicians List</h3>

        <a href="{{ route('technicians.create') }}" class="btn btn-primary my-3">
            + Add Technician
        </a>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-dark table-striped" style="text-align:center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>phone</th>
                    <th>address</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($techs as $tech)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tech->name }}</td>
                    <td>{{ $tech->email }}</td>
                    <td>{{ $tech->phone }}</td>
                    <td>{{ $tech->address }}</td>
                    <!-- <td>
                        <form action="{{ route('technicians.delete', $tech->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td> -->
                    <td>
                        <a href="{{ route('technicians.edit', $tech->id) }}" class="btn btn-primary btn-sm">Edit</a>

                        <form action="{{ route('technicians.delete', $tech->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    @endsection

</div>