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
        }