<?php

declare(strict_types=1);

class Drone
{
    private string $identifiant;
    private int $profondeurMaximale;

    /** @var Observation[] */
    private array $observations;

    public function __construct(
        string $identifiant,
        int $profondeurMaximale
    ) {
        $this->identifiant = $identifiant;
        $this->profondeurMaximale = $profondeurMaximale;
        $this->observations = [];

    }

    public function getIdentifiant(): string
    {
        return $this->identifiant;
    }

    public function getProfondeurMaximale(): int
    {
        return $this->profondeurMaximale;
    }

    /** @return Observation[] */
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
        if (in_array($observation, $this->observations, true)) {
            return false;
        }

        $this->observations[] = $observation;
        return true;
    }

    public function getPlusGrandeProfondeurObservee(): ?int
    {
        if (count($this->observations) === 0) {
            return null;
        }

        // On part d'une profondeur réellement présente dans la collection.
        $maximum = $this->observations[0]->getProfondeur();

        foreach ($this->observations as $observation) {
            if ($observation->getProfondeur() > $maximum) {
                $maximum = $observation->getProfondeur();
            }
        }

        return $maximum;
    }
}