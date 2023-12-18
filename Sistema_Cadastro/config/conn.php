<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $database_name = "cadastros";
    $connection = mysqli_connect($server, $user, $password, $database_name);
    if(!$connection){
        echo "Error";
    } else {
        //  echo "connected";
    }
?>