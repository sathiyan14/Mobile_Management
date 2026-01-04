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
        <div style="text-align: center; padding: 40px; border-radius: 8px;">
            <h2 style="margin-bottom: 20px;">
                ⚠ Device Ready for Pickup
            </h2>

            <div style="text-align: start; padding: 30px; border-radius: 8px; display: inline-block; margin-bottom: 30px;">
                <p style="font-size: 16px; margin: 10px 0;">
                    <strong>Device:</strong> {{ $complaint->brand }} - {{ $complaint->model }}
                </p>
                <p style="font-size: 16px; margin: 10px 0;">
                    <strong>Complaint ID:</strong> #{{ $complaint->id }}
                </p>
                <p style="font-size: 16px; margin: 10px 0;">
                    <strong>Status:</strong> <span style="background-color: #ff9800; color: white; padding: 5px 10px; border-radius: 4px;">Ready for Pickup</span>
                </p>

                @if(!empty($qrWeb))
                <div style=" border-radius: 8px; display: inline-block; margin: 20px 0;">
                    <p style="font-size: 14px; margin-bottom: 20px; text-align: center;">
                        <strong>QR Code for Verification:</strong>
                    </p>
                    <div style="padding: 15px; border-radius: 8px;">
                        {!! $qrWeb !!}
                    </div>
                    <p style="font-size: 12px; margin-top: 15px;">
                        Share this code with the customer or display it at pickup.
                    </p>
                </div>
                @endif
            </div>

            <div>
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