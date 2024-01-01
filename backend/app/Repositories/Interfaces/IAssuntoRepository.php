<?php

namespace App\Repositories\Interfaces;

interface IAssuntoRepository {
    public function index();
    public function show(int $id);
    public function create(array $data);
    public function update(array $data, int $id);
    public function destroy(int $status, int $id);
}