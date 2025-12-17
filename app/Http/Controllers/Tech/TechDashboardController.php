<?php

namespace App\Http\Controllers\Tech;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TechDashboardController extends Controller
{
    //
    public function index()
    {
        return view('tech.dashboard');
    }
}
