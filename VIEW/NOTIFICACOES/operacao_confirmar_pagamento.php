<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $pdo = Conexao::getConexao();

    $stmt = $pdo->prepare("UPDATE escoteiros SET status = 'Pago' WHERE id_escoteiro = ?");
    $stmt->execute([$id]);

    $stmtLimpa = $pdo->prepare("DELETE FROM notificacoes WHERE id_escoteiro = ?");
    $stmtLimpa->execute([$id]);
}

header("Location: tabela_escoteiro.php");
exit();
?>