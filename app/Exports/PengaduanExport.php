<?php

namespace App\Exports;

use App\Models\Pengaduan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
// use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class PengaduanExport implements FromView, WithColumnWidths, WithHeadings, ShouldAutoSize
{
    protected $pengaduan;

    public function __construct($pengaduan)
    {
        $this->pengaduan = $pengaduan;
    }

    // public function map($pengaduan): array
    // {
    //     return [
    //         $pengaduan->created_at->format('d/m/Y'), // tanggal pengaduan
    //         $pengaduan->judul_laporan, // judul laporan
    //         $pengaduan->kategori->name, // kategori laporan
    //         $pengaduan->isi_laporan, // isi laporan
    //         $pengaduan->foto, // foto
    //         $pengaduan->lokasi, // koordinat lokasi
    //         $pengaduan->tanggapan ? $pengaduan->tanggapan->petugas->nama : '', // petugas_id dari tabel tanggapan
    //         $pengaduan->tanggapan ? $pengaduan->tanggapan->created_at->format('d/m/Y') : '', // tanggal tanggapan
    //         $pengaduan->tanggapan ? $pengaduan->tanggapan->tanggapan : '', // isi tanggapan
    //     ];
    // }

    public function headings(): array
    {
        return [
            'Tanggal Pengaduan',
            'Judul Laporan',
            'Kategori Laporan',
            'Isi Laporan',
            'Foto',
            'Koordinat Lokasi',
            'Petugas',
            'Tanggal Tanggapan',
            'Isi Tanggapan',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 70,
            'C' => 20,
            'D' => 100,
            'E' => 20,
            'F' => 30,
            'G' => 20,
            'H' => 20,
            'I' => 100,
        ];
    }

    public function view(): View
    {
        return view('Pengaduan.excel', [
            'pengaduan' => $this->pengaduan
        ]);
    }
}
