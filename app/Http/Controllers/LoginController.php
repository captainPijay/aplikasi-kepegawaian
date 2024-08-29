<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function authenticate(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username harus diisi.',
            'password.required' => 'Password harus diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $validator->validated();

        if (Auth::guard('pegawai')->attempt($credentials)) {
            $request->session()->regenerate();
            flash('Berhasil Login Pegawai');
            return redirect()->intended('/back-office/pegawai');
        }
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            flash('Berhasil Login Users');
            return redirect()->intended('/back-office/dashboard');
        }

        return back()->withErrors([
            'username' => 'Data Tidak Sesuai',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        flash('Berhasil Logout');
        return redirect('/login');
    }
}
