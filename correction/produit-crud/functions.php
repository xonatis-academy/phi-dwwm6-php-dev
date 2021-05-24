<?php

/**
 * @param array un tableau associatif avec "name" (nom du fichier) et "tmp_name" nom du fichier téléchargé par POST
 * @return string 'uploads' avec le nom du fichier
 */
function enregistrerFichierEnvoye(array $infoFichier): string
{
    // On récupère l'heure courante à la seconde près et la convertit en chaine de charactères
    $timestamp = strval(time());

    // pathinfo(basename($infoFichier["name"]), PATHINFO_EXTENSION)
    // pathinfo( ....    ,   .... ) // ... : basename($infoFichier["name"]), ... : PATHINFO_EXTENSION
    // basename( ...  ) // ... : $infoFichier["name"]

    // On récupère l'extension du fichier de chemin $infoFichier["name"]
    $extension = pathinfo(basename($infoFichier["name"]), PATHINFO_EXTENSION);

    // On crée un string commencant par 'produit_' suivi de l'heure courante à la seconde en chaine, suivi de l'extension
    $nomDuFichier = 'produit_' . $timestamp . '.' . $extension;

    // On crée un string commancant par le dossier dans lequel se trouve "functions.php", suivi de '/uploads/'
    $dossierStockage = __DIR__ . '/uploads/';

    // On vérifie si le dossier uplaods n'existe pas
    if (file_exists($dossierStockage) === false)
    {
        // mkdir = Créer un dossier
        mkdir($dossierStockage);
    }

    // On vérifie que $infoFichier["tmp_name"] correspond a un fichier téléchargé par POST.
    // On déplace ce fichier vers $dossierStockage . $nomDuFichier
    move_uploaded_file($infoFichier["tmp_name"], $dossierStockage . $nomDuFichier);

    // On retourne 'uploads' avec le $nomDuFichier
    return '/uploads/' . $nomDuFichier;
}

/**
 * @param string quelque chose à mettre après router.php
 * @return void rien du tout
 * Fait une redirection
 */
function onVaRediriger(string $path)
{
    // Envoi une en-tete avec Location (une redirection)
    header('LOCATION: /produit-crud/router.php' . $path);

    // Termine le script courant
    die();
}
