<?php
session_start();
$erro_login = $_SESSION['erro_login'] ?? '';
$velho_usuario = $_SESSION['velho_usuario'] ?? '';
unset($_SESSION['erro_login'], $_SESSION['velho_usuario']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema Escoteiro</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 50px; }
        .login-container { max-width: 400px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 20px; }
        label { font-weight: bold; display: block; margin-bottom: 5px; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        
        /* CSS de Validação Visual */
        input:focus:invalid { border-color: #ff4d4d; box-shadow: 0 0 5px rgba(255, 77, 77, 0.5); }
        input:focus:valid { border-color: #2ecc71; box-shadow: 0 0 5px rgba(46, 204, 113, 0.5); }
        
        .erro-alerta { background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #f5c6cb; }
        .forca-senha { font-size: 0.85em; margin-top: 5px; font-weight: bold; }
        .fraca { color: #ff4d4d; }
        .media { color: #f39c12; }
        .forte { color: #2ecc71; }
        button { width: 100%; padding: 12px; background-color: #5c2d91; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background-color: #4a2375; }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Área do Escoteiro - Login</h2>

    <?php if (!empty($erro_login)): ?>
        <div class="erro-alerta"><?= htmlspecialchars($erro_login) ?></div>
    <?php endif; ?>

    <form action="validacao/processa_login.php" method="POST" id="formLogin">
        
        <div class="form-group">
            <label for="usuario">Usuário ou Registro:</label>
            <input type="text" id="usuario" name="usuario" required value="<?= htmlspecialchars($velho_usuario) ?>">
        </div>

        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required minlength="8">
            <div id="feedback-senha" class="forca-senha"></div>
        </div>

        <button type="submit">Entrar no Sistema</button>
    </form>
</div>

<script>
    const senhaInput = document.getElementById('senha');
    const feedbackSenha = document.getElementById('feedback-senha');
    const formLogin = document.getElementById('formLogin');

    // Escuta a digitação do usuário para validar a força da senha em tempo real
    senhaInput.addEventListener('input', () => {
        const valor = senhaInput.value;
        let forca = 0;

        if (valor.length >= 8) forca++;
        if (/[A-Z]/.test(valor)) forca++; // Letra maiúscula
        if (/[0-9]/.test(valor)) forca++; // Número
        if (/[^A-Za-z0-9]/.test(valor)) forca++; // Caractere especial

        // Atualiza a interface com base nos critérios de segurança
        if (valor.length === 0) {
            feedbackSenha.textContent = '';
        } else if (forca <= 2) {
            feedbackSenha.textContent = 'Senha Fraca (Insira letras maiúsculas, números e símbolos)';
            feedbackSenha.className = 'forca-senha fraca';
        } else if (forca === 3) {
            feedbackSenha.textContent = 'Senha Média (Boa, mas pode melhorar)';
            feedbackSenha.className = 'forca-senha media';
        } else {
            feedbackSenha.textContent = 'Senha Forte e Segura!';
            feedbackSenha.className = 'forca-senha forte';
        }
    });

    // Validação extra JS no Submit do formulário (Segunda barreira do front-end)
    formLogin.addEventListener('submit', (e) => {
        if (senhaInput.value.length < 8) {
            e.preventDefault(); // Bloqueia o envio do formulário
            alert('Por motivos de segurança, sua senha precisa ter no mínimo 8 caracteres.');
        }
    });
</script>
</body>
</html>