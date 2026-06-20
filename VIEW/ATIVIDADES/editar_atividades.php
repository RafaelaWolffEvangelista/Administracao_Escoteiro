<?php 
$id = $_GET['id'] ?? null;

include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/VIEW/shared_nav.php";  
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/atividade.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/atividade.php";

use MODEL\Atividades;

$dalAtividade = new AtividadesDAL();
$atividade = $dalAtividade->findById($id);

?>
<div class="container">
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <div class="card-title">Editar Detalhes da Atividade</div>
        
        <?php if ($atividade): ?>
        <form action="operacao_editar_atividades.php" method="POST">
            <input type="hidden" name="id_atividade" value="<?php echo $atividade->getIdAtividade(); ?>">
            
            <div class="form-group">
                <label>Data</label>
                <input type="date" name="data_atividade" value="<?php echo $atividade->getDataAtividade(); ?>" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Tipo</label>
                <input type="text" name="tipo" value="<?php echo $atividade->getTipo(); ?>" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Descrição</label>
                <textarea name="descricao" class="form-control" rows="4"><?php echo $atividade->getDescricao(); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
        <?php else: ?>
            <p class="text-danger">Registro não encontrado para edição.</p>
        <?php endif; ?>
    </div>
</div>

<script src="/escoteiro/VIEW/js/javascript.js"></script>
</body>
</html>