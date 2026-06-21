<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/escoteiros.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/escoteiro.php";  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $escoteiro = new MODEL\Escoteiro(
        null, 
        $_POST['nome'], 
        $_POST['data_nascimento'], 
        $_POST['nome_responsavel'], 
        $_POST['telefone_responsavel'], 
        0, 
        $_POST['status']
    );

    $dal = new EscoteiroDAL();
    $dal->insert($escoteiro);

    header("Location: tabela_escoteiro.php");
    exit();
}
?>