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
}