<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('admin.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        try {
            // Register user
             $user = User::create($request->validated());
             Auth::login($user);

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Kayıt başarılı',
                ]);
            }

            return redirect()->route('admin.dashboard');
        } catch (\Exception $ex) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $ex->getMessage(),
                ]);
            }

            return redirect()->back()
                ->with('error', $ex->getMessage());
        }
    }
}
