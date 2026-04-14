<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

class TeamCoach
{
    private string $value;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException("El técnico no puede estar vacío");
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
