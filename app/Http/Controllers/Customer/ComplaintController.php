<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ComplaintUpdate;
use App\Services\QrService;


class ComplaintController extends Controller
{

    public function index()
    {
        $complaints = Complaint::where('user_id', Auth::id())->get();
        return view('customer.complaints.index', compact('complaints'));
    }

    public function create()
    {
        return view('customer.complaints.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'model' => 'required',
            'brand' => 'required',
            'imei' => 'required',
            'issue_description' => 'required'
        ]);

        $complaint = Complaint::create([
            'user_id' => Auth::id(),
            'brand' => $request->brand,
            'model' => $request->model,
            'imei' => $request->imei,
            'issue_description' => $request->issue_description,
            'status' => 'Pending'
        ]);

        // create timeline entry
        ComplaintUpdate::create([
            'complaint_id' => $complaint->id,
            'status' => 'Registered',
            'note' => $complaint->issue_description
        ]);

        return redirect()->route('customer.complaints.index')->with('success', 'Complaint submitted successfully!');
    }

    public function view($id)
    {
        $complaint = Complaint::findOrFail($id);

        $complaints = Complaint::where('user_id', Auth::id())->get();

        $updates = ComplaintUpdate::where('complaint_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        $qrCode = null;

        if ($complaint->status === 'Ready') {
            $url = url('/verify-delivery/' . $complaint->id);   
           $qrCode = QrService::forWeb($url, 200);
        }   

        return view('customer.complaints.view', compact('complaint','complaints', 'updates', 'qrCode'));

    }

    public function destroy($id)
    {
        $complaint = Complaint::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Only allow deletion if the complaint is not yet processed
        if (in_array($complaint->status, ['Pending', 'Registered'])) {
            $complaint->delete();
            return redirect()->route('customer.complaints.index')->with('success', 'Complaint deleted successfully!');
        } else {
            return redirect()->route('customer.complaints.index')->with('error', 'Cannot delete a complaint that is already being processed or completed.');
        }
    }
}
