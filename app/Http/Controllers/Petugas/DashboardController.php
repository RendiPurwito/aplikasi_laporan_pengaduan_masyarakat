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

        // Chart pengaduan berdasarkan kategori per bulan
        $pengaduans = DB::table('pengaduans')
                        ->select(DB::raw('MONTH(created_at) as bulan'), 'kategori_id', DB::raw('count(*) as total'))
                        ->groupBy('bulan', 'kategori_id')
                        ->orderBy('bulan', 'asc')
                        ->get();

        $kategoris = DB::table('kategoris')->pluck('nama_kategori', 'id');

        $data = [];

        foreach ($pengaduans as $pengaduan) {
            $data[$pengaduan->kategori_id][] = $pengaduan->total;
        }

        $chartData = [];

        foreach ($data as $kategoriId => $totals) {
            $chartData[] = [
                'name' => $kategoris[$kategoriId],
                'data' => $totals,
            ];
        }

        // Pie Chart pengaduan berdasarkan kategori
        // $pengaduanByKategori = Pengaduan::select('kategori_id', \DB::raw('count(*) as total'))
        //                         ->groupBy('kategori_id')
        //                         ->get();

        // $chart = [];
        // foreach ($pengaduanByKategori as $pengaduan) {
        //     $kategori = Kategori::find($pengaduan->kategori_id);
        //     $chart[] = [
        //         'kategori' => $kategori->nama_kategori,
        //         'total' => $pengaduan->total
        //     ];
        // }
        $pengaduanByKategori = DB::table('pengaduans')
        ->select('kategori_id', DB::raw('count(*) as total'))
        ->groupBy('kategori_id')
        ->get();

        $kategoris = DB::table('kategoris')->pluck('nama_kategori', 'id');

        $pieChartData = [];

        foreach ($pengaduanByKategori as $pengaduan) {
            $pieChartData[] = [
                'name' => $kategoris[$pengaduan->kategori_id],
                'y' => $pengaduan->total,
            ];
        }

        return view('User Admin.dashboard', compact('diterima', 'diproses', 'selesai', 'ditolak', 'tanggapan', 'petugas', 'admin', 'masyarakat', 'chartData','pieChartData'));
        }

    public function dashboard(){
        $diterima = Pengaduan::where('status', 'diterima')->count();
        $diproses = Pengaduan::where('status', 'diproses')->count();
        $selesai = Pengaduan::where('status', 'selesai')->count();
        $ditolak = Pengaduan::where('status', 'ditolak')->count();
        $tanggapan = Tanggapan::count();

        // Chart pengaduan berdasarkan kategori per bulan
        $pengaduans = DB::table('pengaduans')
                        ->select(DB::raw('MONTH(created_at) as bulan'), 'kategori_id', DB::raw('count(*) as total'))
                        ->groupBy('bulan', 'kategori_id')
                        ->orderBy('bulan', 'asc')
                        ->get();

        $kategoris = DB::table('kategoris')->pluck('nama_kategori', 'id');

        $data = [];

        foreach ($pengaduans as $pengaduan) {
            $data[$pengaduan->kategori_id][] = $pengaduan->total;
        }

        $chartData = [];

        foreach ($data as $kategoriId => $totals) {
            $chartData[] = [
                'name' => $kategoris[$kategoriId],
                'data' => $totals,
            ];
        }

        // Pie Chart pengaduan berdasarkan kategori
        $pengaduanByKategori = DB::table('pengaduans')
        ->select('kategori_id', DB::raw('count(*) as total'))
        ->groupBy('kategori_id')
        ->get();

        $kategoris = DB::table('kategoris')->pluck('nama_kategori', 'id');

        $pieChartData = [];

        foreach ($pengaduanByKategori as $pengaduan) {
            $pieChartData[] = [
                'name' => $kategoris[$pengaduan->kategori_id],
                'y' => $pengaduan->total,
            ];
        }
        
        return view('User Petugas.dashboard', compact('diterima', 'diproses', 'selesai', 'ditolak', 'tanggapan', 'chartData','pieChartData'));
    }
}
