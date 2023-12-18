<?php
session_start();
include('config/conn.php');
include('config/security.php');
securityAdmin();
$consult = "SELECT * FROM Clientes";
$response = mysqli_query($connection, $consult);
?>

<?php
include_once('assets/menu.php');
?>

<table class="table table-bordered table-hover table-responsive-xl resultado_cadastro">
    <thead class="thead-dark">
        <tr>
            <th scope="col">CÓD</th>
            <th scope="col">NOME</th>
            <th scope="col">EMAIL</th>
            <th scope="col">CELULAR</th>
            <th scope="col">CIDADE</th>
            <th scope="col">UF</th>
            <th scope="col" class="text text-center" colspan="4">AÇÕES</th>
        </tr>
    </thead>
    <?php
    while ($linha = mysqli_fetch_assoc($response)) {
        $id_cliente = $linha['id_cliente'];
        $nome = ucwords(strtolower($linha['nome']));
        $email = $linha['email'];
        $celular = $linha['celular'];
        $cidade = $linha['cidade'];
        $uf = $linha['uf'];
        $responsavel = $linha['criado_por'];
        $situacao = $linha['situacao'];
        $alterado_por = $linha['alterado_por'];
    
        // data-hora para BR
        $ultima_alteracao = $linha['ultima_alteracao'];
        $ultima_alteracao = date('d/m/Y H:i:s',  strtotime($ultima_alteracao));
        $data_cadastro = $linha['data_cadastro'];
        $data_cadastro = date('d/m/Y H:i:s',  strtotime($data_cadastro));
    ?>
        <tbody>
            <tr>
                <td><?php echo $id_cliente ?></td>
                <td><?php echo ucwords(strtolower($nome)); ?></td>
                <td><?php echo $email ?></td>
                <td><?php echo $linha['celular']; ?></td>
                <td><?php echo $cidade; ?></td>
                <td><?php echo $uf; ?></td>
                <td><?php echo $responsavel ?></td>
                <td class="text text-center">
                    <a href="#" data-toggle="modal" 
                    data-backdrop="static" 
                    data-keyboard="false" 
                    data-target="#visulaizarCliente" 
                    data-whatever="<?php echo $linha['id_cliente']; ?>" 
                    data-whatevernome="<?php echo ucwords(strtolower($linha['nome'])); ?>" 
                    data-whateveremail="<?php echo $linha['email']; ?>" 
                    data-whatevercidade="<?php echo $linha['cidade']; ?>" 
                    data-whateveruf="<?php echo $linha['uf']; ?>" 
                    data-whatevercelular="<?php echo $linha['celular']; ?>" 
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
                    data-whateveremail="<?php echo $linha['email']; ?>"  
                    data-whatevercidade="<?php echo $linha['cidade']; ?>" 
                    data-whateveruf="<?php echo $linha['uf']; ?>" 
                    data-whatevercelular="<?php echo $linha['celular']; ?>" 
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
<!-- cadastrar cliente modal  -->
<style>
    .errorInput {
        border: 2px solid red !important;
    }
</style>
<script>
    // funcao mascara celular
    function mask(o, f) {
        setTimeout(function() {
            var v = celular(o.value);
            if (v != o.value) {
                o.value = v;
            }
        }, 1);
    }
    function celular(v) {
        var r = v.replace(/\D/g, "");
        r = r.replace(/^0/, ""); 
        if (r.length > 10) {
            r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
        } else if (r.length > 5) {
            r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
        } else if (r.length > 2) {
            r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
        } else {
            r = r.replace(/^(\d*)/, "($1");
        }
        return r;
    }
    $(document).ready(function() {
        $('#insert_form').on('submit', function(event) {
            event.preventDefault(); 
            var nome = $('#nome'); 
            var celular = $('#celular'); 
            var email = $('#email');
            var erro = $('.alert-danger'); 
            var campo = $('#campo-erro');
            erro.addClass('d-none');
            $('.is-invalid').removeClass('is-invalid');
            $('.is-valid').removeClass('is-valid');
            if (!nome.val().match(/[A-Za-z\d]/)) {
                erro.removeClass('d-none'); 
                campo.html('cliente'); 
                nome.focus(); 
                nome.addClass('is-invalid');
                return false;
            } else if (!email.val().match(/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i)) {
                erro.removeClass('d-none'); 
                campo.html('email'); 
                email.focus(); 
                email.addClass('is-invalid');
                return false;
            } else if (!celular.val().match(/^\([0-9]{2}\) [0-9]?[0-9]{5}-[0-9]{4}$/)) {
                erro.removeClass('d-none'); 
                campo.html('celular');
                celular.focus(); 
                celular.addClass('is-invalid');
                return false;
            } else {
                const dados = $("#insert_form").serialize();
                $.post("cadastro.php", dados, function(retorna) {
                    if (retorna) {
                        //limpar campo
                        $('#insert_form')[0].reset();
                        //fechar modal
                        $('#cadCliente').modal('hide');
                        $('#sucessModal').modal('show');
                        setInterval(function() {
                            const redirect = "listar_cadastro.php";
                            $(window.document.location).attr('href', redirect);
                        }, 3000);
                    } else {
                        return false;
                    }
                });
            }
        });
    });
</script>
<div class="modal fade" id="sucessModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
            </div>
            <div class="modal-body bg-success text text-center text-white">
                CLIENTE CADASTRADO COM SUCESSO!
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- nao realizado  -->
<div class="modal fade" id="dangerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
            </div>
            <div class="modal-body bg-danger text text-center text-white">
                CLIENTE NÃO CADASTRADO!
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- modal cadastro  -->
<div class="modal fade" id="cadCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalLabel">CADASTRO DE PESSOA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- erro preenchimento campo  -->
            <div class="alert alert-danger d-none fade show m-3" role="alert">
                <strong>ERRO!</strong> - <strong>Preencha o campo <span id="campo-erro"></span></strong>!
                <span id="msg"></span>
            </div>
            <div class="modal-body">
                <form method="POST" id="insert_form">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <label for="recipient-nome" class="col-form-label">Nome</label>
                            <input type="text" name="nome" id="nome" maxlength="50" class="form-control">
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="recipient-email" class="col-form-label">E-mail</label>
                            <input type="email" name="email" id="email" maxlength="50" class="form-control -10">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <label for="recipient-cidade" class="col-form-label">Cidade</label>
                            <input type="text" name="cidade" id="cidade" maxlength="50" class="form-control">
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <label for="recipient-uf" class="col-form-label">UF</label>
                            <input type="text" name="uf" id="uf" maxlength="50" class="form-control -10">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="recipient-celular" class="col-form-label">Celular</label>
                            <input type="text" name="celular" id="celular" maxlength="50" onkeypress="mask(this, celular);" onblur="mask(this, celular);" class="form-control -10">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-operador" class="col-form-label cli">Operador</label>
                            <input type="text" name="operador" id="operador" maxlength="50" class="form-control" disabled value="<?php echo $_SESSION['userNome'] ?>">
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-dataCadastro" class="col-form-label">Data do cadastro</label>
                            <input type="text" class="form-control" value="<?php echo date('d/m/Y - H:i:s') ?>" disabled>
                        </div>
                        <div class="col-md-4 col-sm-12">
                        <label for="recipient-situacao" class="col-form-label">Situação</label>
                        <select class="form-control form-select-lg mb-5 select2" name="situacao" id="situacao" aria-label=".form-select-lg example">
                            <option value="Pendente">Pendente</option>
                            <option value="Ativo">Ativo</option>
                            <option value="Inativo">Inativo</option>
                            <option value="Cancelado">Cancelado</option>
                        </select>       
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" id="btn-cadastrar">Salvar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- visualizar cliente  -->
<div class="modal fade" id="visulaizarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <label for="recipient-name" class="col-form-label">Nome</label>
                            <input type="text" class="form-control" id="recipient-name" disabled>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="recipient-email" class="col-form-label">E-mail</label>
                            <input type="text" class="form-control" id="recipient-email" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-cidade" class="col-form-label">Cidade</label>
                            <input type="text" name="cidade" id="recipient-cidade" maxlength="50" class="form-control" disabled>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <label for="recipient-uf" class="col-form-label">UF</label>
                            <input type="text" name="uf" id="recipient-uf" maxlength="50" class="form-control -10" disabled>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="recipient-celular" class="col-form-label">Celular</label>
                            <input type="text" name="celular" id="recipient-celular" maxlength="50" onkeypress="mask(this, celular);" onblur="mask(this, celular);" class="form-control -10" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-operador" class="col-form-label cli">Cadastrado por</label>
                            <input type="text" name="operador" id="recipient-operador" maxlength="50" class="form-control" disabled >
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-dataCadastro" class="col-form-label">Data do cadastro</label>
                            <input type="text" class="form-control" id="recipient-dataCadastro" disabled>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-situacao" class="col-form-label">Situação</label>
                            <select class="form-control form-select-lg mb-5 select2" name="situacao" id="recipient-situacao" aria-label=".form-select-lg example" disabled>
                                <option value="Pendente">Pendente</option>
                                <option value="Ativo">Ativo</option>
                                <option value="Inativo">Inativo</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-alterado_por" class="col-form-label cli">Alterado por</label>
                            <input type="text" name="alterado_por" id="recipient-alterado_por" maxlength="50" class="form-control" disabled >
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="recipientultima_alteracao" class="col-form-label">Última Alteração</label>
                            <input type="text" class="form-control" name="ultima_alteracao" id="recipientultima_alteracao" disabled>
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- visualizar cliente  -->
<script type="text/javascript">
    $('#visulaizarCliente').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget) // Botão que acionou o modal
        const recipient = button.data('whatever')
        const recipientnome = button.data('whatevernome')
        const recipientemail = button.data('whateveremail')
        const recipientcidade = button.data('whatevercidade')
        const recipientuf = button.data('whateveruf')
        const recipientcelular = button.data('whatevercelular')
        const recipientoperador = button.data('whateveroperador')
        const recipientsituacao = button.data('whateversituacao')
        const recipientdataCadastro = button.data('whateverdata-cadastro')
        const recipientalterado_por = button.data('whateveralterado_por')
        const recipientultima_alteracao = button.data('whateverultima_alteracao')
        const modal = $(this)
        modal.find('.modal-title').text('VISUALIZAR CLIENTE: ' + recipient)
        modal.find('#id').val(recipient)
        modal.find('#recipient-name').val(recipientnome)
        modal.find('#recipient-email').val(recipientemail)
        modal.find('#recipient-cidade').val(recipientcidade)
        modal.find('#recipient-uf').val(recipientuf)
        modal.find('#recipient-celular').val(recipientcelular)
        modal.find('#recipient-operador').val(recipientoperador)
        modal.find('#recipient-situacao').val(recipientsituacao)
        modal.find('#recipient-dataCadastro').val(recipientdataCadastro)
        modal.find('#recipient-alterado_por').val(recipientalterado_por)
        modal.find('#recipientultima_alteracao').val(recipientultima_alteracao)
    })
