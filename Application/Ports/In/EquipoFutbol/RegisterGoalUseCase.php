<?php

declare(strict_types=1);

namespace Application\Ports\In;

interface RegisterGoalUseCase
{
    public function execute(string $teamId): void;
}
