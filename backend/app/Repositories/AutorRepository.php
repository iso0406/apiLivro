<?php

namespace App\Repositories;

use App\Models\Autor;
use App\Repositories\Interfaces\IAutorRepository;
use App\Repositories\AbstractRepository;

class AutorRepository extends AbstractRepository  implements IAutorRepository 
{
    protected $tbAutor;

    public function __construct(Autor $tbAutor)
    {
        $this->tbAutor = $tbAutor;
    }

    public function index()
    {
        return $this->tbAutor->where('status', '=', '1')->get();
    }

    public function show(int $id)
    {
        return $this->tbAutor->where('codAu', $id)->get();
    }

    public function create(array $data) 
    {
        return $this->tbAutor->create($data);
    }

    public function update(array $data, int $id)
    {
        return $this->tbAutor->where('codAu', $id)->update($data);
    }

    public function destroy(int $status, int $id)
    {
        return $this->tbAutor->where('codAu', $id)->update(['status' => $status]);
    }
}