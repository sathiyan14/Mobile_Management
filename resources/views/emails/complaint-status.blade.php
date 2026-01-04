<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px;">

    <div style="background-color: #007bff; color: white; padding: 20px; border-radius: 8px 8px 0 0; text-align: center;">
        <h2 style="margin: 0;">Complaint Status Update</h2>
    </div>

    <div style="padding: 20px; background-color: #fff;">
        <p style="font-size: 16px; color: #333;">Hi <strong>{{ $user->name }}</strong>,</p>

        <p style="font-size: 14px; color: #555;">Your device repair status has been updated:</p>

        <div style="background-color: #e8f4f8; padding: 15px; border-left: 4px solid #007bff; margin: 15px 0; border-radius: 4px;">
            <p style="margin: 5px 0; font-size: 14px;">
                <strong>Device:</strong> {{ $complaint->brand }} - {{ $complaint->model }}
            </p>
            <p style="margin: 5px 0; font-size: 14px;">
                <strong>Status:</strong> <span style="background-color: #007bff; color: white; padding: 5px 10px; border-radius: 4px;">{{ $status }}</span>
            </p>
            <p style="margin: 5px 0; font-size: 14px;">
                <strong>Complaint ID:</strong> #{{ $complaint->id }}
            </p>
        </div>

        @if($status === 'Ready' && !empty($qrSvg))
        <div style="text-align: center; margin: 20px 0; padding: 20px; background-color: #f0f0f0; border-radius: 8px;">
            <p style="font-size: 14px; color: #555; margin-bottom: 15px;">
                <strong>Your device is ready for pickup!</strong>
            </p>
            <p style="font-size: 12px; color: #888; margin-bottom: 15px;">
                Scan this QR code when collecting your device:
            </p>
            <div style="display: flex; justify-content: center; margin: 15px 0; background-color: white; padding: 10px; border-radius: 8px;">


                <img src="data:image/png;base64,{{ $qrCode }}"
                    alt="QR Code"
                    width="250"
                    height="250"
                    style="
        border:2px solid #007bff;
        border-radius:8px;
        padding:6px;
        display:block;
        margin:auto;
     ">


            </div>
            <p style="font-size: 11px; color: #666; margin-top: 10px;">
                Complaint ID: <strong>#{{ $complaint->id }}</strong>
            </p>
        </div>
        @elseif($status === 'Ready')
        <div style="text-align: center; margin: 20px 0; padding: 20px; background-color: #fff3cd; border: 1px solid #ffc107; border-radius: 8px;">
            <p style="font-size: 14px; color: #856404;">
                <strong>⚠ Device is ready for pickup!</strong>
            </p>
            <p style="font-size: 12px; color: #856404;">
                Complaint ID: <strong>#{{ $complaint->id }}</strong>
            </p>
        </div>
        @endif

        <p style="font-size: 12px; color: #888; margin-top: 20px;">
            Thank you for choosing our service. If you have any questions, please contact us.
        </p>
    </div>

    <div style="background-color: #f0f0f0; padding: 15px; border-radius: 0 0 8px 8px; text-align: center; font-size: 12px; color: #666;">
        <p style="margin: 0;">Mobile Service Center</p>
        <p style="margin: 5px 0;">© 2025. All rights reserved.</p>
    </div>

</div>