<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    public function all(int $paginate = 10);
    public function findById(string $id): ?User;
    public function create(array $data): User;
    public function update(string $id, array $data): bool;
    public function delete(string $id): bool;
}
