<?php

declare(strict_types=1);

namespace Application\Ports\Out;

use Domain\Models\EquipoFutbol;

interface GetEquipoByIdPort
{
    public function findById(string $id): ?EquipoFutbol;
}
