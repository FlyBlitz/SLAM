<?php

declare(strict_types=1);

class Station
{
    private string $nom;
    private string $zoneMaritime;

    /** @var Drone[] */
    private array $drones;

    public function __construct(string $nom, string $zoneMaritime)
    {
        $this->nom = $nom;
        $this->zoneMaritime = $zoneMaritime;
        $this->drones = [];
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getZoneMaritime(): string
    {
        return $this->zoneMaritime;
    }

    /** @return Drone[] */
    public function getDrones(): array
    {
        return $this->drones;
    }

    public function getNombreDrones(): int
    {
        return count($this->drones);
    }

    public function ajouterDrone(Drone $drone): bool
    {
        // La comparaison stricte recherche le même objet.
        if (in_array($drone, $this->drones, true)) {
            return false;
        }

        $this->drones[] = $drone;
        return true;
    }
}