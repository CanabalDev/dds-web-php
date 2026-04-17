<?php

namespace Application\Services\User;

use Application\Ports\In\User\LoginUseCase;
use Application\Ports\Out\User\GetUserByEmailPort;
use Application\Commands\LoginCommand;
use Domain\Models\UserModel;

class LoginService implements LoginUseCase
{
    public function __construct(
        private GetUserByEmailPort $port
    ) {}

    public function execute(LoginCommand $command): UserModel
    {
        $user = $this->port->findByEmail($command->email);

        if (!$user || !$user->getPassword()->verify($command->password)) {
            throw new \Exception("Credenciales inválidas");
        }

        return $user;
    }
}
