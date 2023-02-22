<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'kecamatan';
    protected $fillable = [
        'id_kabupaten',
        'nama',
        'created_at',
        'updated_at'
    ];
    public $timestamp = TRUE;


    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten', 'id');
    }
    public function desa()
    {
        return $this->hasMany(Desa::class, 'id_kecamatan', 'id');
    }
    public function typePemilih()
    {
        return $this->belongsTo(TypePemilih::class, 'id_kecamatan', 'id');
    }
}
