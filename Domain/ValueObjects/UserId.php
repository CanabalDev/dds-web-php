<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

class UserId
{
    private string $value;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException("El ID no puede estar vacío");
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
