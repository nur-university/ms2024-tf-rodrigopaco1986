<?php

namespace Src\Sales\Order\Application\Queries;

class GetOrderQuery
{
    public string $orderId;

    public function __construct(string $orderId)
    {
        $this->orderId = $orderId;
    }
}
