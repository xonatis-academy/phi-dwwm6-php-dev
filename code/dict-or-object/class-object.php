<?php
// ================================================

// 1. On déclare une "structure" comme un moule, template, avec les "clés"
// 1. On déclare une classe comme un moule, template, avec les propriétés
class Employe
{
    public $nom;
    public $prenom;
    public $age;
    public $salaire;
    public $premium;
}

// 2. On crée un "dictionnaire" à partir de cette "structure"
// 2. On instantie un objet à partir de cette classe
$tata = new Employe();

// 3. On remplit les valeurs du "dictionnaire"
// 3. On "hydrate" l'objet
$tata->nom = 'Aimarre';
$tata->prenom = 'Jean';
$tata->age = 23;
$tata->salaire = 58394.3;
$tata->premium = true;
