<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Petugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index(Request $request){
        $petugas = Petugas::All()->sortBy('name');
        return view('User Admin.petugas.index', compact('petugas'));
    }

    
    public function create(){
        return view('User Admin.petugas.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama'  => 'required',
            'username'  => 'required',
            'level'  => 'required',
            'telp'  => 'required|min:12',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $petugas = new Petugas;
        $petugas->nama = $request->nama;
        $petugas->username = $request->username;
        $petugas->level = $request->level;
        $petugas->telp = $request->telp;
        $petugas->email = $request->email;
        $petugas->password = Hash::make($request->password);
        $petugas->save();
        return redirect()->route('admin.petugas.index')->with('success','Petugas berhasil ditambahkan!');
    }

    public function edit($id){
        return view('User Admin.petugas.edit',[
            'petugas' => Petugas::find($id),
        ]);
    }

    public function update(Request $request, $id){
        $petugas = Petugas::find($id);
        $this->validate($request,[
            'nama' => ['required'],
            'username' => ['required'],
            'level' => ['required'],
            'telp' => ['required'],
            'email' => ['required'],
        ]);
        
        $input = $request->all();
        $input['nama'] = $request['nama'];
        $input['username'] = $request['username'];
        $input['level'] = $request['level'];
        $input['telp'] = $request['telp'];
        $input['email'] = $request['email'];
        $petugas->update($input);
        return redirect()->route('admin.petugas.index')->with('success','Petugas berhasil diupdate!');
    }

    public function destroy($id){
        $petugas = Petugas::find($id);
        $petugas->delete();
        return redirect()->route('admin.petugas.index')->with('success','Petugas berhasil dihapus!');
    }
}
