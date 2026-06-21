<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/VIEW/shared_nav.php";  
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";

$pdo = Conexao::getConexao();

$atividades = $pdo->query("SELECT * FROM atividades ORDER BY data_atividade DESC")->fetchAll();
$chefes = $pdo->query("SELECT * FROM chefes_voluntarios ORDER BY nome ASC")->fetchAll();
?>

<div class="container">
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <div class="card-title">Alocar Chefe/Voluntário em Atividade</div>
        
        <form action="operacao_vincular_chefe.php" method="POST">
            <div class="form-group">
                <label>Selecione a Atividade</label>
                <select name="id_atividade" class="form-control" required>
                    <option value="">-- Escolha uma Atividade --</option>
                    <?php foreach($atividades as $atv): ?>
                        <option value="<?php echo $atv['id_atividade']; ?>">
                            <?php echo date('d/m/Y', strtotime($atv['data_atividade'])); ?> - <?php echo $atv['tipo']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Selecione o Chefe / Voluntário</label>
                <select name="id_voluntario" class="form-control" required>
                    <option value="">-- Escolha o Voluntário --</option>
                    <?php foreach($chefes as $c): ?>
                        <option value="<?php echo $c['id_voluntario']; ?>">
                            <?php echo $c['nome']; ?> (<?php echo $c['cargo'] ?? 'Voluntário'; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Confirmar Escala</button>
            <a href="tabela_atividades.php" class="btn btn-secondary" style="margin-left: 10px;">Voltar</a>
        </form>
    </div>
</div>

<script src="/escoteiro/VIEW/js/javascript.js"></script>
</body>
</html>