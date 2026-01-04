<div>
    <!-- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead -->

    @extends('layouts.app')


    @section('content')
    <div class="container mt-4">

        <h3>All Complaints</h3>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-dark text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Device</th>
                    <th>Status</th>
                    <th>Assign Technician</th>
                    <th>Details</th>
                </tr>
            </thead>

            <tbody>
                @foreach($complaints as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->user->name }}</td>
                    <td>{{ $c->brand }} - {{ $c->model }}</td>

                    <td>
                        <span class="badge bg-warning text-dark">{{ $c->status }}</span>
                    </td>

                    <td>
                        <form action="{{ route('admin.complaints.assign', $c->id) }}" method="POST">
                            @csrf
                            <!-- <select name="technician_id" class="form-select d-inline-block w-50">
                                <option value="">Select</option>
                                @foreach($technicians as $t)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                                @endforeach
                            </select> -->

                            <select name="technician_id" class="form-select d-inline-block w-50">

                                {{-- Show assigned technician as the first selected option --}}
                                <option value="{{ $c->technician_id ?? '' }}" selected>
                                    {{ $c->technician->name ?? 'Select Technician' }}
                                </option>

                                {{-- List other technicians except the assigned one --}}
                                @foreach($technicians as $t)
                                @if($t->id != $c->technician_id)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                                @endif
                                @endforeach

                            </select>


                            <button class="btn btn-success btn-sm mt-2">Assign</button>
                        </form>
                    </td>

                    <td>
                        <button class="btn btn-info btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#viewModal{{ $c->id }}">
                            View
                        </button>
                    </td>

                </tr>

                <!-- Modal -->
                <div class="modal fade" id="viewModal{{ $c->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Complaint Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <strong>Customer:</strong> {{ $c->user->name }} <br>
                                <strong>Device:</strong> {{ $c->brand }} - {{ $c->model }} <br>
                                <strong>IMEI:</strong> {{ $c->imei ?? 'N/A' }} <br>
                                <strong>Current Status:</strong>
                                <span class="badge
            @if($c->status=='Pending') bg-warning text-dark
            @elseif($c->status=='In-Repair') bg-primary
            @elseif($c->status=='Ready') bg-success
            @elseif($c->status=='Delivered') bg-secondary
            @endif
            ">{{ $c->status }}
                                </span>

                                <br><br>
                                <div class="modal-body">
                                    <h6>Status Timeline</h6>

                                    @php
                                    $updates = App\Models\ComplaintUpdate::where('complaint_id', $c->id)->orderBy('id','asc')->get();
                                    @endphp
                                </div>

                                <style>
                                    .timeline {
                                        position: relative;
                                        margin-left: 20px;
                                        border-left: 3px solid #0dcaf0;
                                    }

                                    .timeline-item {
                                        position: relative;
                                        padding: 10px 15px;
                                        margin: 10px 0;
                                        background: #f1f1f1;
                                        border-radius: 6px;
                                    }

                                    .timeline-item::before {
                                        content: '';
                                        position: absolute;
                                        left: -11px;
                                        top: 12px;
                                        width: 16px;
                                        height: 16px;
                                        background: #0dcaf0;
                                        border-radius: 50%;
                                    }

                                    /* Default (light mode) */
                                    .modal-body {
                                        color: #111 !important;
                                    }

                                    /* When dark-mode class is active on <body> */
                                    .dark-mode .modal-body {
                                        color: #438cecff !important;
                                    }
                                </style>

                                @if($updates->count() == 0)
                                <p class="text-muted">No updates yet</p>
                                @else
                                <div class="timeline">
                                    @foreach($updates as $u)
                                    <div class="timeline-item">
                                        <strong>{{ $u->status }}</strong>
                                        <br>
                                        <small>{{ $u->created_at->format('d M Y - h:i A') }}</small>
                                        @if($u->note)
                                        <p class="mt-1">{{ $u->note }}</p>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                                @endif

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

                @endforeach
            </tbody>

        </table>

    </div>
    @endsection

</div>