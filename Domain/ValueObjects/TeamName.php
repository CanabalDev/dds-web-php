<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

class TeamName
{
    private string $value;

    public function __construct(string $value)
    {
        if (strlen($value) < 2) {
            throw new \InvalidArgumentException("El nombre del equipo es inválido");
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
