<?php

declare(strict_types=1);

namespace Application\Ports\In\Equipo;

interface RegisterExpulsionUseCase
{
  public function execute(string $teamId): void;
}