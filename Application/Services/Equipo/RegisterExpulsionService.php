<?php

namespace Application\Services\Equipo;

use Application\Ports\In\Equipo\RegisterExpulsionUseCase;
use Application\Ports\Out\Equipo\GetEquipoByIdPort;
use Application\Ports\Out\Equipo\UpdateEquipoPort;

class RegisterExpulsionService implements RegisterExpulsionUseCase
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

    $equipo->registrarExpulsion();

    $this->updatePort->update($equipo);
  }
}