<?php

class Drone
{
    private string $identifiant;
    private int $profondeurMaximale;
    private Station $station;
    private array $observations;

    public function __construct(string $identifiant, int $profondeurMaximale, Station $station)
    {
        $this->identifiant = $identifiant;
        $this->profondeurMaximale = $profondeurMaximale;
        $this->station = $station;
        $this->observations = [];
        $this->station->ajouterDrone($this);
    }

    public function getIdentifiant(): string
    {
        return $this->identifiant;
    }

    public function getProfondeurMaximale(): int
    {
        return $this->profondeurMaximale;
    }

    public function getStation(): Station
    {
        return $this->station;
    }

    public function getObservations(): array
    {
        return $this->observations;
    }

    public function getNombreObservations(): int
    {
        return count($this->observations);
    }

    public function ajouterObservation(Observation $observation): bool
    {
        if ($observation->getDrone() !== $this || in_array($observation, $this->observations, true)) {
            return false;
        }
        $this->observations[] = $observation;
        return true;
    }

    public function getPlusGrandeProfondeurObservee(): ?int
    {
        if ($this->observations === []) {
            return null;
        }

        $maxProfondeur = $this->observations[0]->getProfondeur();
        foreach ($this->observations as $observation) {
            if ($observation->getProfondeur() > $maxProfondeur) {
                $maxProfondeur = $observation->getProfondeur();
            }
        }
        return $maxProfondeur;
    }
}