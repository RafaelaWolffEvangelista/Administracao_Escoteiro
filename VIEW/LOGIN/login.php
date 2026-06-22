<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/usuario.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/usuario.php";

$login = $_POST['usuario'];
$senha = $_POST['password'];
$hash = md5($senha);

//echo $login . " - " . $senha . " - " . $hash; 

$dalUsuario = new \DAL\UsuarioDAL(); 
$usuario = $dalUsuario->SelectByUsuario($login);


//echo $usuario->getUsuario(); 


if ($hash == $usuario->getSenha()) {
    session_start();
    $_SESSION['login'] = $login;
    //$_SESSION['nivel'] = $linha['nivel']; 
    header("location:/escoteiro/VIEW/home.php");
} 
else header("location:/escoteiro/VIEW/LOGIN/inserir_login.php");