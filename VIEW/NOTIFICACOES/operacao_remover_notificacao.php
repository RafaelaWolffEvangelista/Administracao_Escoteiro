<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";

if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
   
    $pdo = Conexao::getConexao();
    $stmt = $pdo->prepare("DELETE FROM notificacoes WHERE id_notificacao = ?");
    $stmt->execute([$id]);
}


header("Location: tabela_notificacao.php");
exit();
?>