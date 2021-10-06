<?php

require_once('config-exterior.php');
require_once('bloqueio_de_tela.php');


$usuario = $_SESSION['usuario']->getDeshash();

try {
    $mensagens = Mensagem::search($usuario);
} catch (\Throwable $th) {
    $mensagens = array();
}

?>


<html>

<head>
    <meta charset="utf-8" />
    <title>AnonChat</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        .card-consultar-chamado {
            padding: 30px 0 0 0;
            width: 100%;
            margin: 0 auto;
        }
    </style>
</head>

<body>

    <?php require_once('navbar.php'); ?>

    <div class="container">
        <div class="row">

            <div class="card-consultar-chamado">
                <div class="card">
                    <div class="card-header">
                        Consulta de mensagem
                    </div>

                    <div class="card-body">

                        <?php foreach ($mensagens as $mensagen) { ?>

                            <div class="card mb-3 bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        Remetente: <?= $mensagen['desusuario_remetente'] ?>
                                    </h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Mensagem:</h6>
                                    <p class="card-text">
                                        <?= $mensagen['desmensagem'] ?>
                                    </p>

                                </div>
                            </div>

                        <?php } ?>

                        <form action="processadores-php/processa_consultar_mensagem.php" method="POST">
                        <div class="row mt-5">
                            <div class="col-6">
                                <button name='action' value="voltar" class="btn btn-lg btn-warning btn-block" type="submit">Voltar</button>
                            </div>

                            <div class="col-6">
                                <button name="action" value="apagar" class="btn btn-lg btn-danger btn-block" type="submit">Apagar todas</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>