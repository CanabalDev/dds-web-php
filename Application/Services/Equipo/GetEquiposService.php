<?php

namespace Application\Services\Equipo;

use Application\Ports\In\Equipo\GetEquiposUseCase;
use Application\Ports\Out\Equipo\GetEquiposPort;

class GetEquiposService implements GetEquiposUseCase
{
    public function __construct(
        private GetEquiposPort $port
    ) {}

    public function execute(): array
    {
        return $this->port->findAll();
    }
}
