<div>
    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->

    @extends('layouts.app')

    @section('content')
    <div class="container mt-4">
        <h3>Customers List</h3>

        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
            </thead>

            <tbody>
                @foreach($customers as $c)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->email }}</td>
                    <td>{{ $c->phone }}</td>
                    <td>{{ $c->address }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    @endsection

</div>