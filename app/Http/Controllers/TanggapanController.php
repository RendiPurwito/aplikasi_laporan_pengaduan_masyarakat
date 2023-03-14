<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use PDF;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class TanggapanController extends Controller
{
    public function index(Request $request){
        $tanggapan = Tanggapan::all();
        $pengaduan = Pengaduan::all();
        $petugas = Petugas::all();
        return view('Tanggapan.index', compact('tanggapan', 'pengaduan', 'petugas'));
    }

    public function create($id){
        return view('Tanggapan.create',[
            'pengaduan' => Pengaduan::find($id)
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'pengaduan_id'  => 'required',
            'tanggapan'  => 'required',
            'petugas_id'  => 'required',
        ]);

        $tanggapan = new Tanggapan;
        $tanggapan->pengaduan_id = $request->pengaduan_id;
        $tanggapan->tanggapan = $request->tanggapan;
        $tanggapan->petugas_id = $request->petugas_id;
        $tanggapan->save();
        return redirect()->route('pengaduan.index')->with('success','Tanggapan berhasil ditambahkan!');
    }

    public function destroy($id){
        $tanggapan = Tanggapan::where('id', $id)->firstOrFail();
        $tanggapan->delete();
        return redirect()->route('tanggapan.index')->with('success','Laporan berhasil dihapus!');
    }
}
