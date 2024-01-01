<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivroAutor extends Model
{
    use HasFactory;

    protected $table = 'livroautor';
    public $timestamps = false;

    protected $fillable = [
        'codLivro', 
        'codAutor'
    ];

    public function livro()
    {
        return $this->hasOne(Livro::class, 'cod', 'codLivro');
    }

    public function autor()
    {
        return $this->hasOne(Autor::class, 'codAu', 'codAutor');
    }
}
