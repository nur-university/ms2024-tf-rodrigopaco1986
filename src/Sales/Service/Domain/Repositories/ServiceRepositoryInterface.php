<?php

namespace Src\Sales\Service\Domain\Repositories;

use Src\Sales\Service\Domain\Entities\Service;

interface ServiceRepositoryInterface
{
    public function findById(string $id): Service;

    public function findByIds(array $ids): array;
}
