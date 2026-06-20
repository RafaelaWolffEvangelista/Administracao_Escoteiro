<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_atividade = (int)$_POST['id_atividade'];
    $id_escoteiro = (int)$_POST['id_escoteiro'];

    $pdo = Conexao::getConexao();

    // Validação: Verifica se o jovem já está inscrito para não duplicar
    $stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM atividade_escoteiro WHERE id_atividade = ? AND id_escoteiro = ?");
    $stmtCheck->execute([$id_atividade, $id_escoteiro]);
    
    if ($stmtCheck->fetchColumn() == 0) {
        // Insere o vínculo se não existir
        $stmt = $pdo->prepare("INSERT INTO atividade_escoteiro (id_atividade, id_escoteiro) VALUES (?, ?)");
        $stmt->execute([$id_atividade, $id_escoteiro]);
    }

    // Redireciona para a tabela de atividades para ver o contador atualizado
    header("Location: tabela_atividades.php");
    exit();
}
?>