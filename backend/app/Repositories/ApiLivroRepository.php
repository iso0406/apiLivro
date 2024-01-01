<?php

namespace App\Repositories;

use App\Models\Livro;
use App\Models\LivroAutor;
use App\Repositories\Interfaces\IApiLivroRepository;
use App\Repositories\AbstractRepository;
use Illuminate\Support\Facades\DB;

class ApiLivroRepository extends AbstractRepository  implements IApiLivroRepository 
{
    protected $tbLivro;
    protected $tbLivroAutor;

    public function __construct(Livro $tbLivro, LivroAutor $tbLivroAutor)
    {
        $this->tbLivro = $tbLivro;
        $this->tbLivroAutor = $tbLivroAutor;
    }

    public function index()
    {
        return $this->tbLivro->all();
    }

    /*public function listBook()
    {
        return $this->tbLivroAutor
            ->with('livro', 'autor')
            ->whereHas('livro', fn ($query) => $query->where('status', 1))
            ->get();
    }
    */

    public function listBook()
    {
        //return $this->tbLivro->with(['autor.autor', 'livroAssunto'])->get();
        return $this->tbLivro->with(['autor.autor', 'livroAssunto.assunto'])->get();
    }

    public function generatePDF()
    {
        //return $this->tbLivroAutor->with('livro', 'autor')->get();
        return $this->tbLivro->with(['autor.autor', 'livroAssunto.assunto'])->get();
    }
    
    public function show(int $id)
    {
        return $this->tbLivro->where('cod', $id)->get();
    }

    public function create(array $data) 
    {
        return $this->tbLivro->create($data);
    }

    public function update(array $data, int $id)
    {
        return $this->tbLivro->where('cod', $id)->update($data);
    }

    public function destroy(int $status, int $id)
    {
        return $this->tbLivro->where('cod', $id)->update(['status' => $status]);
    }
}