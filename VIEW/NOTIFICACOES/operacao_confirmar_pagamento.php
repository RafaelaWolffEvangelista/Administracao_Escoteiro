<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $pdo = Conexao::getConexao();

    // 1. Altera o status para Pago
    $stmt = $pdo->prepare("UPDATE escoteiros SET status = 'Pago' WHERE id_escoteiro = ?");
    $stmt->execute([$id]);

    // 2. Limpa o histórico de notificações antigas para reiniciar o ciclo no próximo mês
    $stmtLimpa = $pdo->prepare("DELETE FROM notificacoes WHERE id_escoteiro = ?");
    $stmtLimpa->execute([$id]);
}

header("Location: tabela_escoteiro.php");
exit();
?>