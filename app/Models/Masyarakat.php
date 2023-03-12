<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Masyarakat extends Authenticatable 
{
    use HasFactory;

    protected $table ='masyarakats';
    protected $guard ='masyarakats';
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'nik',
        'nama',
        'username',
        'password',
        'telp',
        'email',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class, 'nik_pelapor', 'nik');
    }
}
