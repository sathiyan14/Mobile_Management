<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Device Ready for Pickup</title>
</head>

<body>

    @extends('tech.dashboard')

    @section('content')
    <div class="container mt-5">
        <div style="text-align: center; background-color: #fff3e0; padding: 40px; border-radius: 8px;">
            <h2 class="text-warning" style="margin-bottom: 20px;">
                ⚠ Device Ready for Pickup
            </h2>
            
            <div style="background-color: white; padding: 30px; border-radius: 8px; display: inline-block; margin-bottom: 30px;">
                <p style="font-size: 16px; margin: 10px 0;">
                    <strong>Device:</strong> {{ $complaint->brand }} - {{ $complaint->model }}
                </p>
                <p style="font-size: 16px; margin: 10px 0;">
                    <strong>Complaint ID:</strong> #{{ $complaint->id }}
                </p>
                <p style="font-size: 16px; margin: 10px 0;">
                    <strong>Status:</strong> <span style="background-color: #ff9800; color: white; padding: 5px 10px; border-radius: 4px;">Ready for Pickup</span>
                </p>
            </div>

            @if(!empty($qrWeb))
            <div style="background-color: white; padding: 30px; border-radius: 8px; display: inline-block; margin: 20px 0;">
                <p style="font-size: 14px; color: #555; margin-bottom: 20px;">
                    <strong>QR Code for Verification:</strong>
                </p>
                <div style="padding: 15px; background-color: #f5f5f5; border-radius: 8px;">
                    {!! $qrWeb !!}
                </div>
                <p style="font-size: 12px; color: #888; margin-top: 15px;">
                    Share this code with the customer or display it at pickup.
                </p>
            </div>
            @endif

            <div style="margin-top: 30px;">
                <p style="font-size: 14px; color: #666; margin-bottom: 20px;">
                    A confirmation email with the QR code has been sent to the customer.
                </p>
                <a href="{{ route('tech.complaints.index') }}" class="btn btn-primary" style="padding: 10px 30px; font-size: 16px; margin-right: 10px;">
                    Back to Complaints
                </a>
                <a href="{{ route('delivery.verify', $complaint->id) }}" class="btn btn-success" style="padding: 10px 30px; font-size: 16px;">
                    Confirm Pickup with QR
                </a>
            </div>
        </div>
    </div>
    @endsection

</body>

</html>
