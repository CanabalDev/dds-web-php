<?php

declare(strict_types=1);

namespace Application\Services\User;

use Application\Ports\In\User\CreateUserUseCase;
use Application\Ports\Out\User\SaveUserPort;
use Application\Commands\CreateUserCommand;
use Domain\Models\UserModel;
use Domain\ValueObjects\UserId;
use Domain\ValueObjects\UserName;
use Domain\ValueObjects\UserEmail;
use Domain\ValueObjects\UserPassword;

class CreateUserService implements CreateUserUseCase
{
    public function __construct(
        private SaveUserPort $saveUserPort
    ) {}

    public function execute(CreateUserCommand $command): UserModel
    {
        $user = new UserModel(
            new UserId($command->id),
            new UserName($command->name),
            new UserEmail($command->email),
            UserPassword::fromPlainText($command->password)
        );

        return $this->saveUserPort->save($user);
    }
}
