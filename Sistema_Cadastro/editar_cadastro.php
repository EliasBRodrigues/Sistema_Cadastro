<?php
session_start();
include('config/conn.php');

$id_cliente = mysqli_real_escape_string($connection, $_POST['id']);
$nome = mysqli_real_escape_string($connection, ucwords(strtolower($_POST['nome'])));
$email = mysqli_real_escape_string($connection, strtolower($_POST['email']));
$celular = mysqli_real_escape_string($connection, $_POST['celular']);
$cidade = mysqli_real_escape_string($connection, $_POST['cidade']);
$uf = mysqli_real_escape_string($connection, $_POST['uf']);
$situacao = mysqli_real_escape_string($connection, $_POST['situacao']);
$alterado_por = $_SESSION['userNome'];
$ultima_alteracao = date('Y-m-d H:i:s');
$update_cliente = "UPDATE Clientes SET nome='$nome', email='$email', celular='$celular', cidade='$cidade', uf='$uf', alterado_por='$alterado_por', ultima_alteracao='$ultima_alteracao', situacao='$situacao' WHERE id_cliente='$id_cliente'";
$response = mysqli_query($connection, $altera_cliente);
if($response){
    //$_SESSION['success'] = "<div class='danger' role='alert' id='sumirDiv'><center>Área Restrita - Realize Login</center></div>";
    $_SESSION['success'] = "<div class='alert alert-success alert-dismissible fade show text text-center mb-0' role='alert'>
                                
                                <strong> CLIENTE EDITADO COM SUCESSO &nbsp; <i class='far fa-smile-wink fa-2x'></i> </strong> 
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                
                        </div>";
    header('Location: listar_cadastro.php');
}else{
    $_SESSION['error'] = "<div class='alert alert-danger alert-dismissible fade show text text-center mb-0' role='alert'>
                                
                                <strong> NÃO FOI POSSÍVEL EDITAR O CLIENTE &nbsp; <i class='fas fa-grin-squint-tears fa-2x'></i> </strong> 
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                
                            </div>";
     header('Location: listar_cadastro.php');
}
?>