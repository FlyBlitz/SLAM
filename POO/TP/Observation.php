<?php

class Observation
{
    private string $description;
    private int $profondeur;
    private int $interetScientifique;
    private Drone $drone;

    public function __construct(string $description, int $profondeur, int $interetScientifique, Drone $drone)
    {
        $this->description = $description;
        $this->profondeur = $profondeur;
        $this->interetScientifique = $interetScientifique;
        $this->drone = $drone;
        $this->drone->ajouterObservation($this);
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getProfondeur(): int
    {
        return $this->profondeur;
    }

    public function getInteretScientifique(): int
    {
        return $this->interetScientifique;
    }

    public function getDrone(): Drone
    {
        return $this->drone;
    }
}