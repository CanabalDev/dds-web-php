<?php

declare(strict_types=1);

namespace Application\Ports\In\Equipo;

interface DeleteEquipoUseCase
{
    public function execute(string $id): void;
}
