<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_escoteiro = (int)$_POST['id_escoteiro'];
    $tipo = $_POST['tipo'];
    $mensagem = $_POST['mensagem'];
    $numero_notificacao = (int)$_POST['numero_notificacao'];
    $data_envio = date('Y-m-d H:i:s');

    $pdo = Conexao::getConexao();

    // 1. Grava o registro da mensagem na tabela de notificações
    $stmtNotif = $pdo->prepare("INSERT INTO notificacoes (id_escoteiro, tipo, mensagem, data_envio) VALUES (?, ?, ?, ?)");
    $stmtNotif->execute([$id_escoteiro, $tipo, $mensagem, $data_envio]);

    // 2. REGRA DE NEGÓCIO AUTOMATIZADA:
    // Se for a terceira notificação ou mais, altera o status do escoteiro para Atrasado. 
    // Caso contrário, firma ele no estado Pendente.
    if ($numero_notificacao >= 3) {
        $novoStatus = "Atrasado";
    } else {
        $novoStatus = "Pendente";
    }

    $stmtUpdate = $pdo->prepare("UPDATE escoteiros SET status = ? WHERE id_escoteiro = ?");
    $stmtUpdate->execute([$novoStatus, $id_escoteiro]);

    // Redireciona de volta para a listagem principal de escoteiros
    header("Location: ../ESCOTEIRO/tabela_escoteiro.php");
    exit();
}
?>