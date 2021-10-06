<?php
require_once('bloqueio_de_tela.php');
?>

<html>
<head>
    <meta charset="utf-8" />
    <title>AnonChat</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        .card-abrir-chamado {
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

            <div class="card-abrir-chamado">
                <div class="card">
                    <div class="card-header">
                        Enviando mensagem
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">

                                <form action="processadores-php/processa_mensagem.php" method="POST">
                                    <div class="form-group">
                                        <label>Hash:</label>
                                        <input name="hash" type="text" class="form-control" placeholder="Digite aqui o hash do destinatário">
                                    </div>                                    

                                    <div class="form-group">
                                        <label>Mensagem:</label>
                                        <textarea name="mensagem" name="mensagem" class="form-control" rows="3" placeholder="Digite aqui a mensagem"></textarea>
                                    </div>

                                    <div class="row mt-5">
                                        <div class="col-6">
                                            <button name="action" value="voltar" class="btn btn-lg btn-warning btn-block" type="submit">Voltar</button>
                                        </div>

                                        <div class="col-6">
                                            <button name="action" value="enviar" class="btn btn-lg btn-info btn-block" type="submit">Enviar</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>