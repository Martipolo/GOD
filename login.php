<?php
        session_start();
        $login = $_POST['login'];
        $pwd = $_POST['password'];

        if($login=="Peter" && $pwd=="Parker"){
                $_SESSION['login']=$login;
                echo "Bienvenue " . $login;
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
        
        