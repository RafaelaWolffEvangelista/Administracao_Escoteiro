<?php 
   include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/VIEW/shared_nav.php"; 
?>
<div class="container">
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <div class="card-title">Criar Atividade/Acampamento</div>
        <form action="operacao_inserir_atividades.php" method="POST">
            <div class="form-group">
                <label>Data do Evento</label>
                <input type="date" name="data_atividade" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tipo de Atividade</label>
                <input type="text" name="tipo" placeholder="Ex: Acampamento, Reunião Sede" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Descrição Completa</label>
                <textarea name="descricao" class="form-control" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Agendar Evento</button>
        </form>
    </div>
</div>

<script src="/escoteiro/VIEW/js/javascript.js"></script>
</body>
</html>