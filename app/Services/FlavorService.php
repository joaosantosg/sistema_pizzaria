<?php

namespace App\Services;

use App\Contracts\FlavorServiceInterface;
use App\Http\Enums\TamanhoEnum;
use App\Models\Flavor;

class FlavorService implements FlavorServiceInterface
{
    public function getAllFlavors()
    {
        return Flavor::select('id', 'sabor', 'preco', 'tamanho')->paginate(10);
    }

    public function getFlavorById(string $id)
    {
        return Flavor::find($id);
    }

    public function createFlavor(array $data)
    {
        return Flavor::create([
            'sabor' => $data['sabor'],
            'preco' => $data['preco'],
            'tamanho' => TamanhoEnum::from($data['tamanho']),
        ]);
    }

    public function updateFlavor(string $id, array $data)
    {
        $flavor = $this->getFlavorById($id);
        if ($flavor) {
            $flavor->update($data);
            return $flavor;
        }
        return null;
    }

    public function deleteFlavor(string $id)
    {
        $flavor = $this->getFlavorById($id);
        if ($flavor) {
            $flavor->delete();
            return true;
        }
        return false;
    }
}
