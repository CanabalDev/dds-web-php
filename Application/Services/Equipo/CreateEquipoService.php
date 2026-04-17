<?php

namespace Application\Services\Equipo;

use Application\Ports\In\Equipo\CreateEquipoUseCase;
use Application\Ports\Out\Equipo\SaveEquipoPort;
use Application\Ports\Out\User\GetUserByIdPort;
use Application\Commands\CreateEquipoCommand;
use Domain\Models\EquipoFutbol;
use Domain\ValueObjects\TeamName;
use Domain\ValueObjects\TeamCountry;
use Domain\ValueObjects\TeamCity;
use Domain\ValueObjects\TeamCategory;

class CreateEquipoService implements CreateEquipoUseCase
{
    public function __construct(
        private SaveEquipoPort $savePort,
        private GetUserByIdPort $userPort
    ) {
    }

    public function execute(CreateEquipoCommand $command): EquipoFutbol
    {
        $tecnico = $this->userPort->findById($command->tecnicoId);

        if (!$tecnico) {
            throw new \Exception("Técnico no encontrado");
        }

        $equipo = new EquipoFutbol(
            new TeamName($command->nombre),
            $command->eslogan,
            $tecnico,
            new TeamCountry($command->pais),
            new TeamCity($command->ciudad),
            new TeamCategory($command->categoria)
        );

        return $this->savePort->save($equipo);
    }
}
