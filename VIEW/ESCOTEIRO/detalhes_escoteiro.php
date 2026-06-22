<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/VIEW/shared_nav.php";  
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/escoteiros.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/escoteiro.php";

use DAL\EscoteiroDAL;

$id_escoteiro = $_GET['id'] ?? null;

if (!$id_escoteiro) {
    echo "<div class='container'><div class='card'><p class='text-danger' style='font-weight:bold;'>Erro: Nenhum escoteiro foi selecionado.</p><br><a href='tabela_escoteiro.php' class='btn btn-secondary'>Voltar para a Listagem</a></div></div>";
    exit();
}

$dalEscoteiros = new EscoteiroDAL();
$pdo = Conexao::getConexao();

$stmt = $pdo->prepare("
    SELECT e.*, 
           (SELECT COUNT(*) FROM notificacoes n WHERE n.id_escoteiro = e.id_escoteiro) as total_notificacoes
    FROM escoteiros e 
    WHERE e.id_escoteiro = ?
");
$stmt->execute([(int)$id_escoteiro]);
$escoteiro = $stmt->fetch();

if (!$escoteiro) {
    echo "<div class='container'><div class='card'><p class='text-danger'>Escoteiro não encontrado no sistema.</p><br><a href='tabela_escoteiro.php' class='btn btn-secondary'>Voltar</a></div></div>";
    exit();
}

$atividadesCount = $dalEscoteiros->contarAtividadesParticipando($id_escoteiro);

$stmtNotif = $pdo->prepare("SELECT * FROM notificacoes WHERE id_escoteiro = ? ORDER BY data_envio DESC");
$stmtNotif->execute([(int)$id_escoteiro]);
$historicoNotificacoes = $stmtNotif->fetchAll();

$statusText = !empty($escoteiro['status']) ? $escoteiro['status'] : 'Pendente';
$badgeClass = (strtolower($statusText) === 'pago') ? 'background: #28a745; color: white;' : ((strtolower($statusText) === 'atrasado') ? 'background: #e53e3e; color: white;' : 'background: #dd6b20; color: white;');
?>

<div class="container">
    <div class="card" style="max-width: 800px; margin: 0 auto;">
        <div class="card-title" style="display: flex; justify-content: space-between; align-items: center;">
            <span>🔍 Ficha Cadastral do Escoteiro</span>
            <span class="badge" style="<?php echo $badgeClass; ?> font-size: 14px; padding: 6px 12px; border-radius: 12px;">
                Status: <?php echo $statusText; ?>
            </span>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
            <div style="background: #f7fafc; padding: 15px; border-radius: 8px; border-left: 4px solid #6b46c1;">
                <h3 style="margin-top: 0; color: #6b46c1; font-size: 16px;">Dados do Escoteiro</h3>
                <p style="margin: 8px 0;"><strong>Código ID:</strong> #<?php echo $escoteiro['id_escoteiro']; ?></p>
                <p style="margin: 8px 0;"><strong>Nome Completo:</strong> <?php echo $escoteiro['nome']; ?></p>
                <p style="margin: 8px 0;"><strong>Engajamento:</strong> <span class="badge" style="background:#ddd; color:black;"><?php echo $atividadesCount; ?> atividade(s) inscrita(s)</span></p>
            </div>

            <div style="background: #f7fafc; padding: 15px; border-radius: 8px; border-left: 4px solid #4a5568;">
                <h3 style="margin-top: 0; color: #4a5568; font-size: 16px;">Contato do Responsável</h3>
                <p style="margin: 8px 0;"><strong>Nome do Responsável:</strong> <?php echo $escoteiro['nome_responsavel']; ?></p>
                <p style="margin: 8px 0;"><strong>Telefone/WhatsApp:</strong> <?php echo $escoteiro['telefone_responsavel']; ?></p>
                <p style="margin: 8px 0;"><strong>Total de Alertas:</strong> ✉️ <?php echo $escoteiro['total_notificacoes']; ?> aviso(s) emitido(s)</p>
            </div>
        </div>

        <hr style="border: 0; height: 1px; background: #e2e8f0; margin: 30px 0;">

        <div class="historico-secao">
            <h3 style="color: #6b46c1; margin-bottom: 15px;">📋 Histórico de Notificações de Cobrança</h3>
            
            <?php if (count($historicoNotificacoes) > 0): ?>
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <?php foreach($historicoNotificacoes as $notif): ?>
                        <div style="background: #eedffc; padding: 12px 15px; border-radius: 8px; border-left: 4px solid #6b46c1;">
                            <div style="display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 5px; color: #4a5568;">
                                <strong>📢 <?php echo $notif['tipo']; ?></strong>
                                <span>📅 <?php echo date('d/m/Y H:i', strtotime($notif['data_envio'])); ?></span>
                            </div>
                            <p style="margin: 0; font-style: italic; color: #2d3748; font-size: 14px;">
                                "<?php echo htmlspecialchars($notif['mensagem']); ?>"
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div style="text-align: center; color: #718096; padding: 15px; background: #f7fafc; border-radius: 8px;">
                    Nenhum aviso ou alerta de cobrança foi emitido para este escoteiro até o momento.
                </div>
            <?php endif; ?>
        </div>

        <div style="margin-top: 30px; display: flex; gap: 10px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
            <a href="tabela_escoteiro.php" class="btn btn-secondary">Voltar para Listagem</a>
            <a href="editar_escoteiro.php?id=<?php echo $escoteiro['id_escoteiro']; ?>" class="btn btn-primary">✏️ Editar Cadastro</a>
            
        </div>
    </div>
</div>

<script src="/escoteiro/VIEW/js/javascript.js"></script>
</body>