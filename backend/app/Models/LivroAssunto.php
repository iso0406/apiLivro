<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivroAssunto extends Model
{
    use HasFactory;

    protected $table = 'livroassunto';
    public $timestamps = false;

    protected $fillable = [
        'codLivro', 
        'codAssunto',
    ];

    public function assunto()
    {
        return $this->hasOne(Assunto::class, 'codAs', 'codAssunto');
    }
}
