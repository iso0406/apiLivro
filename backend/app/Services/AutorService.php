<?php

namespace App\Services;

use App\DTO\TbAutorDTO;
use App\Repositories\AutorRepository;
use Illuminate\Support\Facades\DB;

class AutorService {

    private $autorRepository;

    public function __construct(AutorRepository $autorRepository)
    {
        $this->autorRepository = $autorRepository;
    }

    public function index()
    {
        return $this->autorRepository->index();
    }

    public function create(TbAutorDTO $data)
    {
        $data->status = 1;
        return DB::transaction(function () use ($data) {
            $this->autorRepository->create(array_change_key_case($data->toArray(), CASE_UPPER));
        });
    }

    public function show(int $id) 
    {
        return $this->autorRepository->show($id);
    }

    public function update(array $data, int $id) 
    {
        return $this->autorRepository->update($data, $id);
    }

    public function destroy(int $id) 
    {
        $status = 0;
        return $this->autorRepository->destroy($status, $id);
    }

}
