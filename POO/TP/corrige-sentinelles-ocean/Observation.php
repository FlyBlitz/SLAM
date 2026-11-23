<?php

declare(strict_types=1);

class Observation
{
    private string $description;
    private int $profondeur;
    private int $interetScientifique;

    public function __construct(
        string $description,
        int $profondeur,
        int $interetScientifique
    ) {
        $this->description = $description;
        $this->profondeur = $profondeur;
        $this->interetScientifique = $interetScientifique;

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

}