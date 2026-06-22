<?php
/**
 * ARQUIVO: processa_login.php
 * OBJETIVO: Conectar ao banco de dados com segurança, validar usuário existente e conferir hash da senha.
 */
session_start();
require_once 'funcoes_validacao.php';

// Simulação de conexão com o Banco de Dados usando PDO (Padrão mais seguro do PHP)
try {
    // Substitua pelos dados reais de conexão do seu ambiente/professor
    $db = new PDO("mysql:host=localhost;dbname=sistema_escoteiro;charset=utf8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro interno no sistema de banco de dados.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. Higieniza as entradas vindas do POST usando a função criada
    $usuario = higienizarEntrada($_POST['usuario'] ?? '');
    $senha   = $_POST['senha'] ?? ''; // Senha bruta não passamos htmlspecialchars para não alterar os caracteres dela

    // 2. Validação inicial de campos preenchidos
    if (empty($usuario) || empty($senha)) {
        $_SESSION['erro_login'] = "Preencha todos os campos obrigatórios.";
        header("Location: ../login.php");
        exit;
    }

    // 3. Validação no Banco de Dados com Proteção de SQL Injection (Uso de marcadores '?')
    $sql = "SELECT id, usuario, senha_hash FROM usuarios WHERE usuario = ? LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->execute([$usuario]);
    $dados_usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Validação Explícita: Se o login NÃO existir no banco de dados
    if (!$dados_usuario) {
        $_SESSION['erro_login'] = "Usuário não encontrado ou senha incorreta.";
        $_SESSION['velho_usuario'] = $usuario; // Preserva o que ele digitou no login
        header("Location: ../login.php");
        exit;
    }

    // 4. Validação da Senha Criptografada (Security Validation)
    // O sistema usa password_verify para comparar a senha digitada com o hash salvo (Ex: gerado por password_hash)
    if (password_verify($senha, $dados_usuario['senha_hash'])) {
        
        // Login efetuado com sucesso! Regenera a sessão por segurança contra fixação de sessão
        session_regenerate_id(true);
        $_SESSION['usuario_logado'] = $dados_usuario['usuario'];
        $_SESSION['usuario_id']     = $dados_usuario['id'];
        
        // Redireciona para o painel principal dos escoteiros
        header("Location: ../painel_escoteiro.php");
        exit;
    } else {
        // Se a senha estiver incorreta
        $_SESSION['erro_login'] = "Usuário não encontrado ou senha incorreta.";
        $_SESSION['velho_usuario'] = $usuario;
        header("Location: ../escoteiro/VIEW/LOGIN/login.php");
        exit;
    }
}