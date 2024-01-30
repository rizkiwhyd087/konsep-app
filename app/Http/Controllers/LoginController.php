<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Login Page'
        );

        return view('auth.login', $data);
    }

    public function prosesLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            if (Auth::user()->role == 'admin') {
                return redirect('/admin');
            } else if (Auth::user()->role == 'pembeli') {
                return redirect('/pembeli');
            } else if (Auth::user()->role == 'penyelenggara') {
                return redirect('/penyelenggara');
            } else {
                return redirect('');
            }
        } else {
            return redirect('');
        }
    }

    public function regis()
    {
        $data = array(
            'title' => 'Regis Page'
        );

        return view('auth.regis', $data);
    }

    public function prosesRegis(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pembeli',
        ]);

        return redirect('');
    }

    public function prosesLogout()
    {
        Auth::logout();
        return redirect('');
    }
}
