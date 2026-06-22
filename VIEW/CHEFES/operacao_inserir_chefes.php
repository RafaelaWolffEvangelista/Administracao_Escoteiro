<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/chefes_voluntario.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/chefes.php";  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $chefe = new MODEL\ChefesVoluntarios(
        null, 
        $_POST['nome'], 
        $_POST['funcao'], 
        $_POST['telefone'], 
        $_POST['status'], 
        null
    );

    $dal = new ChefesVoluntariosDAL();
    $dal->insert($chefe);
    
    header("Location: tabela_chefes.php");
    exit();
}
?>