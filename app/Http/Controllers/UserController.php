<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index(): JsonResponse
    {
        $users = $this->userService->getAllUsers();

        return response()->json([
            'status' => 200,
            'message' => 'Usuários encontrados!',
            'users' => $users,
        ]);
    }

    public function me(): JsonResponse
    {
        $user = $this->userService->getCurrentUser();

        return response()->json([
            'status' => 200,
            'message' => 'Usuário logado!',
            'user' => $user,
        ]);
    }

    public function store(UserCreateRequest $request): JsonResponse
    {
        $user = $this->userService->createUser($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Usuário cadastrado com sucesso!',
            'user' => $user,
        ]);
    }

    public function show(string $id): JsonResponse
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'Usuário não encontrado! Que triste!',
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Usuário encontrado com sucesso!',
            'user' => $user,
        ]);
    }

    public function update(UserUpdateRequest $request, string $id): JsonResponse
    {
        $user = $this->userService->updateUser($id, $request->all());

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'Usuário não encontrado! Que triste!',
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Usuário atualizado com sucesso!',
            'user' => $user,
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        if ($this->userService->deleteUser($id)) {
            return response()->json([
                'status' => 200,
                'message' => 'Usuário deletado com sucesso!',
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Usuário não encontrado! Que triste!',
        ]);
    }
}
