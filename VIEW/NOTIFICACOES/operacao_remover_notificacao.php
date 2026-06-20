<?php
// Inclui o arquivo de conexão direta com o banco de dados
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";

if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // CORREÇÃO SEGURA: Deleta o registro direto via PDO, evitando métodos ausentes na DAL
    $pdo = Conexao::getConexao();
    $stmt = $pdo->prepare("DELETE FROM notificacoes WHERE id_notificacao = ?");
    $stmt->execute([$id]);
}

// Redireciona de volta para a listagem de notificações
header("Location: tabela_notificacao.php");
exit();
?>