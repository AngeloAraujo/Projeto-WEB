<!DOCTYPE html>
<?php
$title = "Cadastro de Produtos";
include 'connect/connect.php';
include 'acaorota.php';
include  "menu.php";
$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
$dados;
if ($acao == "editar") {
    $id = isset($_GET["id_rota"]) ?  $_GET["id_rota"] : "";
    if ($id > 0)
        $dados = buscarDados($id);
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
</head>

<body>
    <a href="listarrota.php"><button>Listar</button></a><br>

    <form action="acaorota.php" id="form" method="post">
        <input readonly type="text" name="id_rota" id="id_rota" value="<?php if ($acao == "editar") echo $dados['id_rota'];
                                                                        else echo 0; ?>"><br>
        Distância entre as cidades:
        <input required=true type="text" name="km" id="km" value="<?php if ($acao == "editar") echo $dados['km']; ?>"><br>
        Cidade de Origem:
        <input required=true type="text" name="origem" id="origem" value="<?php if ($acao == "editar") echo $dados['origem']; ?>"><br>
        Cidade de destino:
        <input required=true type="text" name="destino" id="destino" value="<?php if ($acao == "editar") echo $dados['destino']; ?>"><br>
        <button name="acao" value="salvar" id="acao" type="submit">Salvar</button>
        <br>

    </form>
</body>

</html>