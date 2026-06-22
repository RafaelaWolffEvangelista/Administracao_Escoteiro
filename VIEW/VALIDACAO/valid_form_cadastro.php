<?php

session_start();


$erros = $_SESSION['erros_validacao'] ?? [];
$velhos_dados = $_SESSION['dados_antigos'] ?? [];


unset($_SESSION['erros_validacao']);
unset($_SESSION['dados_antigos']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Escoteiro - Sistema Financeiro e de Registro</title>
    <style>
        .erro-mensagem { color: red; font-size: 0.9em; display: block; margin-top: 5px; }
        .campo-erro { border: 1px solid red; }
        .form-group { margin-bottom: 15px; }
    </style>
</head>
<body>

    <h1>Registro de Membro do Grupo de Escoteiros</h1>

    <form action="validacao/processa_cadastro.php" method="POST">
        
        <div class="form-group">
            <label for="nome">Nome do Escoteiro:</label><br>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($velhos_dados['nome'] ?? '') ?>" class="<?= isset($erros['nome']) ? 'campo-erro' : '' ?>">
            <?php if (isset($erros['nome'])): ?>
                <span class="erro-mensagem"><?= $erros['nome'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="cpf">CPF:</label><br>
            <input type="text" id="cpf" name="cpf" value="<?= htmlspecialchars($velhos_dados['cpf'] ?? '') ?>" class="<?= isset($erros['cpf']) ? 'campo-erro' : '' ?>">
            <?php if (isset($erros['cpf'])): ?>
                <span class="erro-mensagem"><?= $erros['cpf'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="data_nascimento">Data de Nascimento:</label><br>
            <input type="date" id="data_nascimento" name="data_nascimento" value="<?= htmlspecialchars($velhos_dados['data_nascimento'] ?? '') ?>" class="<?= isset($erros['data_nascimento']) ? 'campo-erro' : '' ?>">
            <?php if (isset($erros['data_nascimento'])): ?>
                <span class="erro-mensagem"><?= $erros['data_nascimento'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="categoria">Ramo / Categoria:</label><br>
            <select id="categoria" name="categoria" class="<?= isset($erros['categoria']) ? 'campo-erro' : '' ?>">
                <option value="">-- Selecione o Ramo --</option>
                <option value="Lobinho" <?= ($velhos_dados['categoria'] ?? '') == 'Lobinho' ? 'selected' : '' ?>>Ramo Lobinho (6 a 10 anos)</option>
                <option value="Escoteiro" <?= ($velhos_dados['categoria'] ?? '') == 'Escoteiro' ? 'selected' : '' ?>>Ramo Escoteiro (11 a 14 anos)</option>
                <option value="Senior" <?= ($velhos_dados['categoria'] ?? '') == 'Senior' ? 'selected' : '' ?>>Ramo Sênior (15 a 17 anos)</option>
                <option value="Pioneiro" <?= ($velhos_dados['categoria'] ?? '') == 'Pioneiro' ? 'selected' : '' ?>>Ramo Pioneiro (18 a 21 anos)</option>
                <option value="Chefe" <?= ($velhos_dados['categoria'] ?? '') == 'Chefe' ? 'selected' : '' ?>>Adulto Voluntário / Chefe</option>
            </select>
            <?php if (isset($erros['categoria'])): ?>
                <span class="erro-mensagem"><?= $erros['categoria'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="mensalidade">Valor da Contribuição Mensal (R$):</label><br>
            <input type="number" step="0.01" id="mensalidade" name="mensalidade" value="<?= htmlspecialchars($velhos_dados['mensalidade'] ?? '') ?>" class="<?= isset($erros['mensalidade']) ? 'campo-erro' : '' ?>">
            <?php if (isset($erros['mensalidade'])): ?>
                <span class="erro-mensagem"><?= $erros['mensalidade'] ?></span>
            <?php endif; ?>
        </div>

        <button type="submit">Validar e Cadastrar Escoteiro</button>
    </form>

</body>
</html>