<?php

namespace App\Http\Controllers\Tech;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\ComplaintUpdate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Mail\ComplaintStatusMail;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Services\QrService;
use Illuminate\Support\Facades\Log;


class TechComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::where('technician_id', Auth::id())->get();
        return view('tech.complaints.index', compact('complaints'));
    }

    // public function updateStatus(Request $request, $id)
    // {
    //     $request->validate([
    //         'status' => 'required',
    //         'note' => 'nullable'
    //     ]);

    //     $complaint = Complaint::findOrFail($id);

    //     $complaint->update([
    //         'status' => $request->status
    //     ]);

    //     $lastUpdate = ComplaintUpdate::where('complaint_id', $id)
    //         ->latest()
    //         ->first();

    //     $statusLabel = match ($request->status) {
    //         'In-Repair' => 'Repair Started',
    //         'Ready' => 'Ready for Pickup',
    //         'Delivered' => 'Delivered',
    //         default => $request->status,
    //     };

    //     if (!$lastUpdate || $lastUpdate->status !== $statusLabel) {
    //         ComplaintUpdate::create([
    //             'complaint_id' => $id,
    //             'status' => $statusLabel,
    //             'note' => $request->note
    //         ]);
    //     }

    //     $qrWeb = null;
    //     $qrEmail = null;

    //     if ($request->status === 'Ready') {
    //         try {

    //             $url = url('/verify-delivery/' . $complaint->id);

    //             $qrEmail = QrService::forEmail($url);

    //             Mail::to($complaint->user->email)->send(
    //                 new ComplaintStatusMail(
    //                     $complaint->user,
    //                     'Ready',
    //                     $complaint,
    //                     $qrEmail   
    //                 )
    //             );
    //         } catch (\Throwable $e) {
    //             Log::error('QR / Mail error: ' . $e->getMessage());
    //         }
    //    }

    //     return back()->with('success', 'Status Updated & Email Sent!');
    // }

    public function showReady($id)
    {
        $complaint = Complaint::findOrFail($id);

        if ($complaint->status !== 'Ready') {
            return redirect()->route('tech.complaints.index')
                ->with('error', 'This complaint is not in Ready status.');
        }

        $qrWeb = session('qrWeb');

        return view('tech.complaints.ready', compact('complaint', 'qrWeb'));
    }

    public function updateStatus(Request $request, $id)
    {
        $complaint = Complaint::findOrFail($id);

        // Update complaint status
        $complaint->status = $request->status;
        $complaint->save();

        // Create/Update complaint history entry
        ComplaintUpdate::create([
            'complaint_id' => $complaint->id,
            'status' => $request->status,
            'note' => $request->note ?? null,
        ]);

        // Defaults
        $qrWeb = null;
        $qrUrl = null;

        if ($request->status === 'Ready') {
            try {
                $url = url('/verify-delivery/' . $complaint->id);

                // Generate QR codes (SVG - no imagick needed)
                $qrWeb   = QrService::forWeb($url);
                $qrUrl   = $url;

                // Log for debugging
                Log::info('QR Generated for complaint ' . $id . ': URL=' . $url);
                Log::info('QR Web SVG length: ' . strlen($qrWeb));

                // Send mail with QR code data
                Mail::to($complaint->user->email)->send(
                    new ComplaintStatusMail(
                        $complaint->user,
                        'Ready',
                        $complaint,
                        $qrUrl
                    )
                );

                Log::info('Email sent to ' . $complaint->user->email);

                // Store web QR in session for the ready page
                session()->flash('qrWeb', $qrWeb);
                
                // Show ready page with QR code
                return redirect()->route('tech.complaints.ready', $complaint->id)
                    ->with('success', 'Status Updated & Email Sent!');
            } catch (\Throwable $e) {
                Log::error('QR/Mail error: ' . $e->getMessage());
                Log::error('Stack trace: ' . $e->getTraceAsString());
                return back()->with('error', 'Status updated but email failed: ' . $e->getMessage());
            }
        }

        // If status is Delivered, send confirmation email without QR
        if ($request->status === 'Delivered') {
            try {
                Log::info('Sending Delivered email for complaint ' . $id);

                Mail::to($complaint->user->email)->send(
                    new ComplaintStatusMail(
                        $complaint->user,
                        'Delivered',
                        $complaint,
                        null
                    )
                );

                Log::info('Delivered confirmation email sent to ' . $complaint->user->email);

                return back()->with('success', 'Status Updated to Delivered & Confirmation Email Sent!');
            } catch (\Throwable $e) {
                Log::error('Delivered email error: ' . $e->getMessage());
                Log::error('Stack trace: ' . $e->getTraceAsString());
                return back()->with('error', 'Status updated but email failed: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Status Updated!');
    }

    public function verifyDelivery($id)
    {
        $complaint = Complaint::findOrFail($id);

        // Safety check
        if ($complaint->status !== 'Ready') {
            return redirect()->route('tech.dashboard')
                ->with('error', 'This device is not ready for delivery.');
        }

        // Update complaint
        $complaint->update([
            'status' => 'Delivered'
        ]);

        // Timeline entry
        ComplaintUpdate::create([
            'complaint_id' => $complaint->id,
            'status' => 'Delivered',
            'note' => 'Device handed over after QR verification'
        ]);

        Mail::to($complaint->user->email)->send(
            new ComplaintStatusMail(
                $complaint->user,
                'Delivered',
                $complaint
            )
        );


        return view('tech.complaints.delivered', compact('complaint'))
            ->with('success', 'Delivery confirmed successfully!');
    }
}
