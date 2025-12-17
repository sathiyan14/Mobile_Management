@extends('customer.dashboard')

@section('content')
<div class="container mt-4">

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addComplaintModal">
        + New Complaint
    </button>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-dark text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Device</th>
                <th>Status</th>
                <th>Repair Update</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            @foreach($complaints as $complaint)
            <tr class="text-white">

                <td>{{ $loop->iteration }}</td>
                <td> {{ $complaint->brand }} - {{ $complaint->model }}</td>
                <!-- Colored status badge -->
                <td>
                    @if($complaint->status == 'Pending')
                    <span class="badge bg-warning text-dark">⏳ Pending</span>
                    @elseif($complaint->status == 'In-Repair')
                    <span class="badge bg-info text-dark">🔧 Repairing</span>
                    @elseif($complaint->status == 'Ready')
                    <span class="badge bg-primary">📦 Ready</span>
                    @elseif($complaint->status == 'Delivered')
                    <span class="badge bg-success">✔ Delivered</span>
                    @endif
                </td>

                <td>
                    @php
                    $note = $complaint->updates->whereNotNull('note')->last();
                    @endphp

                    @if($note)
                    {{ $note->note }}
                    @else
                    <span class="text-muted">No updates yet</span>
                    @endif
                </td>


                <td>
                    <a href="{{ route('customer.complaints.view', $complaint->id) }}"
                        class="btn btn-sm btn-light">
                        View Status →
                    </a>

                    <form action="{{ route('customer.complaints.delete', $complaint->id) }}" 
                    method="post" onsubmit="return confirm('Are you sure you want to delete this complaint?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="custom-btn  mt-2">
                            Delete ❌
                        </button>
                    </form>
                </td>

            </tr>
            @endforeach

        </tbody>
    </table>
</div>


<!-- Modal -->
<div class="modal fade" id="addComplaintModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Register Complaint</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('customer.complaints.store') }}">
                @csrf
                <div class="modal-body">

                    <label class="form-label">Brand</label>
                    <input type="text" name="brand" class="form-control mb-3" required>

                    <label class="form-label">Model</label>
                    <input type="text" name="model" class="form-control mb-3" required>

                    <label class="form-label">IMEI (optional)</label>
                    <input type="text" name="imei" class="form-control mb-3">

                    <label class="form-label">Issue Description</label>
                    <textarea name="issue_description" class="form-control mb-3" required></textarea>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success w-100">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

<style>
    table.table-dark tbody tr td form {
        display: inline-block;
    }
      table.table-dark tbody tr td form button{
        background-color: red;
        border: none;
        color: white;
        padding:5px 10px 10px 10px;
        text-align: center;
        text-decoration: none;
        /* display: inline-block; */
        font-size: 14px;
        border-radius: 4px;
        cursor: pointer;
    }
          table.table-dark tbody tr td form button:hover{
          background-color: darkred;
          }
</style>