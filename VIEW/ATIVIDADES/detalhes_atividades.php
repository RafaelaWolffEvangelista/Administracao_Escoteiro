<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/VIEW/shared_nav.php";  

$id = $_GET['id'] ?? null;

include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/atividade.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/atividade.php";

use MODEL\Atividades;

$dalAtividade = new AtividadesDAL();
$atividade = $dalAtividade->findById($id);
?>
<div class="container">
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <div class="card-title">Detalhes da Atividade / Evento</div>
        <hr style="border: 0; height: 1px; background: #e2e8f0; margin-bottom: 20px;">
        
        <?php if ($atividade): ?>
        <div class="form-group">
            <p><strong>Data do Evento:</strong> <?php echo date('d/m/Y', strtotime($atividade->getDataAtividade())); ?></p>
        </div>
        <div class="form-group">
            <p><strong>Tipo de Atividade:</strong> <span class="badge" style="background:#eae6ff; color:#4c3f91; font-size: 0.9rem;"><?php echo $atividade->getTipo(); ?></span></p>
        </div>
        <div class="form-group">
            <p><strong>Descrição / Programação:</strong></p>
            <div style="background: #f8fafc; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0; margin-top: 5px; white-space: pre-wrap;"><?php echo $atividade->getDescricao() ? $atividade->getDescricao() : 'Nenhuma descrição detalhada informada.'; ?></div>
        </div>
        <?php else: ?>
            <p class="text-danger">Atividade não encontrada.</p>
        <?php endif; ?>
        
        <div class="form-group" style="margin-top: 20px; background: #f0fdf4; padding: 12px; border-radius: 8px; border: 1px solid #bbf7d0;">
            <p style="color: #166534; font-size: 0.9rem;">
                <strong>Relatório de Presença:</strong><br>
                Esta atividade conta com a participação dos escoteiros ativos escalados e acompanhamento da chefia de tropa responsável.
            </p>
        </div>

        <br>
        <div style="display: flex; gap: 10px;">
            <a href="editar_atividades.php?id=<?php echo $atividade ? $atividade->getIdAtividade() : ''; ?>" class="btn btn-primary">Editar Evento</a>
            <a href="tabela_atividades.php" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>

<script src="/escoteiro/VIEW/js/javascript.js"></script>
</body>
</html>