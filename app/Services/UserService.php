<?php

namespace App\Services;

use App\Services\Contracts\UserServiceInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->all(10);
    }

    public function getCurrentUser()
    {
        return Auth::user();
    }

    public function getUserById(string $id)
    {
        return $this->userRepository->findById($id);
    }

    public function createUser(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function updateUser(string $id, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user = $this->userRepository->findById($id);
        if ($user) {
            $this->userRepository->update($id, $data);
            return $user;
        }

        return null;
    }

    public function deleteUser(string $id)
    {
        return $this->userRepository->delete($id);
    }
}
