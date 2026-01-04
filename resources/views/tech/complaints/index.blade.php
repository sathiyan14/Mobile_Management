<div>
    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->

    @extends('tech.dashboard')

    @section('content')
    <div class="container mt-4">

        <h3>Assigned Complaints</h3>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-dark text-center align-middle" style="text-align:center">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Device</th>
                    <th>Status</th>
                    <th>Update</th>
                </tr>
            </thead>

            <tbody>
                @foreach($complaints as $c)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $c->brand }} - {{ $c->model }}</td>

                    <td>
                        <span class="badge
            @if($c->status=='Pending') bg-warning text-dark
            @elseif($c->status=='In-Repair') bg-primary
            @elseif($c->status=='Ready') bg-success
            @elseif($c->status=='Delivered') bg-secondary
            @endif
        ">
                            {{ $c->status }}
                        </span>
                    </td>

                    <td>
                        <!-- Update Status Modal Button -->
                        <button class="btn btn-info btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#updateModal{{ $c->id }}">
                            Update
                        </button>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="updateModal{{ $c->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Update Status</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form action="{{ route('tech.complaints.update',$c->id) }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <label>Status</label>
                                    <select name="status" class="form-select mb-3">
                                        <option>Pending</option>
                                        <option>In-Repair</option>
                                        <option>Ready</option>
                                        <option>Delivered</option>
                                    </select>

                                    <label>Note (optional)</label>
                                    <textarea name="note" class="form-control"></textarea>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-success w-100">Update</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                @endforeach
            </tbody>
        </table>

    </div>
    @endsection


</div>