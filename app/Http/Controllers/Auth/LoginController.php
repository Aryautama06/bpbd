<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->with('loginError', [
                    'type' => 'error',
                    'title' => 'Akun Tidak Ditemukan',
                    'message' => 'Email yang Anda masukkan belum terdaftar.'
                ]);
        }

        return redirect()->back()
            ->withInput($request->only('email'))
            ->with('loginError', [
                'type' => 'error',
                'title' => 'Login Gagal',
                'message' => 'Password yang Anda masukkan salah.'
            ]);
    }
}