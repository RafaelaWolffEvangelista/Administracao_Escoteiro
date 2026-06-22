<?php

session_start();
require_once 'funcoes_validacao.php';


try {

    $db = new PDO("mysql:host=localhost;dbname=sistema_escoteiro;charset=utf8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro interno no sistema de banco de dados.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    $usuario = higienizarEntrada($_POST['usuario'] ?? '');
    $senha   = $_POST['senha'] ?? '';

   
    if (empty($usuario) || empty($senha)) {
        $_SESSION['erro_login'] = "Preencha todos os campos obrigatórios.";
        header("Location: ../login.php");
        exit;
    }

   
    $sql = "SELECT id, usuario, senha_hash FROM usuarios WHERE usuario = ? LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->execute([$usuario]);
    $dados_usuario = $stmt->fetch(PDO::FETCH_ASSOC);

   
    if (!$dados_usuario) {
        $_SESSION['erro_login'] = "Usuário não encontrado ou senha incorreta.";
        $_SESSION['velho_usuario'] = $usuario; // Preserva o que ele digitou no login
        header("Location: ../login.php");
        exit;
    }

  
    if (password_verify($senha, $dados_usuario['senha_hash'])) {
        
       
        session_regenerate_id(true);
        $_SESSION['usuario_logado'] = $dados_usuario['usuario'];
        $_SESSION['usuario_id']     = $dados_usuario['id'];
        
       
        header("Location: ../painel_escoteiro.php");
        exit;
    } else {
       
        $_SESSION['erro_login'] = "Usuário não encontrado ou senha incorreta.";
        $_SESSION['velho_usuario'] = $usuario;
        header("Location: ../escoteiro/VIEW/LOGIN/login.php");
        exit;
    }
}