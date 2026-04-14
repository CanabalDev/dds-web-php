<?php

declare(strict_types=1);

namespace Domain\Models;

use Domain\ValueObjects\UserId;
use Domain\ValueObjects\UserName;
use Domain\ValueObjects\UserEmail;
use Domain\ValueObjects\UserPassword;

class UserModel
{
    private UserId $id;
    private UserName $name;
    private UserEmail $email;
    private UserPassword $password;

    public function __construct(
        UserId $id,
        UserName $name,
        UserEmail $email,
        UserPassword $password
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getName(): UserName
    {
        return $this->name;
    }

    public function getEmail(): UserEmail
    {
        return $this->email;
    }

    public function getPassword(): UserPassword
    {
        return $this->password;
    }
}
