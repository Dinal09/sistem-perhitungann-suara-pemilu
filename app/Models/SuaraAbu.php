<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuaraAbu extends Model
{
    use HasFactory;
    protected $table = 'suara_abu';
    protected $fillable = [
        'deskripsi',
        'created_at',
        'updated_at'
    ];
    public $timestamp = TRUE;

    public function typePemilih()
    {
        return $this->belongsTo(TypePemilih::class, 'id_suara_abu', 'id');
    }
}
