<?php

// Connexion à la base de données
$serveur = '10.5.40.46:3306';
$utilisateur = 'polo';
$motdepasse = 'polo';
$basededonnees = 'localisationdrone';

$connexion = new PDO("mysql:host=$serveur;dbname=$basededonnees", $utilisateur, $motdepasse);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Connexion échouée : " . $connexion->connect_error);
}


        session_start();
        $login = $_POST['login'];
        $pwd = $_POST['password'];

// Requête SQL pour vérifier l'existence de l'utilisateur
$sql = "SELECT * FROM authentification WHERE nom = :login AND mot_de_passe = :pwd";
$req = $connexion->prepare($sql);
$req->bindParam('login', $login);
$req->bindParam('pwd', $pwd);
$req->execute();
$resultat = $req->fetchAll();


if (!empty($resultat)) {
    // L'utilisateur est authentifié
    echo "Authentification réussie ! Bienvenue, $login.";
    $_SESSION['login']=$login;
                ?>
                <br><br><a href="index.php">Accéder à GOD!!</a>
                <?php
        }else{
            http_response_code(401);
        ?>
        <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur 401 - Non autorisé</title>
</head>
<body>
    <h1>Erreur 401 - Non autorisé</h1>
    <p>Désolé, vous n'êtes pas autorisé à accéder à cette page.</p>
</body>
</html>
        <?php
        
        
        
        }
        
        