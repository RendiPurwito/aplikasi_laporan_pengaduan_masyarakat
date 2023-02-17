<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // Login
    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request ){
        $credentials = $request->only('username', 'password');
        $petugas = Auth::guard('petugas')->attempt($credentials);
        $masyarakat = Auth::guard('masyarakats')->attempt($credentials);

        if($petugas) {
            if (Auth::guard('petugas')->user()->level == 'admin') {
                $request->session()->regenerate();
                return redirect()->intended('/petugas/admin/dashboard');
            } else {
                $request->session()->regenerate();
                return redirect()->intended('/petugas/dashboard');
            }
        }elseif ($masyarakat) {
            $request->session()->regenerate();
            return redirect()->intended('/pengaduan/create');
        }else {
            return redirect('/login')->withErrors([
                'error' => 'Username atau password salah.'
            ]);
        }

        // if(Auth::guard('petugas')->attempt(['username' => $request->input('username'), 'password' => $request->input('password')])){
        //     if(auth()->user()->level == 'admin'){
        //         $request->session()->regenerate();
        //         return redirect()->intended('/petugas/admin/dashboard');
        //     }else{
        //         $request->session()->regenerate();
        //         return redirect()->intended('/petugas/dashboard');
        //     }
        // }

        // if(Auth::guard('masyarakats')->attempt(['username' => $request->input('username'), 'password' => $request->input('password')], $remember_me)){
        //     $request->session()->regenerate();
        //     return redirect()->intended('');
        // }

        
        return back()->with('error', 'Login failed! Please try again');
    }

    // Log Out
    public function logout(Request $request){
        Auth::guard('petugas')->logout();
        Auth::guard('masyarakats')->logout();
        return redirect('/login');
        // Auth::logout();
        // return redirect('/login');
    }

    // Register
    public function showRegisterForm(){
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|',
            'username'  => 'required|string|',
            'email' => 'required|email|unique:users',
            'telp' => 'required|string|',
            'password' => 'required|string|min:8'
        ]);

        $user = new User;
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->level = 'admin';
        $user->email = $request->email;
        $user->telp = $request->telp;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect("/")->with('succes', 'User registered successfully');
    }

    // Forgot Password
    public function getForgotPassword()
    {
        return view('auth.forgot-password');
    }

    private function generateToken()
    {
        $key = config('app.key');
        
        if (Str::startsWith($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }
        return hash_hmac('sha256', Str::random(40), $key);
    }

    public function postForgotPassword(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        $generateToken = $this->generateToken();
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $generateToken,
            'created_at' => Carbon::now()
        ]);
        $token = DB::table('password_resets')->where('token', $generateToken)->first();
        Mail::to($user->email)->send(new ResetPasswordMail($user,$token->token));
        return redirect()->back()->with("message","Your reset link is being sent to your email");
    }

    // Reset Password
    public function getResetPassword($token) { 
        $buttonReset = DB::table('password_resets')->where('token',$token)->first();
        if(!$buttonReset || Carbon::now()->subMinutes(10) > $buttonReset->created_at){
            // $buttonReset->delete();
            return redirect()->route('forget.password.get')->with('error','Invalid password reset link or link expired.');
        }else{
            return view('auth.reset-password',[
                'token' => $token
            ]);


        }
        
    }

    public function postResetPassword($token, Request $request)
    {
        $buttonReset = DB::table('password_resets')->where('token',$token)->first();
        if(!$buttonReset || Carbon::now()->subMinutes(10) > $buttonReset->created_at){
            return redirect()->route('forget.password.get')->with('error','Invalid password reset link or link expired.');
        }else{
            if(strcmp($request->get('confirm_password'), $request->get('new_password'))){
                return redirect()->back()->with("error","Your confirm password does not matches with your new password. Please try again.");
            }
    
            $tokens = DB::table('password_resets')->where('token',$token);
            $reset_password = $tokens->first();
            $user = User::all()->where('email', $reset_password->email)->first();

            if($user->email != $request->get('email')){
                return redirect()->back()->with("error","Enter your correct email.");
            }else{
                $tokens->delete();
                $user->update([
                    'password' => bcrypt($request->new_password)
                ]);
                return redirect('/')->with("success","Password changed successfully!");
            }
        }
    }
}
