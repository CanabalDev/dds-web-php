<?php

declare(strict_types=1);

namespace Application\Ports\Out\User;

use Domain\Models\UserModel;

interface GetUserByIdPort
{
    public function findById(string $id): ?UserModel;
}
