<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/VIEW/shared_nav.php";  

$id = $_GET['id'];

include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/escoteiros.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/escoteiro.php";

use <DAL>escoteiros;


$dalEscoteiros = new DAL/escoteiros();
$escoteiro = $dalEscoteiros->SelectById($id);

$totalAtividades = $dalEscoteiros->contarAtividadesParticipando($id);
?>

<div class="container">
    <div class="card" style="max-width: 700px; margin: 0 auto;">
        
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; border-bottom: 2px solid var(--primary-light); padding-bottom: 15px;">
            <div class="card-title" style="margin-bottom: 0;">
                <span>Ficha Cadastral do Escoteiro</span>
            </div>
            <span class="badge badge-<?php echo strtolower($escoteiro->getStatus()); ?>" style="font-size: 0.9rem; padding: 6px 12px;">
                Situação: <?php echo $escoteiro->getStatus(); ?>
            </span>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            
            <div class="form-group">
                <label style="color: #64748b; font-size: 0.85rem; text-transform: uppercase;">Nome do Membro</label>
                <p style="font-size: 1.1rem; font-weight: 600; color: var(--primary-color);">
                    <?php echo $escoteiro->getNome(); ?>
                </p>
            </div>

            <div class="form-group">
                <label style="color: #64748b; font-size: 0.85rem; text-transform: uppercase;">Data de Nascimento</label>
                <p style="font-size: 1.1rem; font-weight: 500;">
                    <?php echo date('d/m/Y', strtotime($escoteiro->getDataNascimento())); ?>
                </p>
            </div>

            <div class="form-group">
                <label style="color: #64748b; font-size: 0.85rem; text-transform: uppercase;">Responsável Legal</label>
                <p style="font-size: 1.1rem; font-weight: 500;">
                    <?php echo $escoteiro->getNomeResponsavel(); ?>
                </p>
            </div>

            <div class="form-group">
                <label style="color: #64748b; font-size: 0.85rem; text-transform: uppercase;">Telefone de Contato</label>
                <p style="font-size: 1.1rem; font-weight: 500; color: var(--accent-purple);">
                    <?php echo $escoteiro->getTelefoneResponsavel(); ?>
                </p>
            </div>

        </div>

        <hr style="border: 0; height: 1px; background: #e2e8f0; margin: 20px 0;">

        <div style="background: var(--primary-light); padding: 15px; border-radius: 8px; margin-bottom: 25px; border-left: 4px solid var(--primary-color);">
            <h4 style="color: var(--primary-color); margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                📊 Histórico e Vínculos no Grupo
            </h4>
            
            <p style="margin-bottom: 8px; font-size: 0.95rem;">
                <strong>Atividades participando:</strong> 
                <span style="background: var(--primary-color); color: white; padding: 2px 8px; border-radius: 12px; font-weight: bold; font-size: 0.85rem;">
                    <?php echo $totalAtividades; ?>
                </span>
            </p>

            <p style="font-size: 0.95rem;">
                <strong>Isenção Social (Bolsa Família):</strong> 
                <?php if ($escoteiro->getBolsaFamilia() == 1): ?>
                    <span style="color: #166534; font-weight: bold;">✔ Sim (Critério de Isenção de Taxas Ativo)</span>
                <?php else: ?>
                    <span style="color: #475569;">Não possui</span>
                <?php endif; ?>
            </p>
        </div>

        <div style="display: flex; gap: 10px; justify-content: flex-end;">
            <a href="tabela_escoteiro.php" class="btn btn-secondary">Voltar para a Lista</a>
            <a href="editar_escoteiro.php?id=<?php echo $escoteiro->getIdEscoteiro(); ?>" class="btn btn-primary">✏️ Editar Ficha</a>
        </div>
    </div>
</div>

<script src="/escoteiro/VIEW/js/javascript.js"></script>
</body>
</html>