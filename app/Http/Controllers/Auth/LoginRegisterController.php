<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class LoginRegisterController extends Controller
{


    public function register() {
        return view('auth.register');
    }

    public function login(){
        return view('auth.login');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed'
            // password: Wajib diisi, harus minimal 8 karakter, dan harus dikonfirmasi (harus ada field konfirmasi password, biasanya dinamai password_confirmation, yang harus cocok dengan password).
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]); 

        // Metode login ini menerima objek pengguna (dalam hal ini objek $user dari model User) dan langsung mengautentikasi pengguna tersebut, tanpa perlu memasukkan kredensial (email dan password) melalui form login.
        Auth::login($user);

        return redirect()->route('dashboard')
            ->withSuccess('You have successfully registered & logged in!');
    }

    public function authenticate(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('dashboard') // nama route
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ]);
    }

    public function dashboard(){
        
        if(Auth::check()) {
            return view('auth.dashboard');
        }

        return redirect()->route('login')
            ->withErrors('Please login to access the dashboard');
    }

    public function logout(Request $request){
        // Logout  pengguna dari sesi authentikasi
        Auth::logout();

        // Invalidasi sesi saat ini, agar tidak ada data sesi yang tersisa
        $request->session()->invalidate();

        // Regenerasi token CSRF untuk mencegah penyalahgunaan token lama
        $request->session()->regenerateToken();

        // Redirect kembali ke halaman login
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');
    }
}
