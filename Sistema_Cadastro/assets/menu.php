<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> 
  <title>Sistema de Cadastro de Pessoas</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark">
    <span class="d-inline-block text-warning p-2" style="max-width: 200px;">CADASTRO DE PESSOAS</span>
    <button class="navbar-toggler text text-warning" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse ml-3" id="conteudoNavbarSuportado">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown mr-2">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    CADASTRO
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="listar_cadastro.php">Usuários</a>
                    <div class="dropdown-divider"></div>
                </div>
            </li>
            <li class="nav-item mr-2">
                <a class="nav-link text text-white" href="exit.php" data-bs-toggle="tooltip" data-bs-placement="botton" title="SAIR DO SISTEMA">
                        SAIR&nbsp;
                    <i class="fas fa-sign-out-alt text text-danger"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 bg-white justify-content-between p-3">
            LISTA DE PESSOAS CADASTRADAS
        </div>
        <div class="col-md-6 bg-white justify-content-between p-3">
            <div class="form-label-group">
                <input type="text" name="pesquisa_cadastro" id="pesquisa_cadastro" class="form-control" 
                placeholder="PESQUISAR CLIENTES POR NOME" required autofocus>
            </div>
        </div>
        <div class="col-md-2 bg-white justify-content-between p-3 d-flex">
            <button type="button" class="btn btn-sm btn-dark " data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#cadCliente">NOVO CLIENTE</button>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>  
</body>
</html>