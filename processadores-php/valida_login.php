<?php

require_once('config.php');
session_start();

if ($_POST['action'] === 'entrar') {
    $_SESSION['autenticado'] = false;
    // Verificando as credênciais digitadas estão corretas
    $hash = $_POST['hash'];
    $senha = $_POST['senha'];
    
    
    try {
        $usuario_no_banco_de_dados = Usuario::search($hash);
    } catch (\Throwable $th) {
        header('Location: ../index.php?login=erro');
    }
    
    $usuario = new Usuario('', '');
    
    if ($usuario_no_banco_de_dados[0]['deshash'] === $hash and $usuario_no_banco_de_dados[0]['dessenha'] === $senha) {
    
        $usuario->login($hash, $senha);
        $_SESSION['usuario'] = $usuario;
        $_SESSION['autenticado'] = true;
        header('Location: ../home.php?usuario=logado');
    } else {
        header('Location: ../index.php?login=erro');
    }
} elseif ($_POST['action'] === 'registrar') {
    header('Location: ../register.php');
} else {
    header('Location: ../index.php');
}

