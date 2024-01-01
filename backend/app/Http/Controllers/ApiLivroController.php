<?php

namespace App\Http\Controllers;

use App\DTO\TbLivroDTO;
use App\Services\ApiLivroService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ApiLivroController extends Controller
{
    /**
     * Private constructor
     * @param ApiLivroService $apiLivroService
     */
    private $apiLivroService;

    public function __construct(ApiLivroService $apiLivroService)
    {
        $this->apiLivroService = $apiLivroService;
    }

    public function index()
    {
        return $this->apiLivroService->index();
    }

    public function listBook() 
    {
        return $this->apiLivroService->listBook();
    }

    public function create(Request $request)
    {
        return $this->apiLivroService->create(TbLivroDTO::create($request->all()));
    }

    public function show(int $id)
    {
        return $this->apiLivroService->show($id);
    }

    public function update(Request $request, int $id)
    {
        return $this->apiLivroService->update($request->all(), $id);
    }

    public function destroy(int $id)
    {
        return $this->apiLivroService->destroy($id);
    }

    public function gerarRelatorio() 
    {
        $generatePDF = $this->apiLivroService->generatePDF()->toArray();
        $pdf = Pdf::loadView('gerarRelatorio', compact('generatePDF'));

        return $pdf->download('gerarRelatorio.pdf');
    }
}
