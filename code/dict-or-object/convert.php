<?php

/*
Ecrire une fonction qui convertit un tableau de tableaux associatifs en tableau d'objets avec une boucle
Assurez-vous d'avoir les étapes pour la création d'objet
1. Déclaration de la classe
2. Instanciation
3. Hydratation
*/

/*
En entrée : un tableau de tableaux d'associatifs
En sortie : un tableau d'objet
*/

// 1. Nom de la fonction : convertir
// 2. Type et nom des paramètres en entrée : array $employes
// 3. Type de sortie : array

class Employe
{
    public $nom;
    public $prenom;
    public $age;
    public $salaire;
    public $premium;
}

function convertir(array $employes): array
{
    $nvxTableau = [];
    foreach ($employes as $element)
    {
        $nvxObjet = new Employe();
        $nvxObjet->nom = $element['nom'];
        $nvxObjet->prenom = $element['prenom'];
        $nvxObjet->age = $element['age'];
        $nvxObjet->salaire = $element['salaire'];
        $nvxObjet->premium = $element['premium'];

        array_push($nvxTableau, $nvxObjet);
    }
    return $nvxTableau;
}

