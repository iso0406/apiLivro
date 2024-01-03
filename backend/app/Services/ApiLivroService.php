<?php

namespace App\Services;

use App\DTO\TbLivroDTO;
use App\Models\LivroAutor;
use App\Models\LivroAssunto;
use App\Repositories\ApiLivroRepository;
use Illuminate\Support\Facades\DB;

class ApiLivroService {

    private $apiLivroRepository;

    public function __construct(ApiLivroRepository $apiLivroRepository)
    {
        $this->apiLivroRepository = $apiLivroRepository;
    }

    public function index()
    {
        return $this->apiLivroRepository->index();
    }

    public function listBook()
    {
        return $this->apiLivroRepository->listBook();
    }

    public function generatePDF()
    {
        return $this->apiLivroRepository->generatePDF();
    }

    public function create(TbLivroDTO $data)
    {
        $data->status = 1;

        return DB::transaction(function () use ($data) {
            $livro = $this->apiLivroRepository->create(array_change_key_case($data->toArray(), CASE_UPPER));
            $livroCod = $livro->COD;
            
            $this->associarLivroAutor($livroCod, $data->autor);
            $this->associarLivroAssunto($livroCod, $data->assunto);

            return $livro;
        });
    }

    private function associarLivroAutor($livroCod, $autorId)
    {
        $data = [
            'codLivro' => $livroCod,
            'codAutor' => $autorId,
        ];

        return LivroAutor::create($data);
    }

    private function associarLivroAssunto($livroCod, $assuntoId)
    {
        $data = [
            'codLivro' => $livroCod,
            'codAssunto' => $assuntoId,
        ];

        return LivroAssunto::create($data);
    }

    public function show(int $id) 
    {
        return $this->apiLivroRepository->show($id);
    }

    public function update(array $data, int $id) 
    {
        $updateFields = [
            'titulo' => $data['titulo'],
            'editora' => $data['editora'],
            'edicao' => $data['edicao'],
            'anoPublicacao' => $data['anoPublicacao'],
        ];

        $this->associarLivroAutor($id, $data['autor']);
        return $this->apiLivroRepository->update($updateFields, $id);
    }

    private function atualizarAssociacaoLivroAutor($id, $autorId)
    {
        $data = [
            'codAutor' => $autorId,
        ];

        return LivroAutor::where('codLivro', $id)->update(['codAutor' => $data]);
    }

    public function destroy(int $id) 
    {
        $status = 0;
        return $this->apiLivroRepository->destroy($status, $id);
    }

}
