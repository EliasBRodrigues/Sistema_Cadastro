<?php
session_start();
include('config/conn.php');
include_once("config/security.php");
securityAdmin();
$id_cliente = mysqli_real_escape_string($connection, $_GET['id_cliente']);
$altera_cliente = "DELETE FROM Clientes WHERE id_cliente = '$id_cliente'";
$response = mysqli_query($connection, $altera_cliente);

if($response){
    $_SESSION['success'] = "<div class='danger' role='alert' id='sumirDiv'><center>Área Restrita - Realize Login</center></div>";
    $_SESSION['success'] = "<div class='alert alert-success alert-dismissible fade show text text-center mb-0' role='alert'>
                                <strong> CLIENTE EXCLUÍDO COM SUCESSO &nbsp; <i class='far fa-smile-wink fa-2x'></i> </strong> 
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>                              
                        </div>";
    header('Location: listar_cadastro.php');
} else {
    $_SESSION['error'] = "<div class='alert alert-danger alert-dismissible fade show text text-center mb-0' role='alert'>
                                <strong> NÃO FOI POSSÍVEL EXCLUIR O CLIENTE &nbsp; <i class='fas fa-grin-squint-tears fa-2x'></i> </strong> 
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>";
     header('Location: listar_cadastro.php');
}
?>