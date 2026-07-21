<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function loginView()
    {
        return view('login');
    }

    public function goLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function loginEtam($id, Request $request){
        $user = User::findOrFail($id);

        // 2. Login pengguna secara otomatis tanpa password
        Auth::login($user);

        // 3. Regenerasi session untuk keamanan
        $request->session()->regenerate();

        // 4. Alihkan ke halaman dashboard
        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
