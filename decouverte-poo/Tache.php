<?php

class Tache
{
    public string $titre;
    public bool $terminee;

    public function __construct(string $titre)
    {
        $this->titre = $titre;
        $this->terminee = false;
    }

    public function terminer(): void
    {
        $this->terminee = true;
    }
    public function remettreAFaire(): void
    {
        $this->terminee = false;
    }
}
