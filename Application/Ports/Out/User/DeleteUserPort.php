<?php

declare(strict_types=1);

namespace Application\Ports\Out\User;

interface DeleteUserPort
{
    public function delete(string $id): void;
}