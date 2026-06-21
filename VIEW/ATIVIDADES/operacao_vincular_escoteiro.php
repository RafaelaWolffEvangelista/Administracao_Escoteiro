<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_atividade = (int)$_POST['id_atividade'];
    $id_escoteiro = (int)$_POST['id_escoteiro'];

    $pdo = Conexao::getConexao();

    $stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM atividade_escoteiro WHERE id_atividade = ? AND id_escoteiro = ?");
    $stmtCheck->execute([$id_atividade, $id_escoteiro]);
    
    if ($stmtCheck->fetchColumn() == 0) {

        $stmt = $pdo->prepare("INSERT INTO atividade_escoteiro (id_atividade, id_escoteiro) VALUES (?, ?)");
        $stmt->execute([$id_atividade, $id_escoteiro]);
    }

    header("Location: tabela_atividades.php");
    exit();
}
?>