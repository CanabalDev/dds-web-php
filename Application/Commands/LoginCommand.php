<?php

declare(strict_types=1);

namespace Application\Commands;

class LoginCommand
{
    public function __construct(
        public string $email,
        public string $password
    ) {}
}
