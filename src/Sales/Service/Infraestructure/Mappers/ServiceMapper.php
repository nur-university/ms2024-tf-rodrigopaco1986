<?php

namespace Src\Sales\Service\Infraestructure\Mappers;

use Src\Sales\Service\Domain\Entities\Service as ServiceEntity;

class ServiceMapper
{
    public static function toEntity(object $service): ServiceEntity
    {
        $serviceEntity = new ServiceEntity(
            $service->code,
            $service->name,
            $service->unit,
            $service->description,
        );
        $serviceEntity->setId($service->id);

        return $serviceEntity;
    }
}
