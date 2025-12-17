<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated($request, $user)
    {
        if ($user->role == 'admin') {
            return redirect('/admin/dashboard');
        }

        if ($user->role == 'technician') {
            return redirect('/tech/dashboard');
        }

        return redirect('/customer/dashboard'); // customer
    }

   protected function redirectTo()
{
    $user = Auth::user(); // this prevents the "undefined" error

    if ($user->role === 'admin') {
        return '/admin/dashboard';
    }

    if ($user->role === 'technician') {
        return '/tech/dashboard';
    }

    return '/customer/dashboard'; // customer default
}
}
