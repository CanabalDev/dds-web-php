<?php

declare(strict_types=1);

namespace Application\Ports\In;

use Domain\Models\EquipoFutbol;

interface GetEquiposUseCase
{
    /**
     * @return EquipoFutbol[]
     */
    public function execute(): array;
}
