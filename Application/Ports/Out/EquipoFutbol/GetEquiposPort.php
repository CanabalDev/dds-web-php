<?php

declare(strict_types=1);

namespace Application\Ports\Out;

use Domain\Models\EquipoFutbol;

interface GetEquiposPort
{
    /**
     * @return EquipoFutbol[]
     */
    public function findAll(): array;
}
