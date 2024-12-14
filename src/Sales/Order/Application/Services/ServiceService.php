<?php

namespace Src\Sales\Order\Application\Services;

use Src\Sales\Service\Domain\Entities\Service;
use Src\Sales\Service\Domain\Repositories\ServiceRepositoryInterface;

class ServiceService
{
    private ServiceRepositoryInterface $serviceRepository;

    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function getServiceInfo(string $serviceId): Service
    {
        return $this->serviceRepository->findById($serviceId);
    }

    public function getServicesInfo(array $serviceIds): array
    {
        return $this->serviceRepository->findByIds($serviceIds);
    }
}
