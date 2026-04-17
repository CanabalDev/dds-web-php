<?php

declare(strict_types=1);

namespace Application\Ports\In\User;

use Domain\Models\UserModel;

interface GetUsersUseCase
{
    /**
     * @return UserModel[]
     */
    public function execute(): array;
}
