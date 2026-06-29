<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Memproses data login
    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $loginField = $request->input('username');
        $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if (Auth::attempt([$fieldType => $loginField, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // Jika gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'username' => 'Username/Email atau password salah!',
        ])->onlyInput('username');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Menampilkan halaman lupa password
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    // Mengirim link reset password
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.exists' => 'Alamat email tidak terdaftar di sistem.',
        ]);

        $token = \Illuminate\Support\Str::random(64);

        \Illuminate\Support\Facades\DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => now()
            ]
        );

        $resetUrl = url('/reset-password/' . $token . '?email=' . urlencode($request->email));

        \Illuminate\Support\Facades\Log::info("Password reset link for {$request->email}: {$resetUrl}");

        // Mengirim email (Menggunakan Mailer default, fallback Log mailer)
        try {
            \Illuminate\Support\Facades\Mail::raw(
                "Halo! Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda. Silakan klik link berikut untuk mereset password: " . $resetUrl,
                function ($message) use ($request) {
                    $message->to($request->email)
                            ->subject('Reset Password - Alva Cake');
                }
            );
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Gagal mengirim email reset: " . $e->getMessage());
        }

        return back()->with('success', 'Link reset password telah berhasil dikirim ke email Anda!');
    }

    // Menampilkan halaman ganti password baru
    public function showResetPassword(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    // Memproses update password baru
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.exists' => 'Email tidak terdaftar.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $record = \Illuminate\Support\Facades\DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return back()->withErrors(['email' => 'Token reset password tidak valid atau telah kedaluwarsa.']);
        }

        $user = \App\Models\User::where('email', $request->email)->first();
        if ($user) {
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
            $user->save();
        }

        // Hapus token setelah berhasil digunakan
        \Illuminate\Support\Facades\DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect('/login')->with('success', 'Password Anda berhasil diperbarui! Silakan masuk menggunakan password baru.');
    }
}
