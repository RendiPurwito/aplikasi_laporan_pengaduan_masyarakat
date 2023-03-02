<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\Masyarakat;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard(){
        $belumdiverifikasi = Pengaduan::where('status', '0')->count();
        $sudahdiverifikasi = Pengaduan::where('status', 'proses')->count();
        $sudahditanggapi = Pengaduan::where('status', 'selesai')->count();
        $jumlahtanggapan = Tanggapan::count();
        return view('Admin.dashboard', compact('belumdiverifikasi', 'sudahdiverifikasi', 'sudahditanggapi', 'jumlahtanggapan'));
    }

    public function dashboard(){
        $jumlahpengaduan = Pengaduan::count();
        $jumlahtanggapan = Tanggapan::count();
        return view('Petugas.dashboard', compact('jumlahpengaduan', 'jumlahtanggapan'));
    }
}
