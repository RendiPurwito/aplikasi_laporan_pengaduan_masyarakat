<?php

namespace App\Http\Controllers\Admin;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasyarakatController extends Controller
{
    public function index(Request $request){
        $masyarakat = Masyarakat::All()->sortBy('name');
        return view('User Admin.masyarakat.index', compact('masyarakat'));
    }

    public function edit($nik){
        return view('User Admin.masyarakat.edit',[
            'masyarakat' => Masyarakat::find($nik),
        ]);
    }

    public function update(Request $request, $nik){
        $masyarakat = Masyarakat::find($nik);
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
        $masyarakat->update($input);
        return redirect()->route('admin.masyarakat.index')->with('success','Petugas berhasil diupdate!');
    }

    public function destroy($nik){
        $masyarakat = Masyarakat::where('nik', $nik)->firstOrFail();
        $masyarakat->delete();
        return redirect()->route('admin.masyarakat.index')->with('success','Petugas berhasil dihapus!');
    }
}
