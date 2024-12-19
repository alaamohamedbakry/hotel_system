<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GuestLoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function login_submit(Request $request)
    {
        $hotel=Hotel::all();
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        $credentials = $request->only('email', 'password');
        if (Auth::guard('guest-hotel')->attempt($credentials)) {
            return redirect()->route('home.index')->with('hotel',$hotel);
        } else {
            return redirect()->route('guest_login')->with('error', 'Login unsuccessful');
        }
    }
    
    public function logout()
    {
        Auth::guard('guest-hotel')->logout();
        return redirect()->route('home.index')->with('success', 'Logout successfully');
    }
}
