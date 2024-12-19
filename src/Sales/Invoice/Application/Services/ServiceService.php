<?php

namespace Src\Sales\Invoice\Application\Services;

use Src\Sales\Service\Domain\Entities\Service;
use Src\Sales\Service\Domain\Repositories\ServiceRepositoryInterface;

class ServiceService
{
    private ServiceRepositoryInterface $serviceRepository;

    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function getServiceInfo(string $service): Service
    {
        return $this->serviceRepository->findById($service);
    }

    public function getServicesInfo(array $serviceIds): array
    {
        return $this->serviceRepository->findByIds($serviceIds);
    }
}
