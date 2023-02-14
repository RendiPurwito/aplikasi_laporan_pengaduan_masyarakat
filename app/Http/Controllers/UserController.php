<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request){
        $users = User::All()->sortBy('name');
        return view('', compact('users'));
    }

    public function create(){
        return view('',[
            'user' => User::all()
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'nama'  => 'required',
            'username'  => 'required',
            'level'  => 'required',
            'telp'  => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $user = new User;
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->level = $request->level;
        $user->telp = $request->telp;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('')->with('success','User created successfully!');
    }

    public function edit($id){
        return view('',[
            'user' => User::find($id),
        ]);
    }

    public function update(Request $request, $id){
        $user = User::find($id);
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
        $user->update($input);
        return redirect()->route('')->with('success','User updated successfully!');
    }

    public function destroy($id){
        $user = User::where('id', $id)->firstOrFail();
        $user->delete();
        return redirect()->route('')->with('success','User deleted successfully!');
    }
}
