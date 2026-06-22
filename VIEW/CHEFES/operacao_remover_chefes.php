<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/chefes_voluntario.php";

if(isset($_GET['id'])) {
    $dal = new ChefesVoluntariosDAL();
    $dal->delete((int)$_GET['id']);
}

header("Location: tabela_chefes.php");
exit();
?>