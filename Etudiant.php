<?php
class Etudiant {
    public $nom;
    public $prenom;
    public $age;

    public function __construct($nom, $prenom, $age) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
    }
}
