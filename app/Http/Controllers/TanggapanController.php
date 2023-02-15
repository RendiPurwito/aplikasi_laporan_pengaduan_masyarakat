<?php

namespace App\Http\Controllers;

use App\Models\Tanggapan;
use Illuminate\Http\Request;

class TanggapanController extends Controller
{
    public function index(Request $request){
        $data = Tanggapan::all();
        return view('admin.tanggapan.index', compact('data'));
    }
}
