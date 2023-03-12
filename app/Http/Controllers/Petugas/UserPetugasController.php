<?php

namespace App\Http\Controllers\Petugas;

use Dompdf\Dompdf;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserPetugasController extends Controller
{
    // Login
    public function formLogin(){
        return view('Auth.petugas.login');
    }

    public function login(Request $request ){
        $credentials = $request->only('username', 'password');
        $petugas = Auth::guard('petugas')->attempt($credentials);

        if($petugas) {
            if (Auth::guard('petugas')->user()->level == 'admin') {
                $request->session()->regenerate();
                return redirect()->intended('/admin/admin-dashboard');
            } else {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            }
        }else {
            return redirect('/admin/')->withErrors([
                'error' => 'Username atau password salah.'
            ]);
        }
        return back()->with('error', 'Login failed! Please try again');
    }

    // Log Out
    public function logout(Request $request){
        Auth::guard('petugas')->logout();
        return redirect('/admin/');
    }

    // Register Admin
    public function formRegister(){
        return view('Auth.petugas.register');
    }

    public function register(Request $request)
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
        return redirect("/admin/login")->with('succes', 'User registered successfully');
    }

    public function generatePdfReport($startDate, $endDate)
    {
        // Ambil data pengaduan dari database berdasarkan tanggal awal dan tanggal akhir
        $pengaduan = DB::table('pengaduan')
                        ->whereBetween('tanggal_pengaduan', [$startDate, $endDate])
                        ->get();

        // Buat objek DOM PDF
        $pdf = new Dompdf();

        // Buat tampilan HTML untuk laporan pengaduan
        $html = '<h1>Laporan Pengaduan</h1>';
        $html .= '<p>Tanggal Awal: ' . $startDate . '</p>';
        $html .= '<p>Tanggal Akhir: ' . $endDate . '</p>';
        $html .= '<table>';
        $html .= '<thead><tr><th>No.</th><th>Tanggal Pengaduan</th><th>Isi Pengaduan</th><th>Status</th></tr></thead>';
        $html .= '<tbody>';

        $i = 1;
        foreach ($pengaduan as $row) {
            $html .= '<tr>';
            $html .= '<td>' . $i++ . '</td>';
            $html .= '<td>' . $row->tanggal_pengaduan . '</td>';
            $html .= '<td>' . $row->isi_pengaduan . '</td>';
            $html .= '<td>' . $row->status . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody></table>';

        // Masukkan tampilan HTML ke objek DOM PDF
        $pdf->loadHtml($html);

        // Atur ukuran dan orientasi kertas
        $pdf->setPaper('A4', 'portrait');

        // Render PDF
        $pdf->render();

        // Simpan file PDF ke server
        $pdf->stream('laporan_pengaduan_' . date('Y-m-d') . '.pdf');
    }
}
