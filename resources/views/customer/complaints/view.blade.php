<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    @extends('customer.dashboard')

    @section('content')
    <div class="container  mt-4">

        <h3 class="mb-4">Complaint Details</h3>

        <div class="mb-4">
            <strong>Device:</strong> {{ $complaint->brand }} - {{ $complaint->model }} <br>
            <strong>IMEI:</strong> {{ $complaint->imei ?? 'N/A' }} <br>
            <strong>Status:</strong>
            <span class="badge 
    @if($complaint->status == 'Pending') bg-warning text-dark
    @elseif($complaint->status=='In-Repair') bg-primary
    @elseif($complaint->status=='Ready') bg-success
    @elseif($complaint->status=='Delivered') bg-secondary
    @endif
  ">{{ $complaint->status }}</span>
        </div>

        <style>
            .timeline {
                position: relative;
                margin-left: 25px;
                border-left: 3px solid #097918ff;
            }

            .timeline-item {
                position: relative;
                padding: 15px 20px;
                margin: 10px 0;
                background: #f8f0f0ff;
                border-radius: 6px;
                color: black;
            }

            .timeline-item::before {
                content: '';
                position: absolute;
                left: -11px;
                top: 15px;
                width: 18px;
                height: 18px;
                background: #067014ff;
                border-radius: 50%;
            }

            .qr-box {
                width: 280px !important;
                height: 280px !important;
                border-radius: 10%;
                margin: auto;
            }

            .text-info {
                color: green !important;
            }
        </style>

        <h5 class="mb-3">Repair Status Timeline</h5>

        @if($updates->count() == 0)
        <div class="alert alert-warning">No updates yet</div>
        @else

        <div class="timeline">
            @foreach($updates as $u)
            <div class="timeline-item">
                <strong>{{ $u->status }}</strong><br>
                <small class="text-info">{{ $u->created_at->format('d M Y - h:i A') }}</small>

                @if($u->note)
                <p class="mt-2">{{ $u->note }}</p>
                @endif
            </div>
            @endforeach
        </div>


        @endif

    </div>
    @endsection

    @if($qrCode)
    <div class="card bg-dark text-white mt-4 p-3 shadow text-center">
        <h5>📦 Device Ready for Pickup</h5>
        <p>Scan this QR to confirm delivery</p>

        <div class="qr-box d-inline-block p-2 rounded bg-white text-center">
            {!! $qrCode !!}
           <br> <strong style="color: black;">Order ID: {{ $complaint->id }}</strong>
        </div>

    </div>
    @endif



</body>

</html>