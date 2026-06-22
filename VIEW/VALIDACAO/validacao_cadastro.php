<?php



require_once 'funcoes_validacao.php';


$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    
    $nome              = $_POST['nome'] ?? '';
    $data_nascimento   = $_POST['data_nascimento'] ?? '';
    $categoria         = $_POST['categoria'] ?? '';
    $mensalidade       = $_POST['mensalidade'] ?? 0;
    $cpf               = $_POST['cpf'] ?? '';

  
    $res_nome = validarNome($nome);
    if ($res_nome !== true) {
        $erros['nome'] = $res_nome;
    }

    
    $res_data = validarDataNascimento($data_nascimento);
    if ($res_data !== true) {
        $erros['data_nascimento'] = $res_data;
    }

   
    $res_cat = validarCategoriaEscoteiro($categoria);
    if ($res_cat !== true) {
        $erros['categoria'] = $res_cat;
    }

    
    $res_val = validarValorFinanceiro($mensalidade);
    if ($res_val !== true) {
        $erros['mensalidade'] = $res_val;
    }

   
    if (!empty($cpf)) {
        $res_cpf = validarCPF($cpf);
        if ($res_cpf !== true) {
            $erros['cpf'] = $res_cpf;
        }
    }

   
    if (empty($erros)) {
       
        echo "<h2>Cadastro realizado com sucesso! Todos os dados são válidos.</h2>";
       
    } else {
       
        session_start();
        $_SESSION['erros_validacao'] = $erros;
        $_SESSION['dados_antigos'] = $_POST;
        header("Location: ../formulario_cadastro.php");
        exit;
    }
}