<?php

namespace App\Repositories;

use App\Models\Flavor;
use App\Repositories\Contracts\FlavorRepositoryInterface;

class FlavorRepository implements FlavorRepositoryInterface
{
    public function all(int $paginate = 10)
    {
        return Flavor::select('id', 'sabor', 'preco', 'tamanho')->paginate($paginate);
    }

    public function findById(string $id): ?Flavor
    {
        return Flavor::find($id);
    }

    public function create(array $data): Flavor
    {
        return Flavor::create([
            'sabor' => $data['sabor'],
            'preco' => $data['preco'],
            'tamanho' => $data['tamanho'],
        ]);
    }

    public function update(string $id, array $data): bool
    {
        $flavor = Flavor::find($id);

        if (!$flavor) {
            return false;
        }

        return $flavor->update($data);
    }

    public function delete(string $id): bool
    {
        $flavor = Flavor::find($id);

        if (!$flavor) {
            return false;
        }

        return $flavor->delete();
    }
}
