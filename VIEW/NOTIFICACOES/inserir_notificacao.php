<?php 
// 1. Inclui o menu unificado oficial (carrega o HTML, <head> e o estilo CSS)
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/VIEW/shared_nav.php";  
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/escoteiros.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/escoteiro.php";

// Captura o ID do escoteiro que veio do botão "Cobrar" da tabela de escoteiros
$id_escoteiro = $_GET['id_escoteiro'] ?? null;

if (!$id_escoteiro) {
    echo "<div class='container'><div class='card'><p class='text-danger' style='font-weight:bold;'>Erro: Nenhum escoteiro foi selecionado.</p><p>Volte para a listagem de escoteiros e clique no botão <strong>⚙️ Cobrar</strong> do membro desejado.</p><br><a href='../ESCOTEIRO/tabela_escoteiro.php' class='btn btn-secondary'>Voltar para Escoteiros</a></div></div>";
    exit();
}

$pdo = Conexao::getConexao();

// 1. Busca os dados cadastrais do escoteiro alvo
$stmtEsc = $pdo->prepare("SELECT * FROM escoteiros WHERE id_escoteiro = ?");
$stmtEsc->execute([$id_escoteiro]);
$escoteiro = $stmtEsc->fetch();

if (!$escoteiro) {
    echo "<div class='container'><div class='card'><p class='text-danger'>Escoteiro não encontrado no sistema.</p><br><a href='../ESCOTEIRO/tabela_escoteiro.php' class='btn btn-secondary'>Voltar</a></div></div>";
    exit();
}

// TRAVA DE SEGURANÇA SE JÁ ESTIVER PAGO: Impede a renderização da tela de cobrança
if (strtolower($escoteiro['status']) === 'pago') {
    echo "<div class='container'><div class='card'><p class='text-success' style='font-weight:bold; font-size: 18px;'>🎉 Este escoteiro já está com as mensalidades em dia!</p><p>Não é permitido enviar notificações de cobrança para membros com o status 'Pago'.</p><br><a href='../ESCOTEIRO/tabela_escoteiro.php' class='btn btn-secondary'>Voltar para Escoteiros</a></div></div>";
    exit();
}

// 2. Conta o histórico: quantas notificações esse jovem específico já acumulou
$stmtCount = $pdo->prepare("SELECT COUNT(*) FROM notificacoes WHERE id_escoteiro = ?");
$stmtCount->execute([$id_escoteiro]);
$qtdAtual = (int)$stmtCount->fetchColumn();

// 3. Estruturação dinâmica das 3 mensagens exigidas pela gestão
$mensagensPadrao = [
    1 => [
        "tipo" => "1º Aviso (Antecipado - 5 Dias)",
        "texto" => "Olá! Lembramos que em 5 dias a mensalidade do seu escoteiro vencerá. Evite pendências mantendo a contribuição em dia!"
    ],
    2 => [
        "tipo" => "2º Aviso (Último Dia de Prazo)",
        "texto" => "Atenção! Hoje é o último dia para o pagamento da mensalidade do escoteiro. Por favor, regularize o envio do comprovante à secretaria."
    ],
    3 => [
        "tipo" => "3º Aviso (Inadimplência / Atraso)",
        "texto" => "Constatamos a falta de pagamento da mensalidade. Caso esteja passando por problemas ou dificuldades financeiras temporárias, por favor, procure a chefia ou um funcionário do grupo para conversarmos e encontrarmos uma solução juntos."
    ]
];

// Define qual o nível da mensagem atual (se o jovem já tem 3 ou mais avisos, ele continua preso no nível 3)
$sugestaoProxima = ($qtdAtual < 3) ? $qtdAtual + 1 : 3;
$avisoConfigurado = $mensagensPadrao[$sugestaoProxima];
?>
<div class="container">
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <div class="card-title">Gerar Notificação Automatizada</div>
        
        <p style="margin-bottom: 5px;">Membro Destinatário: <strong><?php echo $escoteiro['nome']; ?></strong></p>
        <p style="margin-bottom: 15px;">Histórico do Usuário: <span class="badge" style="background:#4a5568; color:white; padding: 4px 8px; font-weight:bold; border-radius:8px;"><?php echo $qtdAtual; ?> recebida(s)</span></p>
        
        <hr style="border: 0; height: 1px; background: #e2e8f0; margin-bottom: 20px;">
        
        <form action="operacao_salvar_gestao.php" method="POST">
            <input type="hidden" name="id_escoteiro" value="<?php echo $id_escoteiro; ?>">
            <input type="hidden" name="numero_notificacao" value="<?php echo $sugestaoProxima; ?>">

            <div class="form-group">
                <label style="font-weight: bold; color: #6b46c1;">Gatilho Sugerido pelo Sistema:</label>
                <div style="background: #eedffc; padding: 12px 15px; border-radius: 8px; margin-top: 5px; font-weight: bold; color: #6b46c1;">
                    📢 <?php echo $avisoConfigurado['tipo']; ?>
                    <input type="hidden" name="tipo" value="<?php echo $avisoConfigurado['tipo']; ?>">
                </div>
            </div>
            
            <div class="form-group" style="margin-top: 15px;">
                <label style="font-weight: bold;">Mensagem de Aviso</label>
                <textarea name="mensagem" class="form-control" rows="5" required><?php echo $avisoConfigurado['texto']; ?></textarea>
                <small style="color: #718096; display: block; margin-top: 5px;">* O texto acima foi adaptado ao histórico do escoteiro, mas você pode editá-lo antes de salvar.</small>
            </div>
            
            <div style="margin-top: 25px; display: flex; gap: 10px;">
                <button type="submit" class="btn btn-primary">Enviar Notificação</button>
                <a href="../ESCOTEIRO/tabela_escoteiro.php" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
</div>

<script src="/escoteiro/VIEW/js/javascript.js"></script>
</body>
</html>