<?php

   include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/VIEW/shared_nav.php"; 

?>
<div class="container">
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <div class="card-title">Cadastrar Chefe Voluntário</div>
        <form action="operacao_inserir_chefes.php" method="POST">
            <div class="form-group">
                <label>Nome do Chefe</label>
                <input type="text" name="nome" class="form-control" oninput="validarApenasLetras(this)" required>
            </div>
            <div class="form-group">
                <label>Função (ex: Chefe de Tropa, Tesoureiro)</label>
                <input type="text" name="funcao" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Telefone</label>
                <input type="text" name="telefone" class="form-control" oninput="validarApenasNumeros(this)">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="Ativo">Ativo</option>
                    <option value="Inativo">Inativo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Voluntário</button>
        </form>
    </div>
</div>
</body>
</html>