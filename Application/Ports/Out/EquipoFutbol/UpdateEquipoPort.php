<?php

declare(strict_types=1);

namespace Application\Ports\Out\Equipo;

use Domain\Models\EquipoFutbol;

interface UpdateEquipoPort
{
    public function update(EquipoFutbol $equipo): EquipoFutbol;
}