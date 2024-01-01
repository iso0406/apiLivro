<?php

namespace App\DTO;

use App\Traits\StaticCreateSelf;
use App\Traits\ToArray;

class TbLivroDTO {
    use StaticCreateSelf, ToArray;
    
    public int $cod;
    public string $titulo;
    public string $editora;
    public int $edicao;
    public string $anoPublicacao;
    public int $autor;
    public int $assunto;
    public int $status;
}