<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

class UserName
{
    private string $value;

    public function __construct(string $value)
    {
        if (strlen($value) < 3) {
            throw new \InvalidArgumentException("El nombre debe tener al menos 3 caracteres");
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
