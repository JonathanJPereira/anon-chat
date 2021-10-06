<?php

if (!isset($_GET['hash'])) {
    $hash = gerarHash();
} else {
    $hash = $_GET['hash'];
}

function gerarHash()
{
    $numero_aleatorio = rand();

    $hash = hash('sha256', $numero_aleatorio);
    return $hash;
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
                        Registrar
                    </div>
                    <div class="card-body">

                        <form action="processadores-php/efetua_register.php" method="POST">
                            <div class="form-group">
                                <input name="hash" type="text" class="form-control" placeholder="Hash" readonly value="<?= $hash ?>">
                            </div>
                            <div class="form-group">
                                <input name="senha" type="password" minlength="6" maxlength="6" onkeypress="return onlynumber();" class="form-control" placeholder="Senha">
                            </div>

                            <div class="text-info">
                                Sua senha deve conter 6 números
                            </div>

                            <br>
                            <button class="btn btn-lg btn-info btn-block" type="submit">Registrar</button>

                            <!-- <button class="btn btn-lg btn-danger btn-block" type="submit">Registrar</button> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
<script>
    // Funcao para permitir apenas numero no campo senha

    function onlynumber(evt) {
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
        //var regex = /^[0-9.,]+$/;
        var regex = /^[0-9.]+$/;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault) theEvent.preventDefault();
        }
    }
</script>

</html>