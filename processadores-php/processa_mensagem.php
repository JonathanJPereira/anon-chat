<?php

require_once('config.php');

session_start();


if ($_POST['action'] === 'voltar') {
    header('Location: ../home.php');
} else if ($_POST['action'] === 'enviar') {

    $usuario_remetente = $_SESSION['usuario'];
    $hash_usuario_remetente = $usuario_remetente->getDeshash();

    $usuario_destinatario = $_POST['hash'];
    $mensagem = $_POST['mensagem'];

    $mensagem = new Mensagem($hash_usuario_remetente, $usuario_destinatario, $mensagem);

    header('Location: ../home.php?status=enviada');
}

?>