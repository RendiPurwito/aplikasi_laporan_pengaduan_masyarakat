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
        $jumlahmasyarakat = Masyarakat::count();
        $jumlahpetugas = Petugas::count();
        $jumlahpengaduan = Pengaduan::count();
        $jumlahtanggapan = Tanggapan::count();
        return view('Admin.dashboard', compact('jumlahmasyarakat', 'jumlahpetugas', 'jumlahpengaduan', 'jumlahtanggapan'));
    }

    public function dashboard(){
        $jumlahpengaduan = Pengaduan::count();
        $jumlahtanggapan = Tanggapan::count();
        return view('Petugas.dashboard', compact('jumlahpengaduan', 'jumlahtanggapan'));
    }
}
