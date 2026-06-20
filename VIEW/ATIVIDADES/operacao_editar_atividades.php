<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/atividade.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/atividade.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. CORREÇÃO: Nome da classe com as maiúsculas e plural corretos (Atividades)
    $ativ = new MODEL\Atividades(
        (int)$_POST['id_atividade'], 
        $_POST['data_atividade'], 
        $_POST['tipo'], 
        $_POST['descricao'], 
        null
    );
    
    // 2. CORREÇÃO: Instanciando o nome real da classe da DAL (AtividadesDAL) sem a barra virtual
    $dal = new AtividadesDAL();
    $dal->update($ativ);
    
    header("Location: tabela_atividades.php");
    exit();
}
?>