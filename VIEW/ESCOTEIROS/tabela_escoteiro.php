<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/escoteiro.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/escoteiro.php";
//include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/VIEW/menu.php";

use DAL\escoteiro;

$dalescoteiro = new DAL\escoteiro();

if (isset($_GET['busca_nome']) && !empty($_GET['busca_nome'])) {
    $termo = $_GET['busca_nome'];
    $tabela_escoteiro = $dalescoteiro->SelectByNome($termo);
} else {
    $termo = "";
    $tabela_escoteiro = $dalescoteiro->Select();
}


?>



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
    <title>Listar Escoteiros</title>
</head>

<body class="teal lighten-4">
    <div>
        <h1>Listar Escoteiros</h1>

        <div class="row lime lighten-3 black-text">
            <form action="tabela_escoteiro.php" method="get" class="col s12">
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
                <th>NOME_COMPLETO</th>
                <th>DATA_NASCIMENTO</th>
                <th>NOME_RESPONSAVEL</th>
                <th>BOLSA_FAMILIA</th>
                <th> <a class="btn-floating btn-small waves-effect waves-light green">
                        <i class="material-icons"
                            onclick="JavaScript:location.href='inserir_escoteiro.php'">add</i>
                    </a></th>
            </tr>
            <?php
            foreach ($tabela_escoteiro as $escoteiro) { ?>
                <tr>
                    <td><?php echo $escoteiro->getId(); ?></td>
                    <td><?php echo $escoteiro->getNomeCompleto(); ?></td>
                    <td><?php echo $escoteiro->getDataNascimento(); ?></td>
                    <td><?php echo $escoteiro->getNomeResponsavel(); ?></td>
                    <td><?php echo $escoteiro->getBolsa_familia() ? 'Sim' : 'Não'; ?></td>
                    <td>
                        <a class="btn-floating btn-small waves-effect orange">
                            <i class="material-icons"
                                onclick="JavaScript:location.href='editar_escoteiro.php?id='+ '<?php echo $escoteiro->getId(); ?>'">edit</i>
                        </a>

                        <a class="btn-floating btn-small waves-effect blue">
                            <i class="material-icons"
                                onclick="JavaScript:location.href='detalhes_escoteiro.php?id= ' + '<?php echo $escoteiro->getId(); ?>'">details</i>
                        </a>

                        <a class="btn-floating btn-small waves-effect red">
                            <i class="material-icons"
                                onclick="JavaScript: remover( <?php echo $escoteiro->getId(); ?> )">delete</i>
                        </a>

                    </td>
                </tr>

            <?php  } ?>
        </table>

    </div>
</body>

</html>

<script>
    function remover(id) {
        if (confirm('Excluir Escoteiro ' + id + '?')) {
            location.href = 'operacao_remover_escoteiro.php?id=' + id;
        }
    }
</script>