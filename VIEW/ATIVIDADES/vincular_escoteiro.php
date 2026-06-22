<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/VIEW/shared_nav.php";  
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/escoteiros.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";

use DAL\EscoteiroDAL;

$escDAL = new EscoteiroDAL();
$escoteiros = $escDAL->selectAll();

$pdo = Conexao::getConexao();
$atividades = $pdo->query("SELECT * FROM atividades ORDER BY data_atividade DESC")->fetchAll();
?>

<div class="container">
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <div class="card-title">Inscrever Escoteiro em Atividade</div>
        
        <form action="operacao_vincular_escoteiro.php" method="POST">
            <div class="form-group">
                <label>Selecione a Atividade Coletiva</label>
                <select name="id_atividade" class="form-control" required>
                    <option value="">-- Escolha uma Atividade Disponível --</option>
                    <?php foreach($atividades as $atv): ?>
                        <option value="<?php echo $atv['id_atividade']; ?>">
                            <?php echo date('d/m/Y', strtotime($atv['data_atividade'])); ?> - <?php echo $atv['tipo']; ?> (<?php echo $atv['descricao']; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Selecione o Escoteiro</label>
                <select name="id_escoteiro" class="form-control" required>
                    <option value="">-- Escolha o Membro do Grupo --</option>
                    <?php foreach($escoteiros as $e): ?>
                        <option value="<?php echo $e['id_escoteiro']; ?>">
                            <?php echo $e['nome']; ?> (Status: <?php echo $e['status']; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Confirmar Inscrição</button>
            <a href="tabela_atividades.php" class="btn btn-secondary" style="margin-left: 10px;">Voltar</a>
        </form>
    </div>
</div>

<script src="/escoteiro/VIEW/js/javascript.js"></script>
</body>
</html>