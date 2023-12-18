<?php
session_start();
include('config/conn.php'); 

if ((isset($_POST['usuario'])) && (isset($_POST['senha']))) {
    $usuario = mysqli_real_escape_string($connection, $_POST['usuario']); 
    $senha = mysqli_real_escape_string($connection, $_POST['senha']);
    $senha = md5($senha);
   
    $result_usuario = "SELECT * FROM Usuarios WHERE permissao = '$usuario' && senha = '$senha'";
    $resultado_usuario = mysqli_query($connection, $result_usuario);
    $resultado = mysqli_fetch_assoc($resultado_usuario);
    $token = md5($usuario . $senha);
    $result_token = $resultado['token'];

    if (trim($result_token) === trim($token)) {
        $_SESSION['userToken'] = $resultado['token'];
        $_SESSION['userNome'] = $resultado['nome'];
        $_SESSION['userLogin'] = $resultado['usuario'];
        $_SESSION['userSenha'] = $resultado['senha'];
        header("Location: listar_cadastro.php");
    } else if ($resultado) {
        $_SESSION['userToken'] = $token;
        $_SESSION['userNome'] = $resultado['nome'];
        $_SESSION['userLogin'] = $resultado['usuario'];
        $_SESSION['userSenha'] = $resultado['senha'];

        $usuario = $resultado['usuario'];
        $senha = $resultado['senha'];

        $inserir_token = ("UPDATE Usuarios SET token='$token' WHERE permissao = '$usuario' && senha = '$senha'");
        $resultado_token = mysqli_query($connection, $inserir_token);

        header("Location: listar_cadastro.php");
    } else {
        $_SESSION['errorLogin'] = "Usuário ou senha Inválido";
        header("Location: login.php");
    }
} else {
    $_SESSION['errorLogin'] = "Usuário ou senha inválido";
    header("Location: login.php");
}