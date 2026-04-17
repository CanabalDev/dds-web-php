<?php

declare(strict_types=1);

namespace Application\Commands;

class UpdateUserCommand
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email,
        public ?string $password = null
    ) {}
}
