<?php

function enregistrerFichierEnvoye(array $infoFichier): string
{
    $timestamp = strval(time());
    $extension = pathinfo(basename($infoFichier["name"]), PATHINFO_EXTENSION);
    $nomDuFichier = 'produit_' . $timestamp . '.' . $extension;
    $dossierStockage = __DIR__ . '/uploads/';

    if (file_exists($dossierStockage) === false)
    {
        mkdir($dossierStockage);
    }

    move_uploaded_file($infoFichier["tmp_name"], $dossierStockage . $nomDuFichier);
    return '/uploads/' . $nomDuFichier;
}

function onVaRediriger(string $path)
{
    header('LOCATION: /router.php' . $path);
    die();
}