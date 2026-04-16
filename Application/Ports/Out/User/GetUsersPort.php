<?php

declare(strict_types=1);

namespace Application\Ports\Out\User;

use Domain\Models\UserModel;

interface GetUsersPort
{
    /**
     * @return UserModel[]
     */
    public function findAll(): array;
}