</script>
<!-- EDITAR CLIENTE -->
<div class="modal fade" id="editarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="editar_cadastro.php" enctype="multipart/form-data">
                   
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <label for="recipient-name" class="col-form-label">Nome</label>
                            <input type="text" class="form-control" id="recipient-name" name="nome">
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="recipient-email" class="col-form-label">E-mail</label>
                            <input type="email" class="form-control" id="recipient-email" name="email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-cidade" class="col-form-label">Cidade</label>
                            <input type="text" name="cidade" id="recipient-cidade" maxlength="50" class="form-control">
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <label for="recipient-uf" class="col-form-label">UF</label>
                            <input type="text" name="uf" id="recipient-uf" maxlength="50" class="form-control -10">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="recipient-celular" class="col-form-label">Celular</label>
                            <input type="text" name="celular" id="recipient-celular" maxlength="50" 
                            onkeypress="mask(this, celular);" onblur="mask(this, celular);" class="form-control -10">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-operador" class="col-form-label cli">Cadastrado por</label>
                            <input type="text" name="operador" id="recipient-operador" maxlength="50" class="form-control" disabled>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-dataCadastro" class="col-form-label">Data do cadastro</label>
                            <input type="text" class="form-control" id="recipient-dataCadastro" disabled>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-situacao" class="col-form-label">Situação</label>
                            <select class="form-control form-select-lg mb-5 select2" name="situacao" id="recipient-situacao" aria-label=".form-select-lg example">
                                <option value="Pendente">Pendente</option>
                                <option value="Ativo">Ativo</option>
                                <option value="Inativo">Inativo</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-operador" class="col-form-label cli">Alterado por</label>
                            <input type="text" name="alterado_por" id="recipient-alterado_por" maxlength="50" class="form-control" disabled value="<?php echo $_SESSION['userNome'] ?>">
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-dataCadastro" class="col-form-label">Última Alteração</label>
                            <input type="text" class="form-control" name="ultima_alteracao" id="recipientultima_alteracao" value="<?php echo date('d/m/Y - H:i:s') ?>" disabled>
                        </div>
                    </div>
                    <input type="hidden" name="id" class="form-control" id="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal editar cliente  -->
