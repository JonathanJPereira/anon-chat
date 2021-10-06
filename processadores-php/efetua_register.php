<?php

require_once('config.php');

$hash = $_POST['hash'];
$senha = $_POST['senha'];

$usuario = new Usuario($hash, $senha);

header("Location: ../index.php?hash=$hash");

?>