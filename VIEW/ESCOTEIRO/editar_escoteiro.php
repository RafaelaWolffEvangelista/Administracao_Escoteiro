<?php 

$id = $_GET['id'] ?? null;


include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/VIEW/shared_nav.php";  
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/escoteiros.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/escoteiro.php";


$dalEscoteiros = new EscoteiroDAL();
$escoteiro = $dalEscoteiros->findById((int)$id);
?>

<div class="container">
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <div class="card-title">Editar Ficha do Escoteiro</div>
        
        <?php if ($escoteiro): ?>
        <form action="operacao_editar_escoteiro.php" method="POST">
            <input type="hidden" name="id_escoteiro" value="<?php echo $escoteiro->getIdEscoteiro(); ?>">
            
            <div class="form-group">
                <label>Nome Completo</label>
                <input type="text" name="nome" value="<?php echo $escoteiro->getNome(); ?>" class="form-control" oninput="validarApenasLetras(this)" required>
            </div>
            <div class="form-group">
                <label>Data de Nascimento</label>
                <input type="date" name="data_nascimento" value="<?php echo $escoteiro->getDataNascimento(); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Nome do Responsável</label>
                <input type="text" name="nome_responsavel" value="<?php echo $escoteiro->getNomeResponsavel(); ?>" class="form-control" oninput="validarApenasLetras(this)" required>
            </div>
            <div class="form-group">
                <label>Telefone do Responsável</label>
                <input type="text" name="telefone_responsavel" value="<?php echo $escoteiro->getTelefoneResponsavel(); ?>" class="form-control" oninput="validarApenasNumeros(this)" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="Pago" <?php echo $escoteiro->getStatus() == 'Pago' ? 'selected' : ''; ?>>Pago</option>
                    <option value="Pendente" <?php echo $escoteiro->getStatus() == 'Pendente' ? 'selected' : ''; ?>>Pendente</option>
                    <option value="Atrasado" <?php echo $escoteiro->getStatus() == 'Atrasado' ? 'selected' : ''; ?>>Atrasado</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar Dados</button>
        </form>
        <?php else: ?>
            <p class="text-danger">Escoteiro não encontrado para edição.</p>
        <?php endif; ?>
   </div> 
</div>

<script src="/escoteiro/VIEW/js/javascript.js"></script>
</body>
</html>