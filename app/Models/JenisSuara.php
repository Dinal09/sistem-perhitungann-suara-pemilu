<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSuara extends Model
{
    use HasFactory;
    protected $table = 'jenis_suara';
    protected $fillable = [
        'deskripsi',
    ];
    protected $timestamp = true;
}
