<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        try {
            $is_logged = Auth::check();
            if ($is_logged) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Zaten giriş yaptınız',
                    ]);
                }

                return redirect()->route('admin.dashboard');
            }

            if (Auth::attempt($request->only('email', 'password'))) {
                $request->session()->regenerate();

                if ($request->expectsJson()) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Giriş başarılı',
                    ]);
                }

                return redirect()->route('admin.dashboard');
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Giriş bilgileri hatalı',
                ]);
            }

            return redirect()->back()
                ->with('error', 'Giriş bilgileri hatalı');
        } catch (Exception $ex) {
            return redirect()->back()
                ->with('error', $ex->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();

        if (request()->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Çıkış yapıldı',
            ]);
        }

        return redirect()->route('admin.login');
    }
}
