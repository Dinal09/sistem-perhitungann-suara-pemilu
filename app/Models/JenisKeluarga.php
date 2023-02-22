<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKeluarga extends Model
{
    use HasFactory;
    protected $table = 'jenis_keluarga';
    protected $fillable = [
        'deskripsi',
        'created_at',
        'updated_at'
    ];
    public $timestamp = TRUE;

    public function typePemilih()
    {
        return $this->belongsTo(TypePemilih::class, 'id_keluarga', 'id');
    }
}
