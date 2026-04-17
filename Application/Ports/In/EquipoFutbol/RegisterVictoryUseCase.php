<?php

declare(strict_types=1);

namespace Application\Ports\In;

interface RegisterVictoryUseCase
{
    public function execute(string $teamId): void;
}
