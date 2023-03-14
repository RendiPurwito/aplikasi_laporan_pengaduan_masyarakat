<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request){
        $kategori = Kategori::All()->sortBy('name');
        return view('Kategori.index', compact('kategori'));
    }

    public function create(){
        return view('Kategori.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama_kategori'  => 'required',
        ]);

        $kategori = new Kategori;
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();
        return redirect()->route('Kategori.index');
    }
}
