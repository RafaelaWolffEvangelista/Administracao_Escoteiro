<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/usuario.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = $_POST['senha'];

    if (!$email) {
        die("E-mail com formato inválido!");
    }

    $userDAL = new DAL\usuario();
    $usuarioLogado = $userDAL->autenticar($email, $senha);

    if ($usuarioLogado) {
        $_SESSION['usuario'] = $usuarioLogado->getNome();
        header("Location: ../escoteiro/tabela_escoteiro.php");
        exit();
    } else {
        echo "<script>alert('Credenciais incorretas!'); window.location='inserir_login.php';</script>";
    }
}