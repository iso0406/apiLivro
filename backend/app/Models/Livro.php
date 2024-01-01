<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $table = 'livro';
    protected $primaryKey = 'cod';
    public $timestamps = false;

    protected $fillable = [
        'TITULO', 
        'EDITORA',
        'EDICAO',
        'ANOPUBLICACAO',
        'STATUS'
    ];

    public function autor()
    {
        return $this->hasOne(LivroAutor::class, 'codLivro', 'cod');
    }

    public function assunto()
    {
        return $this->hasOne(LivroAssunto::class, 'codLivro', 'cod');
    }

    public function livroAssunto()
    {
        return $this->hasMany(LivroAssunto::class, 'codLivro', 'cod');
    }

    public function livroAutor()
    {
        return $this->hasMany(LivroAutor::class, 'codLivro', 'cod');
    }
}
