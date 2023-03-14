<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Petugas;
use App\Models\Kategori;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use App\Exports\PengaduanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class PengaduanController extends Controller
{
    public function index(Request $request){
        $pengaduan = Pengaduan::with(['tanggapan' => function ($query) {
            $query->with('petugas');
        }])->orderBy('created_at', 'asc')->get();
        $tanggapan = Tanggapan::with('petugas')->get();
        $kategori = Kategori::all();
        $masyarakat = Masyarakat::all();
        return view('pengaduan.index', compact('pengaduan', 'tanggapan', 'kategori', 'masyarakat'));
    }

    public function verify(Request $request, $id){
        $pengaduan = Pengaduan::find($id);
        $pengaduan->update($request->all());
        $pengaduan->update();
        return redirect()->route('pengaduan.index')->with('success', 'Data Berhasil Diedit');
    }

    public function reject(Request $request, $id){
        $pengaduan = Pengaduan::find($id);
        $pengaduan->update($request->all());
        $pengaduan->update();
        return redirect()->route('pengaduan.index')->with('success', 'Data Berhasil Diedit');
    }

    public function detail($id){
        $pengaduan = Pengaduan::find($id);
        return view('pengaduan.detail', compact('pengaduan'));
    }

    public function pdfById($id)
    {
        $pengaduan = Pengaduan::find($id);
        $masyarakat = Masyarakat::all();
        $tanggapan = Tanggapan::all();
        $petugas = Petugas::all();
        $pdf = PDF::loadview('Pengaduan.pdf-id',[
            'pengaduan'=>$pengaduan,
            'masyarakat'=>$masyarakat,
            'tanggapan'=>$tanggapan,
            'petugas'=>$petugas,
        ]);
        return $pdf->stream();
    }

    public function generate(Request $request){
        $kategori = Kategori::all();
        $pengaduan = Pengaduan::with(['tanggapan.petugas'])
        ->where('status', 'selesai');

        if ($request->filled('kategori_id')) {
            $pengaduan->where('kategori_id', $request->kategori_id);
        }
    
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $pengaduan->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir]);
        }
    
        $pengaduan = $pengaduan->get();
        return view('pengaduan.generate-laporan', compact('pengaduan', 'kategori'));
    }

    public function pdfByKategoriTanggal(Request $request){
        $kategori_id = $request->input('kategori_id');
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        // Validate the category ID
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'nullable|integer|exists:kategoris,id',
            'tanggal_awal' => 'nullable|date_format:Y-m-d',
            'tanggal_akhir' => 'nullable|date_format:Y-m-d|after_or_equal:tanggal_awal',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Build the query
        $kategori = Kategori::where('kategori_id', $request->kategori_id);
        $pengaduan = Pengaduan::with(['tanggapan.petugas'])
        ->where('status', 'selesai');
        
        if ($request->filled('kategori_id')) {
            $pengaduan->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $pengaduan->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        // Get the results and generate the PDF
        $pengaduan = $pengaduan->get();
        
        $pdf = PDF::loadView('Pengaduan.pdf-kategori-tanggal', compact('pengaduan', 'kategori'))->setPaper('a4', 'landscape')->setOptions([
            'isRemoteEnabled' => true,
            'memory_limit' => '-1',
            'execution_timeout' => 0,
            'chroot' => base_path()
        ]);
        return $pdf->stream();
    }

    public function exportToExcel(Request $request)
    {
        $kategori_id = $request->input('kategori_id');
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        // Validate the category ID
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'nullable|integer|exists:kategoris,id',
            'tanggal_awal' => 'nullable|date_format:Y-m-d',
            'tanggal_akhir' => 'nullable|date_format:Y-m-d|after_or_equal:tanggal_awal',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Build the query
        $kategori = Kategori::where('kategori_id', $request->kategori_id);
        $pengaduan = Pengaduan::with(['tanggapan.petugas'])
        ->where('status', 'selesai');
        
        if ($request->filled('kategori_id')) {
            $pengaduan->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $pengaduan->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        // Get the results and generate the PDF
        $pengaduan = $pengaduan->get();

        return Excel::download(new PengaduanExport($pengaduan, $kategori), 'data_pengaduan.xlsx');
    }

}
