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
        $pengaduan = Pengaduan::all();
        $masyarakat = Masyarakat::all();
        return view('pengaduan.index', compact('pengaduan', 'masyarakat'));
    }

    public function list(Request $request){
        // $masyarakat = Auth::guard('masyarakats')->user();
        $pengaduan = Pengaduan::where('nik_pelapor', Auth::guard('masyarakats')->user()->nik)->orderBy('created_at')->get();
        return view('masyarakat.index', compact('pengaduan'));
    }

    public function create(){
        return view('Masyarakat.create');
    }

    public function store(Request $request){
        $request->validate([
            // 'tgl_pengaduan'  => 'required',
            'nik_pelapor'  => 'required',
            'isi_laporan'  => 'required',
            'foto'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        $pengaduan = new Pengaduan;
        $pengaduan->nik_pelapor = $request->nik_pelapor;
        $pengaduan->isi_laporan = $request->isi_laporan;
        $pengaduan->status = $request->status;

        if($request->hasFile('foto')){
            $request->file('foto')->move('foto/', $request->file('foto')->getClientOriginalName());
            $pengaduan->foto = $request->file('foto')->getClientOriginalName();
            $pengaduan->save();
        }

        $pengaduan->save();

        return redirect('/pengaduan/feedback')->with('success', 'Pengaduan berhasil ditambahkan.');
    }

    public function verify($id){
        $pengaduan = Pengaduan::findOrFail($id);
        return view('pengaduan.verifikasi', compact('pengaduan'));
    }

    public function verified(Request $request, $id){
            $pengaduan = Pengaduan::find($id);
            $pengaduan->update($request->all());
            $pengaduan->update();
            return redirect()->route('pengaduan.index')->with('success', 'Data Berhasil Diedit');
        }

    public function detail($id){
        $pengaduan = Pengaduan::find($id);
        return view('pengaduan.detail', compact('pengaduan'));
    }

    // public function edit($id){
    //     $data = Pengaduan::find($id);
    //     return view('', compact('data'));
    // }

    // public function update(Request $request, $id){
    //     $data = Pengaduan::find($id);
    //     $data->update($request->all());
    //     if ($request->hasFile('foto')) {
    //         $destination = 'foto/'.$data->foto;
    //         if(File::exists($destination)){
    //             File::delete($destination);
    //         }
    //         $file = $request->file('foto');
    //         $extension = $file->getClientOriginalName();
    //         $filename = time().'.'.$extension;
    //         $file->move('foto/', $filename);
    //         $data->foto = $filename;
    //     }
    //     $data->update();
    //     return redirect()->route('')->with('success', 'Data Berhasil Diedit');
    // }

    // public function destroy($id){
    //     $data = Pengaduan::where('id', $id)->firstOrFail();
    //     $data->delete();
    //     return redirect()->route('pengaduan.index')->with('success','Laporan berhasil dihapus!');
    // }
}
