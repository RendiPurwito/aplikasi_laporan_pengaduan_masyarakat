<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index(Request $request){
        $data = Pengaduan::all();
        $masyarakat = Masyarakat::all();
        return view('admin.pengaduan.index', compact('data', 'masyarakat'));
    }
}
