<?php
    //abre a sessão
    session_start();
    
    //destrói as variáveis de sessão
    unset($_SESSION['login']);

    //redireciona para index.php-login
    Header("location: /escoteiro/VIEW/inserir_login.php"); 
?>