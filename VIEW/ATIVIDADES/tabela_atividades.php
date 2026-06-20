<?php 
// 1. Inclui o menu unificado correto que carrega o CSS roxo e lilás
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/VIEW/shared_nav.php";  
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";

// CORREÇÃO DA QUERY: Calcula em tempo real o total de jovens e o total de adultos escalados
$pdo = Conexao::getConexao();
$query = "
    SELECT a.*, 
        (SELECT COUNT(*) FROM atividade_escoteiro ae WHERE ae.id_atividade = a.id_atividade) as total_escoteiros,
        (SELECT COUNT(*) FROM atividade_chefe ac WHERE ac.id_atividade = a.id_atividade) as total_chefes
    FROM atividades a 
    ORDER BY a.data_atividade DESC
";
$atividades = $pdo->query($query)->fetchAll();
?>

<div class="container">
    <div class="card">
        <div class="card-title">Programação de Atividades Coletivas</div>
        
        <div style="margin-bottom: 20px; display: flex; gap: 10px;">
            <a href="inserir_atividades.php" class="btn btn-primary">+ Nova Atividade</a>
            <a href="vincular_escoteiro.php" class="btn btn-secondary">Inscrever Escoteiro</a>
            <a href="vincular_chefe.php" class="btn btn-secondary">Escalar Chefe</a>
        </div>
        
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Tipo</th>
                        <th>Descrição</th>
                        <th>Escoteiros</th> 
                        <th>Equipe de Chefes</th> <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($atividades) > 0): ?>
                        <?php foreach($atividades as $atv): ?>
                        <tr>
                            <td><?php echo date('d/m/Y', strtotime($atv['data_atividade'])); ?></td>
                            <td><span class="badge" style="background: #eedffc; color: #6b46c1; font-weight: bold;"><?php echo $atv['tipo']; ?></span></td>
                            <td><?php echo $atv['descricao']; ?></td>
                            
                            <td>
                                <span class="badge" style="background: #6b46c1; color: white; padding: 6px 12px; border-radius: 12px; font-weight: bold;">
                                    <?php echo $atv['total_escoteiros']; ?> Escoteiro(s)
                                </span>
                            </td>

                            <td>
                                <span class="badge" style="background: #4a5568; color: white; padding: 6px 12px; border-radius: 12px; font-weight: bold;">
                                    <?php echo $atv['total_chefes']; ?> Chefe(s)
                                </span>
                            </td>
                            
                            <td>
                                <a href="detalhes_atividades.php?id=<?php echo $atv['id_atividade']; ?>" class="btn btn-secondary" style="padding: 4px 8px;">🔍</a>
                                <a href="editar_atividades.php?id=<?php echo $atv['id_atividade']; ?>" class="btn btn-primary" style="padding: 4px 8px;">✏️</a>
                                <a href="operacao_remover_atividades.php?id=<?php echo $atv['id_atividade']; ?>" class="btn btn-danger" style="padding: 4px 8px;" onclick="return confirm('Tem certeza que deseja remover esta atividade?')">🗑️</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center; color: #718096; padding: 20px;">
                                Nenhuma atividade agendada no momento.
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