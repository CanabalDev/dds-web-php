<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\MySQL;

use PDO;
use Domain\Models\EquipoFutbol;
use Domain\Models\UserModel;

use Domain\ValueObjects\TeamName;
use Domain\ValueObjects\TeamCountry;
use Domain\ValueObjects\TeamCity;
use Domain\ValueObjects\TeamCategory;

use Application\Ports\Out\Equipo\SaveEquipoPort;
use Application\Ports\Out\Equipo\UpdateEquipoPort;
use Application\Ports\Out\Equipo\GetEquipoByIdPort;
use Application\Ports\Out\Equipo\GetEquiposPort;
use Application\Ports\Out\Equipo\DeleteEquipoPort;
use Application\Ports\Out\User\GetUserByIdPort;

class EquipoRepositoryMySQL implements
    SaveEquipoPort,
    UpdateEquipoPort,
    GetEquipoByIdPort,
    GetEquiposPort,
    DeleteEquipoPort
{
    public function __construct(
        private PDO $pdo,
        private GetUserByIdPort $userPort
    ) {
    }

    public function save(EquipoFutbol $equipo): EquipoFutbol
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO equipos 
            (nombre, eslogan, tecnico_id, pais, ciudad, categoria,
             num_goles, num_partidos, num_ganados, num_campeonatos,
             num_expulsiones, num_empates)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $equipo->getNombre()->value(),
            $equipo->getEslogan(),
            $equipo->getTecnico()->getId()->value(),
            $equipo->getPais()->value(),
            $equipo->getCiudad()->value(),
            $equipo->getCategoria()->value(),
            $equipo->getNumGoles(),
            $equipo->getNumPartidosJugados(),
            $equipo->getNumPartidosGanados(),
            $equipo->getNumCampeonatos(),
            $equipo->getNumExpulsiones(),
            $equipo->getNumEmpates()
        ]);

        $id = (int) $this->pdo->lastInsertId();
        $equipo->setId($id);

        return $equipo;
    }

    public function update(EquipoFutbol $equipo): EquipoFutbol
    {
        $id = $equipo->getId();

        if (!$id) {
            throw new \Exception("Equipo inválido para actualizar");
        }

        $stmt = $this->pdo->prepare("UPDATE equipos SET
            nombre = ?,
            eslogan = ?,
            tecnico_id = ?,
            pais = ?,
            ciudad = ?,
            categoria = ?,
            num_goles = ?,
            num_partidos = ?,
            num_ganados = ?,
            num_campeonatos = ?,
            num_expulsiones = ?,
            num_empates = ?
            WHERE id = ?");

        $stmt->execute([
            $equipo->getNombre()->value(),
            $equipo->getEslogan(),
            $equipo->getTecnico()->getId()->value(),
            $equipo->getPais()->value(),
            $equipo->getCiudad()->value(),
            $equipo->getCategoria()->value(),
            $equipo->getNumGoles(),
            $equipo->getNumPartidosJugados(),
            $equipo->getNumPartidosGanados(),
            $equipo->getNumCampeonatos(),
            $equipo->getNumExpulsiones(),
            $equipo->getNumEmpates(),
            $id
        ]);

        return $equipo;
    }

    public function findById(string $id): ?EquipoFutbol
    {
        $stmt = $this->pdo->prepare("SELECT * FROM equipos WHERE id = ?");
        $stmt->execute([$id]);

        $data = $stmt->fetch();

        return $data ? $this->mapToModel($data) : null;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM equipos");

        $equipos = [];

        while ($row = $stmt->fetch()) {
            $equipos[] = $this->mapToModel($row);
        }

        return $equipos;
    }

    public function delete(string $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM equipos WHERE id = ?");
        $stmt->execute([$id]);
    }

    private function mapToModel(array $data): EquipoFutbol
    {
        $tecnico = $this->userPort->findById($data['tecnico_id']);

        if (!$tecnico) {
            throw new \Exception("Técnico no encontrado para el equipo");
        }

        return new EquipoFutbol(
            new TeamName($data['nombre']),
            $data['eslogan'],
            $tecnico,
            new TeamCountry($data['pais']),
            new TeamCity($data['ciudad']),
            new TeamCategory($data['categoria']),
            (int) $data['num_goles'],
            (int) $data['num_partidos'],
            (int) $data['num_ganados'],
            (int) $data['num_campeonatos'],
            (int) $data['num_expulsiones'],
            (int) $data['num_empates'],
            (int) $data['id']
        );
    }
}