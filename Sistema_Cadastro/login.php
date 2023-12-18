<?php
session_start();
include('config/conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <title>Cadastro de Pessoal</title>
</head>
<style>
    .btn-color{
        background-color: #0e1c36;
        color: #fff;
    }
    .profile-image-pic{
        height: 200px;
        width: 200px;
        object-fit: cover;
    }
    .cardbody-color{
        background-color: #ebf2fa;
    }

    a{
        text-decoration: none;
    }
</style>
<body>
<body>
    <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center text-dark mt-5">Sistema de Cadastro</h2>
        <div class="card my-5">
          <form class="card-body cardbody-color p-lg-5" method="POST" action="validate.php">
            <div class="text-center">
              <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                width="200px" alt="profile">
            </div>
            <div class="mb-3">
              <input type="text" class="form-control" id="Username" name="usuario" aria-describedby="emailHelp" placeholder="Usuário: admin/junior">
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" id="password" name="senha" placeholder="Senha: 123">
            </div>
            <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Login</button></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>
<script>
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.validation')
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
            form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
      })
  })()
</script>
</body>
</html>