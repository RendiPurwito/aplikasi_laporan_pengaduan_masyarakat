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
        $data = Tanggapan::all();
        $pengaduan = Pengaduan::all();
        $petugas = Petugas::all();
        return view('Tanggapan.index', compact('data', 'pengaduan', 'petugas'));
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

        $data = new Tanggapan;
        $data->pengaduan_id = $request->pengaduan_id;
        $data->tanggapan = $request->tanggapan;
        $data->petugas_id = $request->petugas_id;
        $data->save();
        return redirect()->route('tanggapan.index')->with('success','Tanggapan berhasil ditambahkan!');
    }

    public function pdf($id)
    {
        $data = Tanggapan::find($id);
        $pengaduan = Pengaduan::all();
        $petugas = Petugas::all();
        $pdf = PDF::loadview('Tanggapan.pdf',[
            'data'=>$data,
            'pengaduan'=>$pengaduan,
            'petugas'=>$petugas,
        ]);
        return $pdf->stream();
    }
}
