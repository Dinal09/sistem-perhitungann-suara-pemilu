<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilih extends Model
{
    use HasFactory;
    protected $table = 'pemilih';
    protected $fillable = [
        'id_tps',
        'id_suara_abu',
        'id_desa',

        'nama',
        'no_kk',
        'no_nik',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'foto_ktp',
        'foto_kk',
        'foto',

        'created_at',
        'updated_at',
        'created_by',

        'kunjungan_by',
        'kunjungan_tgl',
    ];
    public $timestamp = TRUE;

    private $jenisData = ['is_simpatisan', 'pengkhianat', 'is_daftar_hitam'];

    public function tps()
    {
        return $this->belongsTo(Tps::class, 'id_tps', 'id');
    }
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa', 'id');
    }
    public function typePemilih()
    {
        return $this->hasMany(typePemilih::class, 'id_pemilih', 'id');
    }
}
