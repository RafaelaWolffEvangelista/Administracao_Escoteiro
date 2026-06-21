<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/VIEW/shared_nav.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/escoteiros.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/escoteiro.php";

$dalEscoteiros = new EscoteiroDAL(); 

$pdo = Conexao::getConexao();
$query = "
    SELECT e.*, 
           (SELECT COUNT(*) FROM notificacoes n WHERE n.id_escoteiro = e.id_escoteiro) as total_notificacoes
    FROM escoteiros e
    ORDER BY e.nome ASC
";
$tabela_escoteiro = $pdo->query($query)->fetchAll();
?>
<div class="container">
    <div class="card">
        <div class="card-title">Escoteiros Cadastrados</div>
        <div style="margin-bottom: 20px;">
            <a href="inserir_escoteiro.php" class="btn btn-primary">+ Novo Escoteiro</a>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Responsável</th>
                        <th>Bolsa Família</th>
                        <th>Notificações</th>
                        <th>Status Financeiro</th>
                        <th>Gestão</th> <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($tabela_escoteiro as $e): 
                        $atividadesCount = $dalEscoteiros->contarAtividadesParticipando($e['id_escoteiro']);

                        $statusText = !empty($e['status']) ? $e['status'] : 'Pendente';
                        $badgeClass = (strtolower($statusText) === 'atrasado') ? 'badge-atrasado' : 'badge-pendente';
                    ?>
                    <tr>
                        <td><?php echo $e['id_escoteiro']; ?></td>
                        <td><strong><?php echo $e['nome']; ?></strong></td>
                        <td><?php echo $e['nome_responsavel']; ?></td>
                        <td><?php echo ($e['bolsa_familia'] == 0) ? 'Sim' : 'Não'; ?></td>

                        <td>
                            <span class="badge" style="background: #eedffc; color: #6b46c1; font-weight: bold;">
                                ✉️ <?php echo $e['total_notificacoes']; ?> enviada(s)
                            </span>
                        </td>
                        
                        <td><span class="badge <?php echo $badgeClass; ?>"><?php echo $statusText; ?></span></td>
                        
                        <td>
                            <a href="/escoteiro/VIEW/NOTIFICACOES/inserir_notificacao.php?id_escoteiro=<?php echo $e['id_escoteiro']; ?>" class="btn btn-primary" style="padding: 5px 10px; font-size: 13px;">
                                Enviar Notificação
                            </a>
                        </td>
                        
                        <td>
                            <a href="detalhes_escoteiro.php?id=<?php echo $e['id_escoteiro']; ?>" class="btn btn-secondary">🔍</a>
                            <a href="editar_escoteiro.php?id=<?php echo $e['id_escoteiro']; ?>" class="btn btn-primary">✏️</a>
                            <a href="operacao_remover_escoteiro.php?id=<?php echo $e['id_escoteiro']; ?>" class="btn btn-danger" onclick="return confirm('Excluir?')">🗑️</a>
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