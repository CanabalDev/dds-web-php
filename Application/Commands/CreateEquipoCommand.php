<?php

declare(strict_types=1);

namespace Application\Commands;

class CreateEquipoCommand
{
    public function __construct(
        public string $nombre,
        public string $eslogan,
        public string $tecnicoId,
        public string $pais,
        public string $ciudad,
        public string $categoria
    ) {}
}
