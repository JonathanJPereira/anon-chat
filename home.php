<?php

require_once('config-exterior.php');

require_once('bloqueio_de_tela.php');

?>

<html>
<head>
    <meta charset="utf-8" />
    <title>AnonChat</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        .card-home {
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

            <div class="card-home">
                <div class="card">
                    <div class="card-header">
                        <?php
                        
                        echo "Meu hash: " . $_SESSION['usuario']->getDeshash();
                        ?>
                    </div>

                    <?php if (isset($_GET['status']) and $_GET['status'] === 'enviada') { ?>
                        <div class="text-danger">
                            Mensagem enviada com sucesso!
                        </div>
                    <?php } ?>


                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-center">
                                <a href="abrir_mensagem.php">
                                    <img src="img/formulario_abrir_chamado.png" width="70" height="70">
                                </a>
                            </div>
                            <div class="col-6 d-flex justify-content-center">
                                <a href="consultar_mensagem.php">
                                    <img src="img/formulario_consultar_chamado.png" width="70" height="70">
                                </a>
                            </div>
                        </div>

                        <?php
                        $botao = '<button class="btn btn-lg btn-danger btn-inline" type="bottom">Sair</button>';
                        echo '<a href="processadores-php/processa_doLogout.php?token='.md5(session_id()).'">' . $botao . '</a>';                        
                        ?>  
                    </div>
                </div>
            </div>
        </div>
</body>

</html>