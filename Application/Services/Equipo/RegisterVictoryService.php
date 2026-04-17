<?php

namespace Application\Services\Equipo;

use Application\Ports\In\Equipo\RegisterVictoryUseCase;
use Application\Ports\Out\Equipo\GetEquipoByIdPort;
use Application\Ports\Out\Equipo\UpdateEquipoPort;

class RegisterVictoryService implements RegisterVictoryUseCase
{
    public function __construct(
        private GetEquipoByIdPort $getPort,
        private UpdateEquipoPort $updatePort
    ) {
    }

    public function execute(string $teamId): void
    {
        $equipo = $this->getPort->findById($teamId);

        if (!$equipo) {
            throw new \Exception("Equipo no encontrado");
        }

        $equipo->registrarVictoria();

        $this->updatePort->update($equipo);
    }
}
