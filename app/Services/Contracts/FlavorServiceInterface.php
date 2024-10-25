<?php

namespace App\Services\Contracts;

interface FlavorServiceInterface
{
    public function getAllFlavors();
    public function getFlavorById(string $id);
    public function createFlavor(array $data);
    public function updateFlavor(string $id, array $data);
    public function deleteFlavor(string $id);
}
