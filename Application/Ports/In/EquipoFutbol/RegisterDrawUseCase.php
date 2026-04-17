<?php

declare(strict_types=1);

namespace Application\Ports\In\EquipoFutbol;

interface RegisterDrawUseCase
{
  public function execute(string $teamId): void;
}