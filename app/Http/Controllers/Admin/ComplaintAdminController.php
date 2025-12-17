<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ComplaintUpdate;

class ComplaintAdminController extends Controller
{
    //

    public function index()
    {
        $complaints = Complaint::with('user')->get();
        $technicians = User::where('role', 'technician')->get();
        return view('admin.complaints.index', compact('complaints', 'technicians'));
    }

    public function assign(Request $request, $id)
    {
        $request->validate(['technician_id' => 'required']);


        // Get complaint
        $complaint = Complaint::findOrFail($id);

        // Get technician
        $technician = User::findOrFail($request->technician_id);

        // Update complaint table
        $complaint->update([
            'technician_id' => $technician->id,
            'status' => 'In-Repair',
        ]);


        // Complaint::where('id', $id)->update([
        //     'technician_id' => $request->technician_id,
        //     'status' => 'In-Repair'
        // ]);

        ComplaintUpdate::create([
            'complaint_id' => $complaint->id,
            'status' => 'Technician Assigned',
            'note' => 'Assigned to ' . $technician->name
        ]);


        return back()->with('success', 'Technician Assigned!');
    }
}
