<?php

namespace Application\Services\User;

use Application\Ports\In\User\GetUsersUseCase;
use Application\Ports\Out\User\GetUsersPort;

class GetUsersService implements GetUsersUseCase
{
    public function __construct(
        private GetUsersPort $port
    ) {}

    public function execute(): array
    {
        return $this->port->findAll();
    }
}
