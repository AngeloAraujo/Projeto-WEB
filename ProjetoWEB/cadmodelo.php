<!DOCTYPE html>
<?php
$title = "Cadastro de Produtos";
include 'connect/connect.php';
include_once "acaomodelo.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
$dados;
if ($acao == 'editar'){
    $codigo = isset($_GET['id_modelo']) ? $_GET['id_modelo'] : "";
    if ($codigo > 0)
        $dados = buscarDados($codigo);
}
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<br>
<a href="listarmodelo.php"><button>Listar</button></a>
<a href="cadmodelo.php"><button>Novo</button></a>
<br><br>
<form action="acaomodelo.php" method="post">
    <input readonly  type="text" name="id_modelo" id="id_modelo" value="<?php if ($acao == "editar") echo $dados['id_modelo']; else echo 0; ?>"><br>
    Modelo do veículo: 
    <input required=true   type="text" name="descricao" id="descricao" value="<?php if ($acao == "editar") echo $dados['descricao']; ?>"><br>
    Consumo do veiculo Km/Litros:
    <input required=true   type="text" name="consumo" id="consumo" value="<?php if ($acao == "editar") echo $dados['descricao']; ?>"><br>
    Tamanho do tanque de combustível do modelo
    <input required=true   type="text" name="tanque" id="tanque" value="<?php if ($acao == "editar") echo $dados['tanque']; ?>"><br>
    <br><button type="submit" name="acao" id="acao" value="salvar">Salvar Veiculo</button>
</form>
</body>
</html>