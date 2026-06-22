<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/VIEW/shared_nav.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/chefes_voluntario.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/chefes.php";

$dalChefes = new ChefesVoluntariosDAL(); 

if (isset($_GET['busca_nome']) && !empty($_GET['busca_nome'])) {
    $termo = $_GET['busca_nome'];
    $tabelaChefes = $dalChefes->selectAll(); 
} else {
    $termo = "";
    $tabelaChefes = $dalChefes->selectAll(); 
}
?>
<div class="container">
    <div class="card">
        <div class="card-title">Chefes e Voluntários</div>
        <div style="margin-bottom: 20px;">
            <a href="inserir_chefes.php" class="btn btn-primary">+ Novo Chefe/Voluntário</a>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Função</th>
                        <th>Telefone</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($tabelaChefes as $c): ?>
                    <tr>
                        <td><?php echo $c['id_voluntario']; ?></td>
                        <td><strong><?php echo $c['nome']; ?></strong></td>
                        <td><?php echo $c['funcao']; ?></td>
                        <td><?php echo $c['telefone']; ?></td>
                        <td><?php echo $c['status']; ?></td>
                        <td>
                            <a href="detalhes_chefes.php?id=<?php echo $c['id_voluntario']; ?>" class="btn btn-secondary" style="padding: 4px 8px;">🔍</a>
                            <a href="editar_chefes.php?id=<?php echo $c['id_voluntario']; ?>" class="btn btn-primary" style="padding: 4px 8px;">✏️</a>
                            <a href="operacao_remover_chefes.php?id=<?php echo $c['id_voluntario']; ?>" class="btn btn-danger" style="padding: 4px 8px;" onclick="return confirm('Excluir?')">🗑️</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="/escoteiro/VIEW/js/javascript.js"></script>
</body>
</html>