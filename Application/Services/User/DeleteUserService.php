<?php

namespace Application\Services\User;

use Application\Ports\In\User\DeleteUserUseCase;
use Application\Ports\Out\User\DeleteUserPort;

class DeleteUserService implements DeleteUserUseCase
{
    public function __construct(
        private DeleteUserPort $port
    ) {}

    public function execute(string $id): void
    {
        $this->port->delete($id);
    }
}
