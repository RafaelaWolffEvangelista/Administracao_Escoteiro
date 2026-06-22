<?php
/**
 * ARQUIVO: funcoes_validacao.php
 * OBJETIVO: Funções explícitas para validar cada tipo de dado do sistema de escoteiros.
 */

// Valida se o campo não está vazio e tem tamanho mínimo
function validarNome($nome) {
    $nome = trim($nome);
    if (empty($nome) || strlen($nome) < 3) {
        return "O nome deve conter pelo menos 3 caracteres.";
    }
    return true;
}

// Valida se a data é real e se o escoteiro tem uma idade mínima permitida (ex: maior de 6 anos)
function validarDataNascimento($data) {
    if (empty($data)) {
        return "A data de nascimento é obrigatória.";
    }
    
    $data_atual = new DateTime();
    $nascimento = new DateTime($data);
    $idade = $data_atual->diff($nascimento)->y;

    if ($nascimento > $data_atual) {
        return "A data de nascimento não pode ser no futuro.";
    }
    if ($idade < 6) {
        return "A idade mínima para ingressar no grupo de escoteiros é 6 anos.";
    }
    return true;
}

// Valida se a categoria selecionada (Ex: Lobinho, Escoteiro, Sênior, Pioneiro, Chefe) é válida
// Esta é uma validação crucial que impede dados corrompidos via inspecionar elemento do navegador
function validarCategoriaEscoteiro($categoria) {
    $categorias_permitidas = ['Lobinho', 'Escoteiro', 'Senior', 'Pioneiro', 'Chefe'];
    if (!in_array($categoria, $categorias_permitidas)) {
        return "Categoria de escoteiro inválida.";
    }
    return true;
}

// Valida se o valor numérico (mensalidades ou taxas de uniforme) é válido e positivo
function validarValorFinanceiro($valor) {
    if (!is_numeric($valor) || $valor < 0) {
        return "O valor financeiro deve ser um número positivo.";
    }
    return true;
}

// Validação extra importante (Regra de Negócio): Valida formato de CPF (caso seu código use)
function validarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    if (strlen($cpf) != 11 || preg_match('/([0-9])\1{10}/', $cpf)) {
        return "O CPF informado é inválido.";
    }
    // Lógica matemática de verificação de dígitos do CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return "O CPF informado é inválido.";
        }
    }
    return true;
}