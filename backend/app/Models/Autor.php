<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'AUTOR';
    protected $primaryKey = 'CODAU';
    public $timestamps = false;

    protected $fillable = [
        'NOME',
        'STATUS'
    ];
}
