<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/usuario.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/usuario.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['usuario'] ?? ''; 
    $senha = $_POST['password'] ?? '';

   
    $dalUsuario = new \DAL\UsuarioDAL(); 
    
  
    $usuario = $dalUsuario->autenticar($login, $senha);

   
    if ($usuario !== null) {
        session_start();
        
        $_SESSION['login'] = $usuario->getNome(); 
        
        header("location:/escoteiro/VIEW/home.php");
        exit();
    } else {
       
        header("location:/escoteiro/VIEW/LOGIN/inserir_login.php");
        exit();
    }
} else {
    header("location:/escoteiro/VIEW/LOGIN/inserir_login.php");
    exit();
}
?>