<?php

require_once('config.php');
session_start();

if ($_POST['action'] === 'voltar') {
    header('Location: ../home.php');
} else if ($_POST['action'] === 'apagar') {
    $usuario = $_SESSION['usuario']->getDeshash();
    $mensagens = new Mensagem();
    $mensagens->loadByDestinatario($usuario);
    $mensagens->delete();
    header('Location: ../consultar_mensagem.php');
}
