<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Petugas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use App\Models\Masyarakat;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
            return redirect()->intended('/pengaduan/form-laporan');
        }else {
            return redirect('/login')->withErrors([
                'error' => 'Username atau password salah.'
            ]);
        }
        return back()->with('error', 'Login failed! Please try again');
    }

    // Log Out
    public function logout(Request $request){
        Auth::guard('petugas')->logout();
        Auth::guard('masyarakats')->logout();
        return redirect('/login');
    }

    // Register
    public function showRegisterForm(){
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nik' => [
                'required',
                'digits:16',
                'unique:masyarakats',
                function ($attribute, $value, $fail) {
                    $regex = '/^[1-9][0-9]{15}$/';
                    if (!preg_match($regex, $value)) {
                        $fail($attribute . ' is invalid.');
                    }
                },
            ],
            'nama' => [
                'required', 
                'string', 
                'max:255'
            ],
            'username' => [
                'required', 
                'string', 
                'max:255', 
                Rule::unique('petugas', 'username')
                    ->where(function ($query) use ($request) {
                        return $query->where('username', $request->input('username'))
                            ->orWhere('username', $request->input('username'));
                    }),
                Rule::unique('masyarakats', 'username')
                    ->where(function ($query) use ($request) {
                        return $query->where('username', $request->input('username'))
                            ->orWhere('username', $request->input('username'));
                    }),
            ],
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                Rule::unique('petugas', 'email')
                    ->where(function ($query) use ($request) {
                        return $query->where('email', $request->input('email'))
                            ->orWhere('email', $request->input('email'));
                    }),
                Rule::unique('masyarakats', 'email')
                    ->where(function ($query) use ($request) {
                        return $query->where('email', $request->input('email'))
                            ->orWhere('email', $request->input('email'));
                    }),
            ],
            'telp' => [
                'required', 
                'regex:/^[0-9]{10,13}$/'
            ],
            'password' => [
                'required', 
                'string', 
                'min:8', 
                'confirmed'
            ],
        ]);

        $masyarakat = new Masyarakat;
        $masyarakat->nik = $request->nik;
        $masyarakat->nama = $request->nama;
        $masyarakat->username = $request->username;
        $masyarakat->email = $request->email;
        $masyarakat->telp = $request->telp;
        $masyarakat->password = Hash::make($request->password);
        $masyarakat->save();
        return redirect("/login")->with('succes', 'User registered successfully');
    }

    // Register Admin
    public function showAdminRegisterForm(){
        return view('auth.admin.register');
    }

    public function adminRegister(Request $request)
    {
        $request->validate([
            'nama' => [
                'required', 
                'string', 
                'max:255'
            ],
            'username' => [
                'required', 
                'string', 
                'max:255', 
                Rule::unique('petugas', 'username')
                    ->where(function ($query) use ($request) {
                        return $query->where('username', $request->input('username'))
                            ->orWhere('username', $request->input('username'));
                    }),
                Rule::unique('masyarakats', 'username')
                    ->where(function ($query) use ($request) {
                        return $query->where('username', $request->input('username'))
                            ->orWhere('username', $request->input('username'));
                    }),
            ],
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                Rule::unique('petugas', 'email')
                    ->where(function ($query) use ($request) {
                        return $query->where('email', $request->input('email'))
                            ->orWhere('email', $request->input('email'));
                    }),
                Rule::unique('masyarakats', 'email')
                    ->where(function ($query) use ($request) {
                        return $query->where('email', $request->input('email'))
                            ->orWhere('email', $request->input('email'));
                    }),
            ],
            'telp' => [
                'required', 
                'regex:/^[0-9]{10,13}$/'
            ],
            'password' => [
                'required', 
                'string', 
                'min:8', 
                'confirmed'
            ],
        ]);

        $admin = new Petugas;
        $admin->nama = $request->nama;
        $admin->username = $request->username;
        $admin->level = 'admin';
        $admin->email = $request->email;
        $admin->telp = $request->telp;
        $admin->password = Hash::make($request->password);
        $admin->save();
        return redirect("/login")->with('succes', 'User registered successfully');
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
