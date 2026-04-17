<?php

namespace Application\Services\Equipo;

use Application\Ports\In\Equipo\GetEquipoByIdUseCase;
use Application\Ports\Out\Equipo\GetEquipoByIdPort;
use Domain\Models\EquipoFutbol;

class GetEquipoByIdService implements GetEquipoByIdUseCase
{
    public function __construct(
        private GetEquipoByIdPort $port
    ) {}

    public function execute(string $id): ?EquipoFutbol
    {
        return $this->port->findById($id);
    }
}
