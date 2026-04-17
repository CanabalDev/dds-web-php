<?php

declare(strict_types=1);

namespace Application\Ports\Out\Equipo;

use Domain\Models\EquipoFutbol;

interface SaveEquipoPort
{
    public function save(EquipoFutbol $equipo): EquipoFutbol;
}
