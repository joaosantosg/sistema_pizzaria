<?php

namespace App\Services;

use App\Http\Enums\TamanhoEnum;
use App\Services\Contracts\FlavorServiceInterface;
use App\Repositories\Contracts\FlavorRepositoryInterface;

class FlavorService implements FlavorServiceInterface
{
    protected $flavorRepository;

    public function __construct(FlavorRepositoryInterface $flavorRepository)
    {
        $this->flavorRepository = $flavorRepository;
    }

    public function getAllFlavors()
    {
        return $this->flavorRepository->all(10);
    }

    public function getFlavorById(string $id)
    {
        return $this->flavorRepository->findById($id);
    }

    public function createFlavor(array $data)
    {
        $data['tamanho'] = TamanhoEnum::from($data['tamanho']);
        return $this->flavorRepository->create($data);
    }

    public function updateFlavor(string $id, array $data)
    {
        if (isset($data['tamanho'])) {
            $data['tamanho'] = TamanhoEnum::from($data['tamanho']);
        }

        $flavor = $this->flavorRepository->findById($id);
        if ($flavor) {
            $this->flavorRepository->update($id, $data);
            return $flavor;
        }

        return null;
    }

    public function deleteFlavor(string $id)
    {
        return $this->flavorRepository->delete($id);
    }
}
