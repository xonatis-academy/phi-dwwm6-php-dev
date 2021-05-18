<?php
$tab = [
    [
        'nom' => 'Aimarre',
        'prenom' => 'Jean',
        'age' => 23,
        'salaire' => 58394.3,
        'premium' => true
    ],
    [
        'nom' => 'Pasdetoit',
        'prenom' => 'Johnathan',
        'age' => 23,
        'salaire' => 45934.9,
        'premium' => false
    ],
    [
        'nom' => 'Atoutprix',
        'prenom' => 'Marie',
        'age' => 16,
        'salaire' => 54934.9,
        'premium' => true
    ]
];

var_dump($tab);

// ================================================

class Employe
{
    public $nom;
    public $prenom;
    public $age;
    public $salaire;
    public $premium;
}

$tab = [];

$tata = new Employe();
$tata->nom = 'Aimarre';
$tata->prenom = 'Jean';
$tata->age = 23;
$tata->salaire = 58394.3;
$tata->premium = true;
array_push($tab, $tata);

$tata = new Employe();
$tata->nom = 'Pasdetoit';
$tata->prenom = 'Johnathan';
array_push($tab, $tata);

$tata = new Employe();
$tata->nom = 'Atoutprix';
$tata->prenom = 'Marie';
$tata->age = 16;
$tata->salaire = 54934.9;
$tata->premium = true;
array_push($tab, $tata);

var_dump($tab);