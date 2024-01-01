<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $table = 'LIVRO';
    protected $primaryKey = 'COD';
    public $timestamps = false;

    protected $fillable = [
        'TITULO', 
        'EDITORA',
        'EDICAO',
        'ANOPUBLICACAO',
        'STATUS'
    ];
}
