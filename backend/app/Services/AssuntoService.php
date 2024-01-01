<?php

namespace App\Services;

use App\DTO\TbAssuntoDTO;
use App\Repositories\AssuntoRepository;
use Illuminate\Support\Facades\DB;

class AssuntoService {

    private $assuntoRepository;

    public function __construct(AssuntoRepository $assuntoRepository)
    {
        $this->assuntoRepository = $assuntoRepository;
    }

    public function index()
    {
        return $this->assuntoRepository->index();
    }

    public function create(TbAssuntoDTO $data)
    {
        //return $this->assuntoRepository->create($data);
        $data->status = 1;
        return DB::transaction(function () use ($data) {
            $this->assuntoRepository->create(array_change_key_case($data->toArray(), CASE_UPPER));
        });
    }

    public function show(int $id) 
    {
        return $this->assuntoRepository->show($id);
    }

    public function update(array $data, int $id) 
    { 
        return $this->assuntoRepository->update($data, $id);
    }

    public function destroy(int $id) 
    {
        $status = 0;
        return $this->assuntoRepository->destroy($status, $id);
    }

}
