<?php

namespace App\Http\Controllers\Admin;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasyarakatController extends Controller
{
    public function index(Request $request){
        $data = Masyarakat::All()->sortBy('name');
        return view('admin.masyarakat.index', compact('data'));
    }

    public function edit($nik){
        return view('admin.masyarakat.edit',[
            'data' => Masyarakat::find($nik),
        ]);
    }

    public function update(Request $request, $nik){
        $data = Masyarakat::find($nik);
        $this->validate($request,[
            'nama' => ['required'],
            'username' => ['required'],
            'telp' => ['required'],
            'email' => ['required'],
        ]);
        
        $input = $request->all();
        $input['nama'] = $request['nama'];
        $input['username'] = $request['username'];
        $input['telp'] = $request['telp'];
        $input['email'] = $request['email'];
        $data->update($input);
        return redirect()->route('admin.masyarakat.index')->with('success','Petugas berhasil diupdate!');
    }

    public function destroy($nik){
        $data = Masyarakat::where('nik', $nik)->firstOrFail();
        $data->delete();
        return redirect()->route('admin.masyarakat.index')->with('success','Petugas berhasil dihapus!');
    }
}
