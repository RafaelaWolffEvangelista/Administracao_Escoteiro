<?php
$id = $_GET['id'] ?? null;

include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/VIEW/shared_nav.php";  
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/chefes_voluntario.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/chefes.php";

$dalChefes = new ChefesVoluntariosDAL();
$chefe = $dalChefes->findById((int)$id);
?>
<div class="container">
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <div class="card-title">Editar Voluntário</div>
        
        <?php if ($chefe): ?>
        <form action="operacao_editar_chefes.php" method="POST">
            <input type="hidden" name="id_voluntario" value="<?php echo $chefe->getIdVoluntario(); ?>">
            
            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="nome" value="<?php echo $chefe->getNome(); ?>" class="form-control" oninput="validarApenasLetras(this)" required>
            </div>
            <div class="form-group">
                <label>Função</label>
                <input type="text" name="funcao" value="<?php echo $chefe->getFuncao(); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Telefone</label>
                <input type="text" name="telefone" value="<?php echo $chefe->getTelefone(); ?>" class="form-control" oninput="validarApenasNumeros(this)">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="Ativo" <?php echo $chefe->getStatus() === 'Ativo' ? 'selected' : ''; ?>>Ativo</option>
                    <option value="Inativo" <?php echo $chefe->getStatus() === 'Inativo' ? 'selected' : ''; ?>>Inativo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
        <?php else: ?>
            <p class="text-danger">Voluntário não encontrado para edição.</p>
        <?php endif; ?>
    </div>
</div>

<script src="/escoteiro/VIEW/js/javascript.js"></script>
</body>
</html>