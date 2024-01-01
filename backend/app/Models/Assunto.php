<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    use HasFactory;

    protected $table = 'ASSUNTO';
    protected $primaryKey = 'CODAS';
    public $timestamps = false;

    protected $fillable = [
        'DESCRICAO',
        'STATUS'
    ];
}
