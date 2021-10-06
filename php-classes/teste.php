<?php

require_once('Sql.php');
require_once('Mensagem.php');

$mensagem1 = new Mensagem();

$mensagem1->loadByDestinatario('5FD924625F6AB16A19CC9807C7C506AE1813490E4BA675F843D5A10E0BAACDB8');

echo $mensagem1;

?>