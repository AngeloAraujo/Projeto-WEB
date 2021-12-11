<!DOCTYPE html>
<?php
include_once "acaomotorista.php";
include 'connect/connect.php';
$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
$dados;
if ($acao == 'editar'){
    $codigo = isset($_GET['id_motorista']) ? $_GET['id_motorista'] : "";
    if ($codigo > 0)
        $dados = buscarDados($codigo);
}
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de Motoristas</title>
</head>
<body>
<br>
<a href="listarmotorista.php"><button>Listar</button></a>
<a href="cadmotorista.php"><button>Novo</button></a>
<br><br>
<form action="acaomotorista.php" method="post">
    <input readonly  type="number" name="id_motorista" id="id_motorista" value="<?php if ($acao == "editar") echo $dados['id_motorista']; else echo 0; ?>"><br>
    <br>Nome do Motorista: <br>
    <input required=true   type="text" name="nome" id="nome" value="<?php if ($acao == "editar") echo $dados['nome']; ?>"><br>
    <br>CPF<br>
    <input required=true   type="number" name="cpf" id="cpf" value="<?php if ($acao == "editar") echo $dados['cpf']; ?>"><br>
    <br>Cidade: <br>
    <input required=true   type="text" name="cidade" id="cidade" value="<?php if ($acao == "editar") echo $dados['cidade']; ?>"><br>
    <br>Bairro: <br>
    <input required=true   type="text" name="bairro" id="bairro" value="<?php if ($acao == "editar") echo $dados['bairro']; ?>"><br>
    <br>Rua:<br> 
    <input required=true   type="text" name="rua" id="rua" value="<?php if ($acao == "editar") echo $dados['rua']; ?>"><br>
    <br>Número:<br> 
    <input required=true   type="text" name="numero" id="numero" value="<?php if ($acao == "editar") echo $dados['numero']; ?>"><br>
    <br><button type="submit" name="acao" id="acao" value="salvar">Salvar</button>
</form>
</body>
</html>