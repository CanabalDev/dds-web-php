<?php

declare(strict_types=1);

namespace Application\Commands;

class UpdateEquipoCommand
{
    public function __construct(
        public string $id,
        public string $nombre,
        public string $eslogan,
        public string $pais,
        public string $ciudad,
        public string $categoria
    ) {}
}
