<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        try {
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
                // Mengembalikan respons jika login berhasil
                return redirect()->route("dashboard")->with('success', 'Login success! Welcome back ' . auth()->user()->username);
            } else {
                // Mengembalikan respons jika email atau password salah
                return back()->with('error', "Email or password is incorrect");
            }         
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Login failed!');
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("login"); 
    }
}

