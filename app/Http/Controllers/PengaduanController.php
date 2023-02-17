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
        $data = Pengaduan::all();
        $masyarakat = Masyarakat::all();
        return view('pengaduan.index', compact('data', 'masyarakat'));
    }

    public function list(Request $request){
        // $masyarakat = Auth::guard('masyarakats')->user();
        $data = Pengaduan::where('nik_pelapor', Auth::guard('masyarakats')->user()->nik)->get();
        return view('masyarakat.index', compact('data'));
    }

    public function create(){
        return view('Masyarakat.create',[
            'data' => Pengaduan::all()
        ]);
    }

    public function store(Request $request){
        $request->validate([
            // 'tgl_pengaduan'  => 'required',
            'nik_pelapor'  => 'required',
            'isi_laporan'  => 'required',
            'foto'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        $data = new Pengaduan;
        $data->nik_pelapor = $request->nik_pelapor;
        $data->isi_laporan = $request->isi_laporan;
        $data->status = $request->status;

        if($request->hasFile('foto')){
            $request->file('foto')->move('foto/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }

        $data->save();

        return redirect('/pengaduan/feedback')->with('success', 'Pengaduan berhasil ditambahkan.');
    }

    public function edit($id){
        $data = Pengaduan::find($id);
        return view('', compact('data'));
    }

    public function update(Request $request, $id){
        $data = Pengaduan::find($id);
        $data->update($request->all());
        if ($request->hasFile('foto')) {
            $destination = 'foto/'.$data->foto;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('foto');
            $extension = $file->getClientOriginalName();
            $filename = time().'.'.$extension;
            $file->move('foto/', $filename);
            $data->foto = $filename;
        }
        $data->update();
        return redirect()->route('')->with('success', 'Data Berhasil Diedit');
    }
}
