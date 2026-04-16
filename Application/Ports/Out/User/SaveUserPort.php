<?php

declare(strict_types=1);

namespace Application\Ports\Out\User;

use Domain\Models\UserModel;

interface SaveUserPort
{
    public function save(UserModel $user): UserModel;
}