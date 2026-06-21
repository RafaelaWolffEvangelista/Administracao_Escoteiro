<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/VIEW/shared_nav.php";  
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";

$id = $_GET['id'] ?? null;

$pdo = Conexao::getConexao();

if ($id) {
    $stmt = $pdo->prepare("SELECT n.*, e.nome as nome_escoteiro FROM notificacoes n LEFT JOIN escoteiros e ON n.id_escoteiro = e.id_escoteiro WHERE n.id_escoteiro = ? ORDER BY n.data_envio DESC");
    $stmt->execute([(int)$id]);
    $notificacoes = $stmt->fetchAll();
} else {
    $notificacoes = $pdo->query("SELECT n.*, e.nome as nome_escoteiro FROM notificacoes n LEFT JOIN escoteiros e ON n.id_escoteiro = e.id_escoteiro ORDER BY n.data_envio DESC")->fetchAll(); 
}
?>
<div class="container">
    <div class="card">
        <div class="card-title">Avisos e Cobranças de Mensalidades</div>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Data Envio</th>
                        <th>Escoteiro Relacionado</th>
                        <th>Aviso / Gatilho</th>
                        <th>Mensagem Enviada aos Responsáveis</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($notificacoes) > 0): ?>
                        <?php foreach($notificacoes as $n): ?>
                        <tr>
                            <td><?php echo date('d/m/Y H:i', strtotime($n['data_envio'])); ?></td>
                            <td><strong><?php echo $n['nome_escoteiro'] ?? 'Geral / Todos'; ?></strong></td>
                            
                            <td>
                                <span class="badge" style="background: #6b46c1; color: white; padding: 5px 10px; border-radius: 8px; font-weight: bold; font-size: 12px;">
                                    <?php echo $n['tipo']; ?>
                                </span>
                            </td>
                            
                            <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="<?php echo htmlspecialchars($n['mensagem']); ?>">
                                <em>"<?php echo $n['mensagem']; ?>"</em>
                            </td>
                            
                            <td>
                                <a href="detalhes_notificacao.php?id=<?php echo $n['id_notificacao']; ?>" class="btn btn-secondary" style="padding: 4px 8px;">🔍</a>
                                <a href="operacao_remover_notificacao.php?id=<?php echo $n['id_notificacao']; ?>" class="btn btn-danger" style="padding: 4px 8px;" onclick="return confirm('Tem certeza que deseja excluir o registro deste aviso?')">🗑️</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center; color: #718096; padding: 20px;">
                                Nenhuma notificação ou cobrança registrada no histórico.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="/escoteiro/VIEW/js/javascript.js"></script>
</body>
</html>