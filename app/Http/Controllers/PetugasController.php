<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Petugas;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index(Request $request){
        $data = Petugas::All()->sortBy('name');
        $user = User::all();
        return view('admin.petugas.index', compact('data', 'user'));
    }
}
