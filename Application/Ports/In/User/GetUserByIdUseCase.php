<?php

declare(strict_types=1);

namespace Application\Ports\In\User;

use Domain\Models\UserModel;

interface GetUserByIdUseCase
{
    public function execute(string $id): ?UserModel;
}
