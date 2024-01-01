<?php

namespace App\DTO;

use App\Traits\StaticCreateSelf;
use App\Traits\ToArray;

class TbAutorDTO {
    use StaticCreateSelf, ToArray;
    
    public int $codAu;
    public string $nome;
    public int $status;
}