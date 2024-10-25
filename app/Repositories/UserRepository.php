<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function all(int $paginate = 10)
    {
        return User::select('id', 'name', 'email')->paginate($paginate);
    }

    public function findById(string $id): ?User
    {
        return User::find($id);
    }

    public function create(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function update(string $id, array $data): bool
    {
        $user = User::find($id);

        if (!$user) {
            return false;
        }

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        return $user->update($data);
    }

    public function delete(string $id): bool
    {
        $user = User::find($id);

        if (!$user) {
            return false;
        }

        return $user->delete();
    }
}
