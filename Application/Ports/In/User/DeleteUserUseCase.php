<?php

declare(strict_types=1);

namespace Application\Ports\In\User;

interface DeleteUserUseCase
{
    public function execute(string $id): void;
}
