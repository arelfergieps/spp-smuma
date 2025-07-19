<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tunggakan extends Model
{
    use HasFactory;
    protected $fillable = [
        'siswa_id',
        'tagihan_id',
        'kelas',
        'tahun',
        'status'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }
}
