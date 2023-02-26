<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calon extends Model
{
    use HasFactory;
    protected $table = 'calon';
    protected $primary = 'id';
    protected $fillable = [
        'nama',
        'id_partai',
        'created_at',
        'updated_at'
    ];
    public $timestamp = TRUE;

    public function Partai()
    {
        return $this->belongsTo(Partai::class, 'id', 'id_partai');
    }
}
