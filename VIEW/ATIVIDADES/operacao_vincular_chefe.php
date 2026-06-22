<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_atividade = (int)$_POST['id_atividade'];
    $id_usuario = (int)$_POST['id_usuario'];

    $pdo = Conexao::getConexao();

    $stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM atividade_chefe WHERE id_atividade = ? AND id_usuario = ?");
    $stmtCheck->execute([$id_atividade, $id_usuario]);
    
    if ($stmtCheck->fetchColumn() == 0) {
        $stmt = $pdo->prepare("INSERT INTO atividade_chefe (id_atividade, id_usuario) VALUES (?, ?)");
        $stmt->execute([$id_atividade, $id_usuario]);
    }

    header("Location: tabela_atividades.php");
    exit();
}
?>