<?php

namespace Application\Services\User;

use Application\Ports\In\User\UpdateUserUseCase;
use Application\Ports\Out\User\UpdateUserPort;
use Application\Ports\Out\User\GetUserByIdPort;
use Application\Commands\UpdateUserCommand;
use Domain\Models\UserModel;
use Domain\ValueObjects\UserName;
use Domain\ValueObjects\UserEmail;
use Domain\ValueObjects\UserPassword;

class UpdateUserService implements UpdateUserUseCase
{
    public function __construct(
        private UpdateUserPort $updatePort,
        private GetUserByIdPort $getPort
    ) {}

    public function execute(UpdateUserCommand $command): UserModel
    {
        $user = $this->getPort->findById($command->id);

        if (!$user) {
            throw new \Exception("Usuario no encontrado");
        }

        // Actualizar datos
        $name = new UserName($command->name);
        $email = new UserEmail($command->email);

        $password = $command->password
            ? UserPassword::fromPlainText($command->password)
            : $user->getPassword();

        $updatedUser = new UserModel(
            $user->getId(),
            $name,
            $email,
            $password
        );

        return $this->updatePort->update($updatedUser);
    }
}
