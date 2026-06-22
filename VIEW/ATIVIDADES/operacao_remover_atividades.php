<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/atividades.php";

if(isset($_GET['id'])) {

    $dal = new AtividadesDAL();
    $dal->delete((int)$_GET['id']);
}

header("Location: tabela_atividades.php");
exit();
?>