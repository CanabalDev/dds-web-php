<?php

declare(strict_types=1);

namespace Domain\Models;

use Domain\ValueObjects\TeamName;
use Domain\ValueObjects\TeamCountry;
use Domain\ValueObjects\TeamCity;
use Domain\ValueObjects\TeamCategory;

class EquipoFutbol
{
    private TeamName $nombre;
    private string $eslogan;
    private UserModel $tecnico;
    private TeamCountry $pais;
    private TeamCity $ciudad;
    private TeamCategory $categoria;

    private int $numGoles;
    private int $numPartidosJugados;
    private int $numPartidosGanados;
    private int $numCampeonatos;
    private int $numExpulsiones;
    private int $numEmpates;

    public function __construct(
        TeamName $nombre,
        string $eslogan,
        UserModel $tecnico,
        TeamCountry $pais,
        TeamCity $ciudad,
        TeamCategory $categoria,
        int $numGoles = 0,
        int $numPartidosJugados = 0,
        int $numPartidosGanados = 0,
        int $numCampeonatos = 0,
        int $numExpulsiones = 0,
        int $numEmpates = 0
    ) {
        if ($numGoles < 0 || $numPartidosJugados < 0 || $numPartidosGanados < 0 ||
            $numCampeonatos < 0 || $numExpulsiones < 0 || $numEmpates < 0) {
            throw new \InvalidArgumentException("Los valores numéricos no pueden ser negativos");
        }

        $this->nombre = $nombre;
        $this->eslogan = $eslogan;
        $this->tecnico = $tecnico;
        $this->pais = $pais;
        $this->ciudad = $ciudad;
        $this->categoria = $categoria;
        $this->numGoles = $numGoles;
        $this->numPartidosJugados = $numPartidosJugados;
        $this->numPartidosGanados = $numPartidosGanados;
        $this->numCampeonatos = $numCampeonatos;
        $this->numExpulsiones = $numExpulsiones;
        $this->numEmpates = $numEmpates;
    }

    // Getters

    public function getNombre(): TeamName { return $this->nombre; }
    public function getEslogan(): string { return $this->eslogan; }
    public function getTecnico(): UserModel { return $this->tecnico; }
    public function getPais(): TeamCountry { return $this->pais; }
    public function getCiudad(): TeamCity { return $this->ciudad; }
    public function getCategoria(): TeamCategory { return $this->categoria; }

    public function getNumGoles(): int { return $this->numGoles; }
    public function getNumPartidosJugados(): int { return $this->numPartidosJugados; }
    public function getNumPartidosGanados(): int { return $this->numPartidosGanados; }
    public function getNumCampeonatos(): int { return $this->numCampeonatos; }
    public function getNumExpulsiones(): int { return $this->numExpulsiones; }
    public function getNumEmpates(): int { return $this->numEmpates; }

    // Setters
    public function setNombre(TeamName $nombre): void { $this->nombre = $nombre; }
    public function setEslogan(string $eslogan): void { $this->eslogan = $eslogan; }
    public function setTecnico(UserModel $tecnico): void { $this->tecnico = $tecnico; }
    public function setPais(TeamCountry $pais): void { $this->pais = $pais; }
    public function setCiudad(TeamCity $ciudad): void { $this->ciudad = $ciudad; }
    public function setCategoria(TeamCategory $categoria): void { $this->categoria = $categoria; }

    
    // Registrar un gol
    public function registrarGol(): int { 
        $this->numGoles++;
        return $this->numGoles;
    }

    // Registrar partido ganado
    public function registrarVictoria(): int {
        $this->numPartidosJugados++;
        $this->numPartidosGanados++;
        return $this->numPartidosGanados;
    }

    // Registrar empate
    public function registrarEmpate(): int {
        $this->numPartidosJugados++;
        $this->numEmpates++;
        return $this->numEmpates;
    }

    // Registrar expulsión
    public function registrarExpulsion(): int {
        $this->numExpulsiones++;
        return $this->numExpulsiones;
    }

    // Registrar campeonato
    public function registrarCampeonato(): int {
        $this->numCampeonatos++;
        return $this->numCampeonatos;
    }
}
