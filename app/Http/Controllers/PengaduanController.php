<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PengaduanController extends Controller
{
    public function index(Request $request){
        $pengaduan = Pengaduan::orderBy('created_at', 'asc')->get();
        $masyarakat = Masyarakat::all();
        return view('pengaduan.index', compact('pengaduan', 'masyarakat'));
    }

    public function verify(Request $request, $id){
        $pengaduan = Pengaduan::find($id);
        $pengaduan->update($request->all());
        $pengaduan->update();
        return redirect()->route('pengaduan.index')->with('success', 'Data Berhasil Diedit');
    }

    public function reject(Request $request, $id){
        $pengaduan = Pengaduan::find($id);
        $pengaduan->update($request->all());
        $pengaduan->update();
        return redirect()->route('pengaduan.index')->with('success', 'Data Berhasil Diedit');
    }

    public function detail($id){
        $pengaduan = Pengaduan::find($id);
        return view('pengaduan.detail', compact('pengaduan'));
    }
}
