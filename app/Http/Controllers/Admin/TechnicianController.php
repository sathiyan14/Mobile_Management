<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class TechnicianController extends Controller
{
    //

    // List
    public function index()
    {
        $techs = User::where('role', 'technician')->get();
        return view('admin.technicians.index', compact('techs'));
    }

    // Create Form
    public function create()
    {
        return view('admin.technicians.create');
    }

    // Store Technician
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => ['required', 'regex:/^[6-9]\d{9}$/'],
            'address' => 'required|string'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 'technician'
        ]);

        return redirect()->route('technicians.index')->with('success', 'Technician Added!');
    }

    // Delete Technician
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Technician Removed!');
    }

    public function edit($id)
    {
        $tech = User::findOrFail($id);
        return view('admin.technicians.edit', compact('tech'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|min:10',
            'address' => 'nullable|string'
        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('technicians.index')->with('success', 'Technician Updated!');
    }
}
