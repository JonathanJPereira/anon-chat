<?php

$hash = '';

if (isset($_GET['hash'])) { 
    $hash = $_GET['hash'];
} 

?>

<html>
<head>
    <meta charset="utf-8" />
    <title>AnonChat</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        .card-login {
            padding: 30px 0 0 0;
            width: 350px;
            margin: 0 auto;
        }
    </style>
</head>

<body>

    <?php require_once('navbar.php'); ?>

    <div class="container">
        <div class="row">

            <div class="card-login">
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">

                        <?php if (isset($_GET['login']) and $_GET['login'] === 'erro') { ?>
                            <div class="text-danger">
                                Hash e/ou senha inválido(s)
                            </div>
                        <?php } ?>

                        <?php if (isset($_GET['login']) and $_GET['login'] === 'negado') { ?>
                            <div class="text-danger">
                                Faça o login para prosseguir
                            </div>
                        <?php } ?>

                        <?php if (isset($_GET['login']) and $_GET['login'] === 'deslogado') { ?>
                            <div class="text-danger">
                                Deslogado com sucesso!
                            </div>
                        <?php } ?>

                        <form action="processadores-php/valida_login.php" method="POST">
                            <div class="form-group">
                                <input name="hash" type="text" class="form-control" placeholder="Hash" value="<?= $hash ?>">
                            </div>
                            <div class="form-group">
                                <input name="senha" type="password" class="form-control" placeholder="Senha">
                            </div>
                            <button name="action" value="entrar" class="btn btn-lg btn-info btn-block" type="submit">Entrar</button>
                            <button name="action" value="registrar" class="btn btn-lg btn-danger btn-block" type="submit">Registrar</button>

                            <!-- <button class="btn btn-lg btn-danger btn-block" type="submit">Registrar</button> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>