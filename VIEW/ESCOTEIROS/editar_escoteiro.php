<?php
$id = $_GET['id'];
//    echo $id; 
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/VIEW/menu.php";  
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/escoteiro.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/escoteiro.php";

use DAL\Escoteiro;

$escoteiro = new \MODEL\escoteiro();
$escoteiro->setNomeCompleto($_POST['txtNome']);
$escoteiro->setDataNascimento($_POST['txtDataNasc']);
$escoteiro->setNomeResponsavel($_POST['txtResponsavel']);
// Tratamento de checkbox para boolean
$escoteiro->setBolsaFamilia(isset($_POST['chkBolsa']) ? true : false); 
$escoteiro->setStatus("Ativo");

$dalEscoteiro = new DAL\Escoteiro();
$escoteiro = $dalEscoteiro->SelectById($id);

echo $escoteiro->getNomeCompleto();
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
    <title>Editar Escoteiro</title>
</head>

<body class="teal lighten-4">
    <div class="container deep-orange lighten-1 col s12 ">
        <div class="center light-blue darken-3 white-text col s12">
            <h3>Editar Escoteiro</h3>
        </div>


        <div class="row grey lighten-2 black-text">
            <form action="operacao_editar_escoteiro.php" method="post" class="row">
                <div class="input-field col s8">
                    <label for="id" class="black-text bold">ID: <?php echo $escoteiro->getID() ?>
                    </label>
                    </br></br>
                    <input type="hidden" name="id" value=<?php echo $id; ?>>
                </div>

                <div class="input-field col s8">
                    <input placeholder="Informar o nome do escoteiro" id="nome"
                        name="nome" type="text" class="validate"
                        value="<?php echo $escoteiro->getNomeCompleto(); ?>">
                    <label for="nomelabel">Nome: </label>
                </div>

                <div class="input-field col s8">
                    <input placeholder="Informar a data de nascimento" id="data_nascimento"
                        name="data_nascimento" type="text" class="validate"
                        value="<?php echo $escoteiro->getDataNascimento(); ?>">
                    <label for="data_nascimentolabel">Data de Nascimento: </label>
                </div>

                <div class="input-field col s8">
                    <input placeholder="Informar o nome do responsável" id="nome_responsavel"
                        name="nome_responsavel" type="text" class="validate"
                        value="<?php echo $escoteiro->getNomeResponsavel(); ?>">
                    <label for="nome_responsavelabel">Nome do Responsável: </label>
                </div>

                <div class="input-field col s8">
                    <input placeholder="Informar se possui bolsa familiar" id="bolsa_familia"
                        name="bolsa_familia" type="text" class="validate"
                        value="<?php echo $escoteiro->getBolsaFamilia(); ?>">
                    <label for="bolsa_familialabel">Bolsa Familia: </label>
                </div>

                <div class="row center col s8">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Salvar
                        <i class="material-icons right">send</i>
                    </button>

                    <a class="waves-effect waves-light blue btn"
                        onclick="JavaScript:location.href='tabela_escoteiros.php'">
                        <i class="material-icons right">arrow_back</i>Voltar
                    </a>
                </div>
            </form>


        </div>
        <br />

    </div>
</body>

</html>