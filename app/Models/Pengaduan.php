<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduans';

    protected $fillable = [
        'isi_laporan', 
        'foto',
        'status'
    ];

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'nik_pelapor', 'nik');
    }

    public function tanggapan()
    {
        return $this->hasOne(Tanggapan::class, 'pengaduan_id', 'id');
    }
}
