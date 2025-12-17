<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;
use App\Models\ComplaintUpdate;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
  public function index()
{
    $userId = Auth::id();

    $pending = Complaint::where('user_id', $userId)->where('status', 'Pending')->count();
    $repairing = Complaint::where('user_id', $userId)->where('status', 'In-Repair')->count();
    $ready = Complaint::where('user_id', $userId)->where('status', 'Ready')->count();
    $delivered = Complaint::where('user_id', $userId)->where('status', 'Delivered')->count();

    $latestUpdate = ComplaintUpdate::whereHas('complaint', function ($query) use ($userId) {
        $query->where('user_id', $userId);
    })
    ->latest()
    ->first();

    return view('home', compact('pending', 'repairing', 'ready', 'delivered', 'latestUpdate'));
}

}
