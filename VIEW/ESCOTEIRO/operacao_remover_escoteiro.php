<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/escoteiros.php";

if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $pdo = Conexao::getConexao();

    $stmtNotif = $pdo->prepare("DELETE FROM notificacoes WHERE id_escoteiro = ?");
    $stmtNotif->execute([$id]);

    $stmtAtv = $pdo->prepare("DELETE FROM atividade_escoteiro WHERE id_escoteiro = ?");
    $stmtAtv->execute([$id]);

    $dal = new EscoteiroDAL();
    $dal->delete($id);
}

header("Location: tabela_escoteiro.php");
exit();
?>