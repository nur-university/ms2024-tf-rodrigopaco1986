<?php

namespace Src\Sales\Invoice\Application\Services;

use Src\Sales\Company\Domain\Entities\Company;

class CompanyService
{
    //TODO: Call from micro service
    public function getInfo(): Company
    {
        return new Company(
            'Nur-tricenter',
            '171283817238128',
            '465A9780DBD5FD71F22F720B938CAF5AE3EB03980654FFCCE54549E74',
            'AVENIDA CRISTO REDENTOR NRO. 100 ZONA/BARRIO: VICTORIANO RIVERO',
            '3363939',
        );
    }
}
