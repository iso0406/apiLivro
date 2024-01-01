<?php

namespace App\Repositories;

use App\Models\Assunto;
use App\Repositories\Interfaces\IAssuntoRepository;
use App\Repositories\AbstractRepository;

class AssuntoRepository extends AbstractRepository  implements IAssuntoRepository 
{
    protected $tbAssunto;

    public function __construct(Assunto $tbAssunto)
    {
        $this->tbAssunto = $tbAssunto;
    }

    public function index()
    {
        return $this->tbAssunto->where('status', '=', '1')->get();
    }

    public function show(int $id)
    {
        return $this->tbAssunto->where('codAs', $id)->get();
    }

    public function create(array $data) 
    {
        return $this->tbAssunto->create($data);
    }

    public function update(array $data, int $id)
    {
        return $this->tbAssunto->where('codAs', $id)->update($data);
    }

    public function destroy(int $status, int $id)
    {
        return $this->tbAssunto->where('codAs', $id)->update(['status' => $status]);
    }
}