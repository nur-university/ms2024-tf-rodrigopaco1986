<?php

namespace Src\Sales\Patient\Infraestructure\Repositories;

use Exception;
use Src\Sales\Patient\Domain\Entities\Patient;
use Src\Sales\Patient\Domain\Repositories\PatientRepositoryInterface;
use Src\Sales\Patient\Infraestructure\Mappers\PatientMapper;
use Src\Sales\Shared\Application\Services\HttpClient;

class PatientRepository implements PatientRepositoryInterface
{
    //TODO: move to a settings the endoint
    const URL = 'http://localhost:8000/fake/patient/%s';

    public function findById(string $id): Patient
    {
        $url = sprintf(
            self::URL,
            $id
        );

        try {

            $response = HttpClient::client()
                ->get($url)
                ->getBody()
                ->getContents();

            return PatientMapper::toEntity(json_decode($response));

        } catch (Exception $e) {
            throw new Exception('Error getting patient info for: '.$id);
        }
    }
}
