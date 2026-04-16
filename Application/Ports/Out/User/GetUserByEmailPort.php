<?php

declare(strict_types=1);

namespace Application\Ports\Out\User;

use Domain\Models\UserModel;

interface GetUserByEmailPort
{
    public function findByEmail(string $email): ?UserModel;
}