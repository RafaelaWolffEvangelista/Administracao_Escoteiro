<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/chefes_voluntario.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/chefes.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. CORREÇÃO: Nome correto da classe do modelo (ChefesVoluntarios)
    $chefe = new MODEL\ChefesVoluntarios(
        (int)$_POST['id_voluntario'], 
        $_POST['nome'], 
        $_POST['funcao'], 
        $_POST['telefone'], 
        $_POST['status'], 
        null
    );
    
    // 2. CORREÇÃO: Nome real da classe da DAL (ChefesVoluntariosDAL) sem a barra virtual
    $dal = new ChefesVoluntariosDAL();
    $dal->update($chefe);
    
    header("Location: tabela_chefes.php");
    exit();
}
?>