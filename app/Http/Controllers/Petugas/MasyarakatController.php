<?php

namespace App\Http\Controllers\Petugas;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasyarakatController extends Controller
{
    public function index(Request $request){
        $masyarakat = Masyarakat::all()->sortBy('nama');
        return view('User Admin.masyarakat.index', compact('masyarakat'));
    }
}
