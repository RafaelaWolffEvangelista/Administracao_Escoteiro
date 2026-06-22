<?php
/**
 * ARQUIVO: processa_cadastro.php
 * OBJETIVO: Capturar o POST, executar o fluxo de validações e gerenciar mensagens de erro.
 */

// Importa as funções estruturadas de validação
require_once 'funcoes_validacao.php';

// Inicializa um array para guardar os erros encontrados
$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. Captura as variáveis usando os nomes típicos do seu repositório de escoteiros
    $nome              = $_POST['nome'] ?? '';
    $data_nascimento   = $_POST['data_nascimento'] ?? '';
    $categoria         = $_POST['categoria'] ?? '';
    $mensalidade       = $_POST['mensalidade'] ?? 0;
    $cpf               = $_POST['cpf'] ?? '';

    // 2. Executa a estrutura de validação para cada campo
    
    // Validação do Nome
    $res_nome = validarNome($nome);
    if ($res_nome !== true) {
        $erros['nome'] = $res_nome;
    }

    // Validação da Data de Nascimento
    $res_data = validarDataNascimento($data_nascimento);
    if ($res_data !== true) {
        $erros['data_nascimento'] = $res_data;
    }

    // Validação da Categoria do Escoteiro
    $res_cat = validarCategoriaEscoteiro($categoria);
    if ($res_cat !== true) {
        $erros['categoria'] = $res_cat;
    }

    // Validação do Valor da Mensalidade
    $res_val = validarValorFinanceiro($mensalidade);
    if ($res_val !== true) {
        $erros['mensalidade'] = $res_val;
    }

    // Validação Extra/Importante do CPF
    if (!empty($cpf)) {
        $res_cpf = validarCPF($cpf);
        if ($res_cpf !== true) {
            $erros['cpf'] = $res_cpf;
        }
    }

    // 3. Verificação do fluxo
    if (empty($erros)) {
        // Se o array de erros estiver vazio, a lógica do professor dita avançar para o banco de dados
        // Exemplo: $controlador->salvarEscoteiro(...);
        echo "<h2>Cadastro realizado com sucesso! Todos os dados são válidos.</h2>";
        // header("Location: sucesso.php"); 
    } else {
        // Se houver erros, armazena na sessão e volta para o formulário de visualização
        session_start();
        $_SESSION['erros_validacao'] = $erros;
        $_SESSION['dados_antigos'] = $_POST; // Mantém o que o usuário já digitou para não apagar
        header("Location: ../formulario_cadastro.php");
        exit;
    }
}