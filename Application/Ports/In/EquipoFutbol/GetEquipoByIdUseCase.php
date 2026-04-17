<?php

declare(strict_types=1);

namespace Application\Ports\In\Equipo;

use Domain\Models\EquipoFutbol;

interface GetEquipoByIdUseCase
{
    public function execute(string $id): ?EquipoFutbol;
}
