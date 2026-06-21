<<<<<<< HEAD
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/chefes_voluntario.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/chefes.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/VIEW/menu.php";

use DAL\chefes;

$dalChefe = new DAL\chefes();

if (isset($_GET['busca_nome']) && !empty($_GET['busca_nome'])) {
    $termo = $_GET['busca_nome'];
    $lstChefe = $dalChefe->SelectByNome($termo);
} else {
    $termo = "";
    $lstChefe = $dalChefe->Select();
=======
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
>>>>>>> 1ac9520514872f6f5a4d099ee0e7f9d12f2b68ef
}
?>
<<<<<<< HEAD



<!DOCTYPE html>
<html lang="pt-br">

<head>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- Usado para adicionar ícones -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Chefes</title>
</head>

<body class="teal lighten-4">
    <div>
        <h1>Listar Chefes Voluntários</h1>

        <div class="row lime lighten-3 black-text">
            <form action="tabela_chefes.php" method="get" class="col s12">
                <div class="input-field col s12">
                    <input id="search" type="search" name="busca_nome" class="col s6">
                    <label for="icon_prefix"> Filtrar por nome...</label>
                    <button class="btn waves-effect waves-light" type="submit" name="action">Filtrar
                        <i class="material-icons right">search</i>
                    </button>
                </div>
            </form>
        </div>

        <table class="striped responsive-table hover: lime lighten-3">
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>FUNÇÃO</th>
                <th>TELEFONE</th>
                <th>STATUS</th>
            </tr>
            <?php
            foreach ($lstChefe as $chefe) { ?>
                <tr>
                    <td><?php echo $chefe->getId(); ?></td>
                    <td><?php echo $chefe->getNome(); ?></td>
                    <td><?php echo $chefe->getRamo(); ?></td>
                    <td><?php echo $chefe->getTelefone(); ?></td>
                    <td><?php echo $chefe->getStatus(); ?></td>
                </tr>

            <?php  } ?>
        </table>

=======
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
                            <a href="detalhes_chefes.php?id=<?php echo $c['id_voluntario']; ?>" class="btn btn-secondary">🔍</a>
                            <a href="editar_chefes.php?id=<?php echo $c['id_voluntario']; ?>" class="btn btn-primary">✏️</a>
                            <a href="operacao_remover_chefes.php?id=<?php echo $c['id_voluntario']; ?>" class="btn btn-danger" onclick="return confirm('Excluir?')">🗑️</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
>>>>>>> 1ac9520514872f6f5a4d099ee0e7f9d12f2b68ef
    </div>
</div>

<script src="/escoteiro/VIEW/js/javascript.js"></script>
</body>
<<<<<<< HEAD

=======
>>>>>>> 1ac9520514872f6f5a4d099ee0e7f9d12f2b68ef
</html>