<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/escoteiros.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/escoteiro.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. CORREÇÃO: Nome correto da classe do modelo (Escoteiro com E maiúsculo)
    $escoteiro = new MODEL\Escoteiro(
        (int)$_POST['id_escoteiro'], 
        $_POST['nome'], 
        $_POST['data_nascimento'], 
        $_POST['nome_responsavel'], 
        $_POST['telefone_responsavel'], 
        0, 
        $_POST['status']
    );
    
    // 2. CORREÇÃO: Nome real da classe da DAL (EscoteiroDAL) de forma direta
    $dal = new EscoteiroDAL();
    $dal->update($escoteiro);
    
    // 3. CORREÇÃO: Redirecionando para a listagem correta (tabela_escoteiro.php)
    header("Location: tabela_escoteiro.php");
    exit();
}
?>