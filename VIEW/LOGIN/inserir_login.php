<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - GE Cambuy</title>
    <link rel="stylesheet" href="../../assets/style.css">
</head>
<body style="background:#f3f0ff; display:flex; justify-content:center; align-items:center; height:100vh;">
<div class="card" style="width:100%; max-width:400px;">
    <div style="text-align:center; margin-bottom:20px;">
        <img src="../../logoescoteiro.webp" style="width:90px;" alt="Logo">
        <h2>Área Restrita</h2>
    </div>
    <form action="operacao_inserir_login.php" method="POST">
        <div class="form-group">
            <label>E-mail institucional</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Senha de Acesso</label>
            <input type="password" name="senha" class="form-control" oninput="avaliarForcaSenha(this.value)" required>
            <small id="feedback-senha" style="font-weight:bold;"></small>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">Entrar no Sistema</button>
    </form>
</div>
<script src="../../assets/script.js"></script>
</body>
</html>