<?php

declare(strict_types=1);

namespace Application\Ports\In\User;

use Application\Commands\CreateUserCommand;
use Domain\Models\UserModel;

interface CreateUserUseCase
{
    public function execute(CreateUserCommand $command): UserModel;
}
