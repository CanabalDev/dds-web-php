<?php

declare(strict_types=1);

namespace Application\Ports\In;

use Domain\Models\EquipoFutbol;

interface GetEquipoByIdUseCase
{
    public function execute(string $id): ?EquipoFutbol;
}
