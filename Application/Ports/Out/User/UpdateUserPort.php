<?php

declare(strict_types= 1);

namespace Application\Ports\Out\User;

use Domain\Models\UserModel;

interface UpdateUserPort
{
    public function update(UserModel $user): UserModel;
}