<script type="text/javascript">
    $('#editarCliente').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget)
        const recipient = button.data('whatever')
        const recipientnome = button.data('whatevernome')
        const recipientemail = button.data('whateveremail')
        const recipientcidade = button.data('whatevercidade')
        const recipientuf = button.data('whateveruf')
        const recipientcelular = button.data('whatevercelular')
        const recipientoperador = button.data('whateveroperador')
        const recipientsituacao = button.data('whateversituacao')
        const recipientdataCadastro = button.data('whateverdata-cadastro')
        const recipientalterado_por = button.data('whateveralterado_por')
        const recipientultima_alteracao = button.data('whateverultima_alteracao')

        const modal = $(this)
        modal.find('.modal-title').text('EDITAR CLIENTE CÓDIGO: ' + recipient)
        modal.find('#id').val(recipient)
        modal.find('#recipient-name').val(recipientnome)
        modal.find('#recipient-email').val(recipientemail)
        modal.find('#recipient-cidade').val(recipientcidade)
        modal.find('#recipient-uf').val(recipientuf)
        modal.find('#recipient-celular').val(recipientcelular)
        modal.find('#recipient-operador').val(recipientoperador)
        modal.find('#recipient-situacao').val(recipientsituacao)
        modal.find('#recipient-dataCadastro').val(recipientdataCadastro)
        modal.find('#recipient-alterado_por').val(recipientalterado_por)
        modal.find('#recipientultima_alteracao').val(recipientultima_alteracao)

    })
</script>
<!-- <script>
    $(document).ready(function() {
        $(function() {
            $("#pesquisa_cadastro").keyup(function() {
                const pesquisa_cadastro = $(this).val();
                if (pesquisa_cadastro != '') {
                    const dados = {
                        palavra: pesquisa_cadastro
                    }
                    $.post('busca_cadastro.php', dados, function(retorna) {
                        //Mostra dentro da ul os resultado obtidos
                        $(".resultado_cadastro").html(retorna);
                    });
                } else {
                    $(".resultado_cadastro").html('');
                }
            });
        });

    });
</script> -->