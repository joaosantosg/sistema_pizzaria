<?php

namespace App\Http\Controllers;

use App\Contracts\FlavorServiceInterface;
use App\Http\Requests\FlavorCreatRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FlavorController extends Controller
{
    protected FlavorServiceInterface $flavorService;

    public function __construct(FlavorServiceInterface $flavorService)
    {
        $this->flavorService = $flavorService;
    }

    public function index(): JsonResponse
    {
        $flavors = $this->flavorService->getAllFlavors();

        return response()->json([
            'status' => 200,
            'message' => 'Sabores encontrados!',
            'sabores' => $flavors,
        ]);
    }

    public function store(FlavorCreatRequest $request): JsonResponse
    {
        $flavor = $this->flavorService->createFlavor($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Sabor cadastrado com sucesso!',
            'sabor' => $flavor,
        ]);
    }

    public function show(string $id): JsonResponse
    {
        $flavor = $this->flavorService->getFlavorById($id);

        if (!$flavor) {
            return response()->json([
                'status' => 404,
                'message' => 'Sabor não encontrado! Que triste!',
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Sabor encontrado com sucesso!',
            'sabor' => $flavor,
        ]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $flavor = $this->flavorService->updateFlavor($id, $request->all());

        if (!$flavor) {
            return response()->json([
                'status' => 404,
                'message' => 'Sabor não encontrado! Que triste!',
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Sabor atualizado com sucesso!',
            'sabor' => $flavor,
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        if ($this->flavorService->deleteFlavor($id)) {
            return response()->json([
                'status' => 200,
                'message' => 'Sabor deletado com sucesso!',
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Sabor não encontrado! Que triste!',
        ]);
    }
}
