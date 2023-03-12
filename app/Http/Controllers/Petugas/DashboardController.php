<?php

namespace App\Http\Controllers\Petugas;

use App\Models\Petugas;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function adminDashboard(){
        $diterima = Pengaduan::where('status', 'diterima')->count();
        $diproses = Pengaduan::where('status', 'diproses')->count();
        $selesai = Pengaduan::where('status', 'selesai')->count();
        $ditolak = Pengaduan::where('status', 'ditolak')->count();
        $tanggapan = Tanggapan::count();
        $petugas = Petugas::where('level', 'petugas')->count();
        $admin = Petugas::where('level', 'admin')->count();
        $masyarakat = Masyarakat::count();
        return view('User Admin.dashboard', compact('diterima', 'diproses', 'selesai', 'ditolak', 'tanggapan', 'petugas', 'admin', 'masyarakat'));
    }

    public function dashboard(){
        $diterima = Pengaduan::where('status', 'diterima')->count();
        $diproses = Pengaduan::where('status', 'diproses')->count();
        $selesai = Pengaduan::where('status', 'selesai')->count();
        $ditolak = Pengaduan::where('status', 'ditolak')->count();
        $tanggapan = Tanggapan::count();
        return view('User Petugas.dashboard', compact('diterima', 'diproses', 'selesai', 'ditolak', 'tanggapan'));
    }
}
