<?php
    
    session_start();
    
    
    unset($_SESSION['login']);

    
    Header("location: /escoteiro/VIEW/inserir_login.php"); 
?>