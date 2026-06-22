<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/notificacoes.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/notificacoes.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id_notificacao = (int)$_POST['id_notificacao'];
    $tipo = $_POST['tipo'];
    $mensagem = $_POST['mensagem'];

    
    $pdo = Conexao::getConexao();
    $stmt = $pdo->prepare("UPDATE notificacoes SET tipo = ?, mensagem = ? WHERE id_notificacao = ?");
    $stmt->execute([$tipo, $mensagem, $id_notificacao]);
    
  
    header("Location: tabela_notificacao.php");
    exit();
}
?>