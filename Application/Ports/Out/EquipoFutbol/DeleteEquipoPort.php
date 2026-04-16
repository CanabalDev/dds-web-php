<?php

declare(strict_types=1);

namespace Application\Ports\Out\Equipo;

interface DeleteEquipoPort
{
    public function delete(string $id): void;
}