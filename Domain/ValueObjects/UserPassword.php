<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

class UserPassword
{
    private string $value;

    private function __construct(string $hashedPassword)
    {
        $this->value = $hashedPassword;
    }

    public static function fromPlainText(string $password): self
    {
        if (strlen($password) < 6) {
            throw new \InvalidArgumentException("La contraseña debe tener al menos 6 caracteres");
        }

        $hashed = password_hash($password, PASSWORD_BCRYPT);

        return new self($hashed);
    }

    public static function fromHash(string $hash): self
    {
        return new self($hash);
    }

    public function verify(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->value);
    }

    public function value(): string
    {
        return $this->value;
    }
}
