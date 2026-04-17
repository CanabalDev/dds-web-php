<?php

namespace Application\Services\Equipo;

use Application\Ports\In\Equipo\DeleteEquipoUseCase;
use Application\Ports\Out\Equipo\DeleteEquipoPort;

class DeleteEquipoService implements DeleteEquipoUseCase
{
    public function __construct(
        private DeleteEquipoPort $port
    ) {}

    public function execute(string $id): void
    {
        $this->port->delete($id);
    }
}
