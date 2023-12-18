<?php
session_start();
include('config/conn.php');
include_once("config/security.php");
securityAdmin();

$nome = mysqli_real_escape_string($connection, ucwords(strtolower($_POST['nome'])));
$email = mysqli_real_escape_string($connection, strtolower($_POST['email']));
$celular = mysqli_real_escape_string($connection, $_POST['celular']);
$cidade = mysqli_real_escape_string($connection, $_POST['cidade']);
$uf = mysqli_real_escape_string($connection, $_POST['uf']);
$criado_por = $_SESSION['userNome'];
$situacao = mysqli_real_escape_string($connection, $_POST['situacao']);
$data_cadastro = date('Y-m-d H:i:s');
$insert_cliente = "INSERT INTO Clientes (nome, email, celular, cep, cidade, uf, data_cadastro, criado_por, situacao) 
VALUES ('$nome', '$email', '$celular', '$cep', '$cidade', '$uf', '$data_cadastro', '$criado_por', '$situacao')";
$response = mysqli_query($connection, $insert_cliente);

if($response){
    $_SESSION['success'] = "<div class='danger' role='alert' id='sumirDiv'><center>Área Restrita - Realize Login</center></div>";
    $_SESSION['success'] = "<div class='alert alert-success alert-dismissible fade show text text-center mb-0' role='alert'>
                                <strong> CLIENTE CADASTRADO COM SUCESSO &nbsp; <i class='far fa-smile-wink fa-2x'></i> </strong> 
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                        </div>";
    header('Location: listar_cadastro.php');
}else{
    $_SESSION['error'] = "<div class='alert alert-danger alert-dismissible fade show text text-center mb-0' role='alert'>
                                <strong> NÃO FOI POSSÍVEL CADASTRAR O CLIENTE &nbsp; <i class='fas fa-grin-squint-tears fa-2x'></i> </strong> 
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                
                            </div>";
     header('Location: listar_cadastro.php');
}
?>