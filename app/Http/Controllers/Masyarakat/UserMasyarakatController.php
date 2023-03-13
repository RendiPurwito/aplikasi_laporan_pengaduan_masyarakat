<?php

namespace App\Http\Controllers\Masyarakat;

use App\Models\Kategori;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserMasyarakatController extends Controller
{
    // Login
    public function formLogin(){
        return view('Auth.masyarakat.login');
    }

    public function login(Request $request ){
        $credentials = $request->only('username', 'password');
        $masyarakat = Auth::guard('masyarakats')->attempt($credentials);

        if($masyarakat) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }else {
            return redirect('/login')->withErrors([
                'error' => 'Username atau password salah.'
            ]);
        }
    }

    // Log Out
    public function logout(Request $request){
        Auth::guard('masyarakats')->logout();
        return redirect('/');
    }

    // Register
    public function formRegister(){
        return view('Auth.masyarakat.register');
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
    
    public function home(Request $request){
        return view('landing-page');
    }

    public function formLaporan(){
        $kategoris = Kategori::all();
        return view('User Masyarakat.form-laporan', compact('kategoris'));
    }

    public function lapor(Request $request){
        $request->validate([
            // 'tgl_pengaduan'  => 'required',
            'nik_pelapor'  => 'required',
            'kategori_id'  => 'required',
            'judul_laporan'  => 'required',
            'isi_laporan'  => 'required',
            'foto'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'lokasi' => 'required',
            'status' => 'required',
        ]);

        $pengaduan = new Pengaduan;
        $pengaduan->nik_pelapor = $request->nik_pelapor;
        $pengaduan->kategori_id = $request->kategori_id;
        $pengaduan->judul_laporan = $request->judul_laporan;
        $pengaduan->isi_laporan = $request->isi_laporan;
        $pengaduan->lokasi = $request->lokasi;
        $pengaduan->status = $request->status;

        if($request->hasFile('foto')){
            $request->file('foto')->move('foto/', $request->file('foto')->getClientOriginalName());
            $pengaduan->foto = $request->file('foto')->getClientOriginalName();
            $pengaduan->save();
        }

        $pengaduan->save();
        // dd($pengaduan);
        
        return redirect('/feedback')->with('success', 'Pengaduan berhasil ditambahkan.');
    }

    public function myLaporan(Request $request){
        $pengaduan = Pengaduan::with(['tanggapan' => function ($query) {
            $query->with('petugas');
        }])->where('nik_pelapor', Auth::guard('masyarakats')->user()->nik)->orderBy('created_at')->get();
        $tanggapan = Tanggapan::with('petugas')->get();
        return view('User Masyarakat.my-laporan', compact('pengaduan'));
    }
}
