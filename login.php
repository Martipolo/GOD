<?php
        session_start();
        $login = $_POST['login'];
        $pwd = $_POST['password'];

        if($login=="Peter" && $pwd=="Parker"){
                $_SESSION['login']=$login;
                echo "Bienvenue " . $login;
        }else{
                echo "Echec";
        }