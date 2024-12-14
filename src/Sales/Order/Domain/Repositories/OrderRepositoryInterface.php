<?php

namespace Src\Sales\Order\Domain\Repositories;

use Src\Sales\Order\Domain\Entities\Order;

interface OrderRepositoryInterface
{
    public function findById(string $id): ?Order;

    public function save(Order $order): ?Order;
}
