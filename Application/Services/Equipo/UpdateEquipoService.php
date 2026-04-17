<?php

namespace Application\Services\Equipo;

use Application\Ports\In\Equipo\UpdateEquipoUseCase;
use Application\Ports\Out\Equipo\GetEquipoByIdPort;
use Application\Ports\Out\Equipo\UpdateEquipoPort;
use Application\Ports\Out\User\GetUserByIdPort;
use Application\Commands\UpdateEquipoCommand;
use Domain\Models\EquipoFutbol;
use Domain\ValueObjects\TeamName;
use Domain\ValueObjects\TeamCountry;
use Domain\ValueObjects\TeamCity;
use Domain\ValueObjects\TeamCategory;

class UpdateEquipoService implements UpdateEquipoUseCase
{
  public function __construct(
    private GetEquipoByIdPort $getPort,
    private UpdateEquipoPort $updatePort,
    private GetUserByIdPort $userPort
  ) {
  }

  public function execute(UpdateEquipoCommand $command): EquipoFutbol
  {
    $equipo = $this->getPort->findById($command->id);

    if (!$equipo) {
      throw new \Exception("Equipo no encontrado");
    }

    $tecnico = $this->userPort->findById($command->tecnicoId);

    if (!$tecnico) {
      throw new \Exception("Técnico no encontrado");
    }

    $equipo->setNombre(new TeamName($command->nombre));
    $equipo->setEslogan($command->eslogan);
    $equipo->setTecnico($tecnico);
    $equipo->setPais(new TeamCountry($command->pais));
    $equipo->setCiudad(new TeamCity($command->ciudad));
    $equipo->setCategoria(new TeamCategory($command->categoria));

    return $this->updatePort->update($equipo);
  }
}