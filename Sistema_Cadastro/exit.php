<?php
include('config/conn.php');
session_start();
$token = $_SESSION['userToken'];
$insert_token = ("UPDATE Usuarios SET token='1' WHERE token='$token'");
$response_token = mysqli_query($connection, $insert_token);

unset(
    $_SESSION['userToken'],
    $_SESSION['userLogin'],
    $_SESSION['userId'],
    $_SESSION['userPermissao'],
    $_SESSION['userNome'],
    $_SESSION['userEmail'],
    $_SESSION['userSenha']
);
$_SESSION['loginExit'] = "Você saiu de sua conta";
header("Location: login.php");
?>