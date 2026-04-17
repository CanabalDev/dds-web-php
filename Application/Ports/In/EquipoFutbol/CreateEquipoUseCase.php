<?php

declare(strict_types=1);

namespace Application\Ports\In\Equipo;

use Application\Commands\CreateEquipoCommand;
use Domain\Models\EquipoFutbol;

interface CreateEquipoUseCase
{
    public function execute(CreateEquipoCommand $command): EquipoFutbol;
}
