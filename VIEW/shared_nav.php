<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";

if (session_status() == PHP_SESSION_NONE) { session_start(); }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GE Cambuy 469 - Administrativo</title>
    
    <link rel="stylesheet" href="/escoteiro/VIEW/css/style.css">
</head>
<body>
<nav class="navbar">
    <div class="nav-logo-area">
        <img src="/escoteiro/VIEW/imagem/logoescoteiro.jpeg" alt="Logo Cambuy" class="nav-logo">
        <strong>Gestão Cambuy</strong>
    </div>
    <div class="menu-toggle">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <ul class="nav-links">
        <li><a href="/escoteiro/VIEW/home.php">Home</a></li>
        <li><a href="/escoteiro/view/ESCOTEIRO/tabela_escoteiro.php">Cadastro Escoteiro</a></li>
        <li><a href="/escoteiro/view/ATIVIDADES/tabela_atividades.php">Atividades</a></li>
        <li><a href="/escoteiro/view/CHEFES/tabela_chefes.php">Chefes</a></li>
        <li><a href="/escoteiro/view/NOTIFICACOES/tabela_notificacao.php">Notificações</a></li>
        
        <?php if(isset($_SESSION['usuario'])): ?>
            <li><a href="/escoteiro/view/LOGIN/logout.php" style="background:rgba(255,255,255,0.2)">Sair (<?php echo $_SESSION['usuario']; ?>)</a></li>
        <?php else: ?>
            <li><a href="/escoteiro/view/LOGIN/inserir_login.php">Área de Login</a></li>
        <?php endif; ?>
    </ul>
</nav>