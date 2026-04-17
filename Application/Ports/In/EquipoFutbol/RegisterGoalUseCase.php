<?php

declare(strict_types=1);

namespace Application\Ports\In\Equipo;

interface RegisterGoalUseCase
{
    public function execute(string $teamId): void;
}
