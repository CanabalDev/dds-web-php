<?php

namespace Application\Services\User;

use Application\Ports\In\User\GetUserByIdUseCase;
use Application\Ports\Out\User\GetUserByIdPort;
use Domain\Models\UserModel;

class GetUserByIdService implements GetUserByIdUseCase
{
    public function __construct(
        private GetUserByIdPort $port
    ) {}

    public function execute(string $id): ?UserModel
    {
        return $this->port->findById($id);
    }
}
