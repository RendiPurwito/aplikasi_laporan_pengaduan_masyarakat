<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Masyarakat;
use Illuminate\Http\Request;

class MasyarakatController extends Controller
{
    public function index(Request $request){
        $data = Masyarakat::All()->sortBy('name');
        $user = User::all();
        return view('admin.masyarakat.index', compact('data', 'user'));
    }
}
