<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DTO\TbAutorDTO;
use App\Services\AutorService;

class AutorController extends Controller
{
    /**
     * Private constructor
     * @param AutorService $autorService
     */
    private $autorService;

    public function __construct(AutorService $autorService)
    {
        $this->autorService = $autorService;
    }

    public function index()
    {
        return $this->autorService->index();
    }

    public function create(Request $request)
    {
        return $this->autorService->create(TbAutorDTO::create($request->all()));
    }

    public function show(int $id)
    {
        return $this->autorService->show($id);
    }

    public function update(Request $request, int $id)
    {
        return $this->autorService->update($request->all(), $id);
    }

    public function destroy(int $id)
    {
        return $this->autorService->destroy($id);
    }
}
