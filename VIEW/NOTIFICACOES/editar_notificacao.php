<?php 

$id = $_GET['id'] ?? null;

include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/VIEW/shared_nav.php";  
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/notificacoes.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/notificacoes.php";

$pdo = Conexao::getConexao();
$stmt = $pdo->prepare("SELECT * FROM notificacoes WHERE id_notificacao = ?");
$stmt->execute([(int)$id]);
$dados = $stmt->fetch();

$notificacao = null;
if ($dados) {
    $notificacao = new MODEL\Notificacoes(
        $dados['id_notificacao'],
        $dados['tipo'],
        $dados['mensagem'],
        $dados['data_envio'],
        $dados['id_escoteiro']
    );
}
?>

<div class="container">
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <div class="card-title">Editar Ficha de Notificação</div>
        
        <?php if ($notificacao): ?>
        <form action="operacao_editar_notificacao.php" method="POST">
            <input type="hidden" name="id_notificacao" value="<?php echo $notificacao->getIdNotificacao(); ?>">
            
            <div class="form-group">
                <label>Tipo de Mensagem</label>
                <input type="text" name="tipo" value="<?php echo $notificacao->getTipo(); ?>" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Mensagem de Aviso</label>
                <textarea name="mensagem" class="form-control" rows="4" required><?php echo $notificacao->getMensagem(); ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Atualizar Notificação</button>
            <a href="tabela_notificacao.php" class="btn btn-secondary" style="margin-left: 10px;">Voltar</a>
        </form>
        <?php else: ?>
            <p class="text-danger">Notificação não encontrada para edição.</p>
            <a href="tabela_notificacao.php" class="btn btn-secondary">Voltar para a Lista</a>
        <?php endif; ?>
   </div> 
</div>

<script src="/escoteiro/VIEW/js/javascript.js"></script>
</body>
</html>