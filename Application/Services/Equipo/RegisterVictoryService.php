<?php

namespace Application\Services\Equipo;

use Application\Ports\In\Equipo\RegisterVictoryUseCase;
use Application\Ports\Out\Equipo\GetEquipoByIdPort;
use Application\Ports\Out\Equipo\SaveEquipoPort;

class RegisterVictoryService implements RegisterVictoryUseCase
{
    public function __construct(
        private GetEquipoByIdPort $getPort,
        private SaveEquipoPort $savePort
    ) {}

    public function execute(string $teamId): void
    {
        $equipo = $this->getPort->findById($teamId);

        if (!$equipo) {
            throw new \Exception("Equipo no encontrado");
        }

        $equipo->registrarVictoria();

        $this->savePort->save($equipo);
    }
}
