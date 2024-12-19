<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class GuestRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }


    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $guest = $this->create($request->all());

        Auth::guard('guest-hotel')->login($guest);

        return redirect()->route('home.index');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'FirstName' => ['required'],
            'LastName' => ['required'],
            'DateOfBirth' => ['required', 'date'],
            'Address' => ['required', 'string'],
            'Phone' => ['required', 'string', 'min:11'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:guests'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {

        return Guest::create([
            'FirstName' => $data['FirstName'],
            'LastName' => $data['LastName'],
            'DateOfBirth' => $data['DateOfBirth'],
            'Address' => $data['Address'],
            'Phone' => $data['Phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
