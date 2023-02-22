<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    protected $table = 'kabupaten';
    protected $fillable = [
        'id_dapil',
        'nama',
        'created_at',
        'updated_at'
    ];
    public $timestamp = TRUE;


    public function dapil()
    {
        return $this->belongsTo(Dapil::class, 'id_dapil', 'id');
    }
    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class, 'id_kabupaten', 'id');
    }
    public function typePemilih()
    {
        return $this->belongsTo(TypePemilih::class, 'id_kabupaten', 'id');
    }
}
