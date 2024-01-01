<?php

namespace App\Repositories\Interfaces;

interface IApiLivroRepository {
    public function index();
    public function listBook();
    public function generatePDF();
    public function show(int $id);
    public function create(array $data);
    public function update(array $data, int $id);
    public function destroy(int $status, int $id);
}