<?php

namespace App\Repositories\Contracts;

use App\Models\Flavor;

interface FlavorRepositoryInterface
{
    public function all(int $paginate = 10);
    public function findById(string $id): ?Flavor;
    public function create(array $data): Flavor;
    public function update(string $id, array $data): bool;
    public function delete(string $id): bool;
}
