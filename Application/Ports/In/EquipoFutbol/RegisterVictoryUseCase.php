<?php

declare(strict_types=1);

namespace Application\Ports\In\Equipo;

interface RegisterVictoryUseCase
{
    public function execute(string $teamId): void;
}
