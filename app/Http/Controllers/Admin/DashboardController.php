<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Complaint;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('admin.dashboard', [
            'totalComplaints' => Complaint::count(),
            'pending' => Complaint::where('status', 'Pending')->count(),
            'repairing' => Complaint::where('status', 'In-Repair')->count(),
            'ready' => Complaint::where('status', 'Ready')->count(),
            'delivered' => Complaint::where('status', 'Delivered')->count(),
            'technicians' => User::where('role', 'technician')->count(),
            'customers' => User::where('role', 'customer')->count(),
        ]);
    }

    public function customers()
    {
       $customers = User::where('role', 'customer')->get();
        return view('admin.customers.index', compact('customers'));
    }
}
