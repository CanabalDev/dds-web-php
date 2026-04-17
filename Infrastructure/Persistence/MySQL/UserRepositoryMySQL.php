<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\MySQL;

use PDO;
use Domain\Models\UserModel;
use Domain\ValueObjects\UserId;
use Domain\ValueObjects\UserName;
use Domain\ValueObjects\UserEmail;
use Domain\ValueObjects\UserPassword;

use Application\Ports\Out\User\SaveUserPort;
use Application\Ports\Out\User\GetUserByIdPort;
use Application\Ports\Out\User\GetUsersPort;
use Application\Ports\Out\User\DeleteUserPort;
use Application\Ports\Out\User\GetUserByEmailPort;
use Application\Ports\Out\User\UpdateUserPort;

class UserRepositoryMySQL implements
    SaveUserPort,
    GetUserByIdPort,
    GetUsersPort,
    DeleteUserPort,
    GetUserByEmailPort,
    UpdateUserPort
{
    public function __construct(private PDO $pdo) {}

    public function save(UserModel $user): UserModel
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO users (id, name, email, password)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->execute([
            $user->getId()->value(),
            $user->getName()->value(),
            $user->getEmail()->value(),
            $user->getPassword()->value()
        ]);

        return $user;
    }

    public function findById(string $id): ?UserModel
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);

        $data = $stmt->fetch();

        return $data ? $this->mapToModel($data) : null;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM users");

        $users = [];

        while ($row = $stmt->fetch()) {
            $users[] = $this->mapToModel($row);
        }

        return $users;
    }

    public function delete(string $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function findByEmail(string $email): ?UserModel
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        $data = $stmt->fetch();

        return $data ? $this->mapToModel($data) : null;
    }

    public function update(UserModel $user): UserModel
    {
        $stmt = $this->pdo->prepare("
            UPDATE users
            SET name = ?, email = ?, password = ?
            WHERE id = ?
        ");

        $stmt->execute([
            $user->getName()->value(),
            $user->getEmail()->value(),
            $user->getPassword()->value(),
            $user->getId()->value()
        ]);

        return $user;
    }

    private function mapToModel(array $data): UserModel
    {
        return new UserModel(
            new UserId($data['id']),
            new UserName($data['name']),
            new UserEmail($data['email']),
            UserPassword::fromHash($data['password'])
        );
    }
}
