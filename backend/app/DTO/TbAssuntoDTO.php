<?php

namespace App\DTO;

use App\Traits\StaticCreateSelf;
use App\Traits\ToArray;

class TbAssuntoDTO {
    use StaticCreateSelf, ToArray;
    
    public int $codAs;
    public string $descricao;
    public int $status;
}