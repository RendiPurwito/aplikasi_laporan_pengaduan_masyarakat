<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMasyarakatController extends Controller
{
    public function home(Request $request){
        $pengaduan = Pengaduan::where('nik_pelapor', Auth::guard('masyarakats')->user()->nik)->orderBy('created_at')->get();
        return view('User Masyarakat.index', compact('pengaduan'));
    }

    public function myLaporan(Request $request){
        $pengaduan = Pengaduan::where('nik_pelapor', Auth::guard('masyarakats')->user()->nik)->orderBy('created_at')->get();
        return view('User Masyarakat.index', compact('pengaduan'));
    }
}
