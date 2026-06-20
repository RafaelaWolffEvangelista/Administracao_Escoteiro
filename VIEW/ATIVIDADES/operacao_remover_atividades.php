<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/atividade.php";

if(isset($_GET['id'])) {
    // CORREÇÃO: Instanciando o nome real da classe (AtividadesDAL) de forma direta
    $dal = new AtividadesDAL();
    $dal->delete((int)$_GET['id']);
}

header("Location: tabela_atividades.php");
exit();
?>