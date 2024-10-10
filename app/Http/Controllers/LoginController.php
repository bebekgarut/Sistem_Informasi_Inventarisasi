<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    // public function authenticate(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'username' => 'required',
    //         'password' => 'required'
    //     ]);

    //     $user = User::where('username', $credentials['username'])->first();

    //     if ($user && $user->password === $credentials['password']) {

    //         Auth::login($user);

    //         $request->session()->regenerate();

    //         if ($user->role == 'admin') {
    //             return redirect()->intended('/home');
    //         } else if ($user->role == 'upb') {
    //             return redirect()->route('home-upb', ['KODE_UPB' => $user->KODE_UPB]);
    //         }
    //     }

    //     return back()->with('gagal', 'Username atau Password salah!!!');
    // }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {

            if (Auth::User()->role == 'admin') {
                $request->session()->regenerate();

                return redirect()->intended('/home');
            } else if (Auth::User()->role == 'upb') {
                $request->session()->regenerate();

                return redirect()->route('home-upb', ['KODE_UPB' => Auth::user()->KODE_UPB]);;
            }
        }
        return back()->with('gagal', 'Username atau Password salah!!!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
