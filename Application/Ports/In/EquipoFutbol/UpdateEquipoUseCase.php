<?php

declare(strict_types=1);

namespace Application\Ports\In;

use Application\Commands\UpdateEquipoCommand;
use Domain\Models\EquipoFutbol;

interface UpdateEquipoUseCase
{
    public function execute(UpdateEquipoCommand $command): EquipoFutbol;
}
