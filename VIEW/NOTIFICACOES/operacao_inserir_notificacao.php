<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/notificacoes.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/notificacoes.php";  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    
    $notif = new MODEL\Notificacoes(
        null,
        $_POST['tipo'],
        $_POST['mensagem'],
        date('Y-m-d H:i:s'),
        (int)$_POST['id_escoteiro']
    );
    
    $dal = new NotificacoesDAL();
    $dal->insert($notif);
    
    header("Location: tabela_notificacao.php");
    exit();
}
?>