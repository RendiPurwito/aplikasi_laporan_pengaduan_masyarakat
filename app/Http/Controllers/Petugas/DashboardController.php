<?php

namespace App\Http\Controllers\Petugas;

use Charts;
use App\Models\Petugas;
use App\Models\Kategori;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $pengaduanByKategori = Pengaduan::select('kategori_id', \DB::raw('count(*) as total'))
                                ->groupBy('kategori_id')
                                ->get();

        $chart = [];
        foreach ($pengaduanByKategori as $pengaduan) {
            $kategori = Kategori::find($pengaduan->kategori_id);
            $chart[] = [
                'kategori' => $kategori->nama_kategori,
                'total' => $pengaduan->total
            ];
        }

        return view('User Admin.dashboard', compact('diterima', 'diproses', 'selesai', 'ditolak', 'tanggapan', 'petugas', 'admin', 'masyarakat', 'chart'));
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
