<!DOCTYPE html>
<html>
    <head>
        <title>Ajouter un employe</title>
    </head>
    <body>
        <form action="http://localhost:8080/creer-un-employe.php" method="POST">
            <input name="nom" type="text" placeholder="nom" /><br />
            <input name="prenom" type="text" placeholder="prenom" /><br />
            <input name="age" type="number" placeholder="age" /><br />
            <input name="salaire-base" type="number" placeholder="salaire" /><br />
            <input name="premium-check" type="checkbox" /><br />
            <button type="submit">Enregistrer le nouvel employe</button>
        </form>
    </body>
</html>