<?php

declare(strict_types=1);

namespace Application\Ports\In;

interface DeleteEquipoUseCase
{
    public function execute(string $id): void;
}
