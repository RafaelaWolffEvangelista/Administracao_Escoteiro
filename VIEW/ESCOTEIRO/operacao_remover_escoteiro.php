<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/escoteiros.php";

if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $pdo = Conexao::getConexao();

    // 1. LIMPEZA PREVENTIVA: Remove todos os alertas vinculados a este escoteiro
    $stmtNotif = $pdo->prepare("DELETE FROM notificacoes WHERE id_escoteiro = ?");
    $stmtNotif->execute([$id]);

    // 2. NOVA RELAÇÃO: Remove também o vínculo dele com as atividades coletivas
    $stmtAtv = $pdo->prepare("DELETE FROM atividade_escoteiro WHERE id_escoteiro = ?");
    $stmtAtv->execute([$id]);

    // 3. EXCLUSÃO PRINCIPAL: Agora o caminho está livre para apagar o escoteiro
    $dal = new EscoteiroDAL();
    $dal->delete($id);
}

// Redireciona de volta para a listagem
header("Location: tabela_escoteiro.php");
exit();
?>