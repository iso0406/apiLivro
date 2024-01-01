<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DTO\TbAssuntoDTO;
use App\Services\AssuntoService;

class AssuntoController extends Controller
{
   /**
     * Private constructor
     * @param AssuntoService $assuntoService
     */
    private $assuntoService;

    public function __construct(AssuntoService $assuntoService)
    {
        $this->assuntoService = $assuntoService;
    }

    public function index()
    {
        return $this->assuntoService->index();
    }

    public function create(Request $request)
    {
        return $this->assuntoService->create(TbAssuntoDTO::create($request->all()));
    }

    public function show(int $id)
    {
        return $this->assuntoService->show($id);
    }

    public function update(Request $request, int $id)
    {
        return $this->assuntoService->update($request->all(), $id);
    }

    public function destroy(int $id)
    {
        return $this->assuntoService->destroy($id);
    }
}
