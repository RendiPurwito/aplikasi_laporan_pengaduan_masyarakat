<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduans';

    protected $fillable = [
        'kategori', 
        'judul_laporan', 
        'isi_laporan', 
        'foto',
        'status',
        'visibilitas'
    ];

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'nik_pelapor', 'nik');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function tanggapan()
    {
        return $this->hasOne(Tanggapan::class, 'pengaduan_id', 'id');
    }
}
