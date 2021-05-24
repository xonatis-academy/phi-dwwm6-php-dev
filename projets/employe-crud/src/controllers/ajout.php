<?php

/*
Ecrire un programme PHP, qui réceptionne ces données et construit un objet à partir de ces données
*/

/*
Ecrire une fonction qui convertir un tableau associatif en objet de type Employe
*/
// 1. Nom de la fonction : convertirPayloadEnEmploye
// 2. Le type et nom des paramètres en entrée : array $data
// 3. Le type de sortie : Employe

require __DIR__ . '/../models/Employe.php';

function convertirPayloadEnEmploye(array $data): Employe
{
    $objet = new Employe();
    $objet->nom = $data['nom'];
    $objet->prenom = $data['prenom'];
    $objet->age = intval($data['age']);
    $objet->salaire = floatval($data['salaire-base']);
    $objet->premium = isset($data['premium-check']) == true && $data['premium-check'] == 'on';
    
    return $objet;
}

// 1. Le nom de la fonction : verifierPayload
// 2. Le type et le nom des parametres en entrée : array $payload
// 3. Le type de sortie : ?string

function verifierPayload(array $payload): ?string
{
    // @Si "$payload['nom'] existe" est Faux @Ou $payload['nom'] est une chaine vide
    if (isset($payload['nom']) == false || $payload['nom'] == '')
    {
        return "Yosh, il faut un nom pour l'employe !";
    }

    if (isset($payload['prenom']) == false || $payload['prenom'] == '')
    {
        return "Rooohhhh, il faut un prenom pour l'employe !";
    }

    if (isset($payload['age']) == false || is_numeric($payload['age']) == false)
    {
        return "Rooohhhh, il faut un age pour l'employe et il doit etre numerique !";
    }

    if (isset($payload['salaire-base']) == false || is_numeric($payload['salaire-base']) == false)
    {
        return "Wouha, stop stop stop là, il faut un salaire pour l'employe et il doit etre numerique !";
    }

    return null;
}

function creerEmploye()
{
    $messageErreur = verifierPayload($_POST);
    if ($messageErreur == null)
    {
        $objet = convertirPayloadEnEmploye($_POST);
        stockerEmploye($objet);
        echo "L'employe a été stocké, trop cool, t'es fort(e).";
    }
    else
    {
        var_dump($messageErreur);
    }
}

function afficherFormulaire()
{
    session_start();
    include __DIR__ . '/../../views/ajout.html.php';

    /**
     * __DIR__ = employe-crud/src/controllers
     * __DIR__ . '/..' = employe-crud/src/controllers/.. = employe-crud/src
     * __DIR__ . '/../..' = employe-crud/src/controllers/../.. = employe-crud
     * __DIR__ , '/../../views' = employe-crud/src/controllers/../../views = employe-crud/views
     * __DIR__ . '/../../views/ajout.html.php' = employe-crud/src/controllers/../../views/ajout.html.php = employe-crud/views/ajout.html.php
     */
}

// 1. Nomd e la fonction : stockerEmploye
// 2. Type et nom en entrée : Employe $employe
// 3. Type en sortie : bool

function stockerEmploye(Employe $employe): bool
{
    $chaine = json_encode($employe);
    setcookie('cle-employe', $chaine);
    return true;
}