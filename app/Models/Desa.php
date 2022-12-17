<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;
    protected $table = 'desa';
    protected $fillable = [
        'id_kecamatan',
        'nama',
        'jumlah_penduduk',
        'target_kunjungan',
        'created_at',
        'updated_at'
    ];
    public $timestamp = TRUE;


    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan', 'id');
    }
    public function Tps()
    {
        return $this->hasMany(Tps::class, 'id_desa', 'id');
    }
}