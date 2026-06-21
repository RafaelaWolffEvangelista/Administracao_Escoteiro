<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/escoteiros.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/escoteiro.php";  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. CORREÇÃO: Nome correto da classe do modelo com a primeira letra maiúscula (Escoteiro)
    $escoteiro = new MODEL\Escoteiro(
        null, 
        $_POST['nome'], 
        $_POST['data_nascimento'], 
        $_POST['nome_responsavel'], 
        $_POST['telefone_responsavel'], 
        0, 
        $_POST['status']
    );
    
    // 2. CORREÇÃO: Nome real da classe da DAL (EscoteiroDAL) sem a barra virtual
    $dal = new EscoteiroDAL();
    $dal->insert($escoteiro);
    
    // 3. CORREÇÃO: Redirecionando para o nome correto do seu arquivo de listagem
    header("Location: tabela_escoteiro.php");
    exit();
}
?>