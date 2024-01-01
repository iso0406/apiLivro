<?php

namespace App\DTO;

use App\Traits\StaticCreateSelf;
use App\Traits\ToArray;

class TbLivroAutorDTO {
    use StaticCreateSelf, ToArray;
    
    public int $livroCod;
    public int $autorCod;
}