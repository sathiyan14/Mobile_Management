<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Confirmed</title>
</head>

<body>

    @extends('tech.dashboard')

    @section('content')
    <div class="container mt-5">
        <div style="text-align: center; background-color: #e8f5e9; padding: 40px; border-radius: 8px;">
            <h2 class="text-success" style="margin-bottom: 20px;">
                ✔ Delivery Confirmed
            </h2>
            
            <div style="background-color: white; padding: 30px; border-radius: 8px; display: inline-block;">
                <p style="font-size: 16px; margin: 10px 0;">
                    <strong>Device:</strong> {{ $complaint->brand }} - {{ $complaint->model }}
                </p>
                <p style="font-size: 16px; margin: 10px 0;">
                    <strong>Complaint ID:</strong> #{{ $complaint->id }}
                </p>
                <p style="font-size: 16px; margin: 10px 0;">
                    <strong>Status:</strong> <span style="background-color: #4caf50; color: white; padding: 5px 10px; border-radius: 4px;">Delivered</span>
                </p>
                <p style="font-size: 14px; color: #666; margin-top: 20px;">
                    A confirmation email has been sent to the customer.
                </p>
            </div>

            <div style="margin-top: 30px;">
                <a href="{{ route('tech.complaints.index') }}" class="btn btn-primary" style="padding: 10px 30px; font-size: 16px;">
                    Back to Complaints
                </a>
            </div>
        </div>
    </div>
    @endsection

</body>

</html>