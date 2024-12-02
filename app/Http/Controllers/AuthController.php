<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\Owner;
use App\Models\Kustomer;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,pegawai,owner,kustomer',
        ]);

        // Create User
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Create related role entry
        if ($request->role === 'pegawai') {
            Pegawai::create([
                'username' => $request->username,
                'no_telepon' => $request->no_telepon ?? '',
                'user_id' => $user->id,
            ]);
        } elseif ($request->role === 'owner') {
            Owner::create([
                'username' => $request->username,
                'user_id' => $user->id,
            ]);
        } elseif ($request->role === 'kustomer') {
            Kustomer::create([
                'username' => $request->username,
                'password' => $user->password,
                'user_id' => $user->id,
            ]);
        }

        return response()->json(['message' => 'Registration successful'], 201);
    }


    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Jika berhasil login, cek role dan arahkan ke halaman sesuai
            $user = Auth::user();
            if ($user->role == 'owner') {
                return redirect()->route('owner.dashboard'); // Ganti dengan route yang sesuai
            } elseif ($user->role == 'pegawai') {
                return redirect()->route('pegawai.dashboard'); // Ganti dengan route yang sesuai
            }
        }

        // Jika gagal login
        return redirect()->back()->withErrors(['username' => 'Login gagal! Periksa username dan password']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }


}
