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
        $data = Petugas::All()->sortBy('name');
        return view('admin.petugas.index', compact('data'));
    }

    
    public function create(){
        return view('admin.petugas.create');
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

        $data = new Petugas;
        $data->nama = $request->nama;
        $data->username = $request->username;
        $data->level = $request->level;
        $data->telp = $request->telp;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->save();
        return redirect()->route('admin.petugas.index')->with('success','Petugas berhasil ditambahkan!');
    }

    public function edit($id){
        return view('admin.petugas.edit',[
            'data' => Petugas::find($id),
        ]);
    }

    public function update(Request $request, $id){
        $data = Petugas::find($id);
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
        $data->update($input);
        return redirect()->route('admin.petugas.index')->with('success','Petugas berhasil diupdate!');
    }

    public function destroy($id){
        $data = Petugas::where('id', $id)->firstOrFail();
        $data->delete();
        return redirect()->route('admin.petugas.index')->with('success','Petugas berhasil dihapus!');
    }
}
