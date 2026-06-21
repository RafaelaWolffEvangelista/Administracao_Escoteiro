<?php 

   include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/VIEW/shared_nav.php"; 

?>
<div class="container">
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <div class="card-title">Novo Cadastro de Escoteiro</div>
        <form action="operacao_inserir_escoteiro.php" method="POST">
            <div class="form-group">
                <label>Nome Completo *</label>
                <input type="text" name="nome" class="form-control" oninput="validarApenasLetras(this)" required>
            </div>
            <div class="form-group">
                <label>Data de Nascimento *</label>
                <input type="date" name="data_nascimento" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Nome do Responsável *</label>
                <input type="text" name="nome_responsavel" class="form-control" oninput="validarApenasLetras(this)" required>
            </div>
            <div class="form-group">
                <label>Telefone do Responsável *</label>
                <input type="text" name="telefone_responsavel" class="form-control" oninput="validarApenasNumeros(this)" required>
            </div>
            <div class="form-group">
                <label>Recebe Bolsa Família?</label>
                <select name="bolsa_familia" class="form-control">
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>
            </div>
            <div class="form-group">
                <label>Status *</label>
                <select name="status" class="form-control">
                    <option value="Pago">Pago</option>
                    <option value="Pendente">Pendente</option>
                    <option value="Atrasado">Atrasado</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Cadastro</button>
        </form>
   </div> 
</div>
<script src="/escoteiro/VIEW/js/javascript.js"></script>
</body>
</html>