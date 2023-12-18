<?php
    function securityAdmin(){
        if(empty($_SESSION['userToken'])){
            $_SESSION['errorLogin'] = "Necessário realizar Novo Login";
            header("Location: login.php");
        }
    }
?>