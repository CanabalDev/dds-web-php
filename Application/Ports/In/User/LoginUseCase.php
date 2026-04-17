<?php

declare(strict_types=1);

namespace Application\Ports\In\User;

use Application\Commands\LoginCommand;
use Domain\Models\UserModel;

interface LoginUseCase
{
    public function execute(LoginCommand $command): UserModel;
}
