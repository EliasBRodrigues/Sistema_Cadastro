<?php
session_start();
include('config/conn.php');
$consult = "SELECT * FROM Clientes ";
$response = mysqli_query($connection, $consult);
?>

<?php
if (isset($_SESSION['error'])) {
    echo $_SESSION['error'];
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo $_SESSION['success'];
    unset($_SESSION['success']);
}   

$busca = $_POST['palavra'];
$busca = "SELECT * FROM Clientes WHERE nome LIKE '%$busca%'";
$resultado = mysqli_query($connection, $busca);
?>
<table class="table table-bordered table-hover table-sm table-responsive-xl resultado_cadastro">
    <thead>
        <tr class="bg-dark text text-white">
            <th scope="col">CÓD</th>
            <th scope="col">NOME</th>
            <th scope="col">RESPONSÁVEL</th>
            <th scope="col" class="text text-center" colspan="3">AÇÕES</th>
        </tr>
    </thead>
    <?php
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $id_cliente = $linha['id_cliente'];
        $nome = ucwords(strtolower($linha['nome']));
        $responsavel = $linha['criado_por'];
        $situacao = $linha['situacao'];
        $alterado_por = $linha['alterado_por'];
        $ultima_alteracao = $linha['ultima_alteracao'];
        $ultima_alteracao = date('d/m/Y H:i:s',  strtotime($ultima_alteracao));
        $data_cadastro = $linha['data_cadastro'];
        $data_cadastro = date('d/m/Y H:i:s',  strtotime($data_cadastro));
    ?>
        <tbody>
            <tr>
                <td><?php echo $id_cliente ?></td>
                <td><?php echo ucwords(strtolower($nome)); ?></td>
                <td><?php echo $responsavel ?></td>
                <td class="text text-center">
                    <a href="#" data-toggle="modal" 
                    data-backdrop="static" 
                    data-keyboard="false" 
                    data-target="#visulaizarCliente" 
                    data-whatever="<?php echo $linha['id_cliente']; ?>" 
                    data-whatevernome="<?php echo ucwords(strtolower($linha['nome'])); ?>" 
                    data-whateveroperador="<?php echo $linha['criado_por']; ?>" 
                    data-whateversituacao="<?php echo $situacao; ?>" 
                    data-whateverdata-cadastro="<?php echo $data_cadastro; ?>"
                    data-whateveralterado_por="<?php echo $alterado_por; ?>"
                    data-whateverultima_alteracao="<?php echo $ultima_alteracao; ?>">
                        <i class="far fa-eye text text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Visualizar"></i>
                    </a>
                </td>
                <td class="text text-center">
                    <a href="#" data-toggle="modal" 
                    data-backdrop="static" 
                    data-keyboard="false" 
                    data-target="#editarCliente" 
                    data-whatever="<?php echo $linha['id_cliente']; ?>" 
                    data-whatevernome="<?php echo ucwords(strtolower($linha['nome'])); ?>" 
                    data-whateveroperador="<?php echo $linha['criado_por']; ?>" 
                    data-whateversituacao="<?php echo $linha['situacao']; ?>" 
                    data-whateverdata-cadastro="<?php echo $data_cadastro ?>"
                    data-whateveralterado_por="<?php echo $alterado_por; ?>"
                    data-whateverultima_alteracao="<?php echo $ultima_alteracao; ?>">
                        <i class="far fa-edit text text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"></i></a>
                </td>
                <td class="text text-center">
                    <a href="excluir_cadastro.php?id_cliente=<?php echo $linha['id_cliente']; ?>" onClick="return confirm('Deseja realmente deletar o cliente? <?php echo $linhaid_cliente['cliente']; ?>')">
                        <i class="far fa-trash-alt text text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir"></i></a>
                </td>
            </tr>
        </tbody>
    <?php } ?>
</table>


