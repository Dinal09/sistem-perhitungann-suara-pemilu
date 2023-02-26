<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partai extends Model
{
    use HasFactory;
    protected $table = 'partai';
    protected $primary = 'id';
    protected $fillable = [
        'deskripsi',
        'created_at',
        'updated_at'
    ];
    public $timestamp = TRUE;

    public function Calon()
    {
        return $this->hasMany(Calon::class, 'id_partai', 'id');
    }
}
