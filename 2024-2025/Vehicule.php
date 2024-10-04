<?php

class Vehicule {
    private string $marque;
    private string $modèle;
    protected int $nombre_roues;

    public function __construct()
    {
        $this->marque = 'Ducati';
    }

    public function getMarque(): string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): void
    {
        $this->marque = $marque;
    }

    public function getModèle(): string
    {
        return $this->modèle;
    }

    public function setModèle(string $modèle): void
    {
        $this->modèle = $modèle;
    }

    public function getNombreRoues(): int
    {
        return $this->nombre_roues;
    }

    public function setNombreRoues(int $nombre_roues): void
    {
        $this->nombre_roues = $nombre_roues;
    }
}