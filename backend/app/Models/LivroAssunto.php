<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivroAssunto extends Model
{
    use HasFactory;

    protected $table = 'TB_LIVRO_ASSUNTO';

    protected $fillable = [
        'LIVRO_COD', 
        'ASSUNTO_CODAS',
    ];
}
