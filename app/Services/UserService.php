<?php

namespace App\Services;

use App\Contracts\UserServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    public function getAllUsers()
    {
        return User::select('id', 'name', 'email', 'created_at')->paginate(10);
    }

    public function getCurrentUser()
    {
        return Auth::user();
    }

    public function getUserById(string $id)
    {
        return User::find($id);
    }

    public function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function updateUser(string $id, array $data)
    {
        $user = $this->getUserById($id);
        if ($user) {
            if (isset($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            }
            $user->update($data);
            return $user;
        }
        return null;
    }

    public function deleteUser(string $id)
    {
        $user = $this->getUserById($id);
        if ($user) {
            $user->delete();
            return true;
        }
        return false;
    }
}
