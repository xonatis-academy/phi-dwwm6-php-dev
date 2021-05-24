<?php
include DOSSIER_MODELS.'/Produit.php';

function verifierPayload(array $data, array $file)
{
    if (!isset($data['product-name']) || $data['product-name'] === '')
    {
        return "Vous devez spécifier un nom de produit";
    }

    if (!isset($data['product-price']) || $data['product-price'] === '')
    {
        return "Vous devez spécifier un prix de produit";
    }

    if (!is_numeric($data['product-price']))
    {
        return "Le prix doit être numérique";
    }

    if (!isset($data['product-type']) || $data['product-type'] === '')
    {
        return "Vous devez spécifier un prix de produit";
    }

    if (isset($file['product-photo-file']) && $file['product-photo-file']['name'] !== '')
    {
        if (!in_array($file['product-photo-file']['type'], ['image/webp', 'image/png', 'image/jpg', 'image/jpeg']))
        {
            return "Le type de fichier " . $file['product-photo-file']['type'] . " n'est pris en charge";
        }

        if ($file['product-photo-file']['size'] > 10000000)
        {
            return "Le fichier est trop gros: il fait " . $file['product-photo-file']['size']. ' octets';
        }
    }

    return null;
}

function convertirPayloadEnObjet(array $data, array $file)
{
    $fichier = enregistrerFichierEnvoye($file["product-photo-file"]);
    $produit = new Produit();
    $produit->nom = $data['product-name'];
    $produit->prix = $data['product-price'];
    $produit->image = $fichier;
    $produit->type = $data['product-type'];
    $produit->description = $data['product-description'];

    return $produit;
}

function convertirPayloadEnObjetPourModification(array $data, array $file, Produit $produit)
{
    $fichier = enregistrerFichierEnvoye($file["product-photo-file"]);
    $produit->nom = $data['product-name'];
    $produit->prix = $data['product-price'];
    $produit->image = $fichier;
    $produit->type = $data['product-type'];
    $produit->description = $data['product-description'];

    return $produit;
}

// ACTIONS ------------------------------------------------

function create()
{
    $produit = new Produit();
    $messageErreur = null;
    if (isset($_POST['btn-valider']))
    {
        $messageErreur = verifierPayload($_POST, $_FILES);
        if ($messageErreur === null)
        {
            $produit = convertirPayloadEnObjet($_POST, $_FILES);
            $produit->save();
            onVaRediriger('/catalogue');
        }
    }

    include DOSSIER_VIEWS.'/produit/ajouter.html.php';
}

function index()
{
    $tableau = Produit::all();
    include DOSSIER_VIEWS.'/produit/catalog.html.php';
}

function show()
{
    if (!isset($_GET['id']))
    {
        die();
    }

    $produit = Produit::retrieveByPK($_GET['id']);
    include DOSSIER_VIEWS.'/produit/details.html.php';
}

function delete()
{
    if (!isset($_GET['id']))
    {
        die();
    }

    $produit = Produit::retrieveByPK($_GET['id']);
    $produit->delete();
    onVaRediriger('/catalogue');
}

function update()
{
    if (!isset($_GET['id']))
    {
        die();
    }

    $produit = Produit::retrieveByPK($_GET['id']);

    $messageErreur = null;
    if (isset($_POST['btn-valider']))
    {
        $messageErreur = verifierPayload($_POST, $_FILES);
        if ($messageErreur === null)
        {
            $produit = convertirPayloadEnObjetPourModification($_POST, $_FILES, $produit);
            $produit->save();
            onVaRediriger('/catalogue');
        }
    }

    include DOSSIER_VIEWS.'/produit/modifier.html.php';
}