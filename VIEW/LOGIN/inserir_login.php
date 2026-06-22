<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/usuario.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/escoteiro/VIEW/css/login.css">
</head>
<body>

    <div class="container">
        <div class="logo-container">
            <img src="/escoteiro/VIEW/imagem/logoescoteiro.webp" width="100" height="100" alt="Logo Escoteiro">
        </div>
        
        <h4>LOGIN</h4>

        <form method="POST" action="login.php">
            
            <div class="input-container">
                <label for="usuario">USUÁRIO</label>
                <div class="icon"><i class="material-icons">account_circle</i></div>
                <input id="usuario" type="text" name="usuario" placeholder="Digite seu usuário" required>
            </div>

            <div class="input-container">
                <label for="password">SENHA</label>
                <div class="icon"><i class="material-icons">lock</i></div>
                <input id="password" type="password" name="password" placeholder="Digite sua senha" required>
            </div>

            <button type="submit" name="action">ACESSAR</button>
            
        </form>
    </div>

    <footer class="footer">
        <p>&copy; 2024 GE Cambuy</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <script src="/escoteiro/VIEW/js/javascript.js"></script>
</body>
</html>