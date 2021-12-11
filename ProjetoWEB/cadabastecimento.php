<!DOCTYPE html>
<?php 
    $title = "Cadastro de Produtos";
    include 'connect/connect.php';
    include 'acaoabastecimento.php';
    include  "menu.php" ;
    $acao = '';
    $id = '';
    $dados;
    if (isset($_GET["acao"]))
        $acao = $_GET["acao"];
    if ($acao == "editar"){
        if (isset($_GET["id_abastecimento"])){
            $codigo = $_GET["id_abastecimento"];
            $dados = carregaBDParaVetor($codigo);
        }
    }
?>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>        
</head>
<body>
    <a href="listarabastecimento.php"><button>Listar</button></a><br>
    
    <form action="acaoabastecimento.php" id="form" method="post">
    <input readonly  type="text" name="id_abastecimento" id="id_abastecimento" value="<?php if ($acao == "editar") echo $dados['id_abastecimento']; else echo 0; ?>"><br>
    Preco: 
    <input required=true   type="text" name="preco" id="preco" value="<?php if ($acao == "editar") echo $dados['preco']; ?>"><br> 
    Litros 
    <input required=true   type="text" name="litros" id="litros" value="<?php if ($acao == "editar") echo $dados['litros']; ?>"><br> 
    <label for="">Veiculo</label>
        <select name="veiculo" id="veiculo">
            <?php
            $sql = "SELECT * FROM veiculo;";
            #$pdo = Conexao::getInstance();
            #$consulta = $pdo->query($sql);
            $result = mysqli_query($conexao, $sql);
            #while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            while ($row = mysqli_fetch_array($result)) {
                echo '<option value="' . $row['id_veiculo'] . '"';
                if ($acao == "editar" && $dados['veiculo'] == $row['id_veiculo'])
                    echo ' selected';
                echo '>' . $row['placa'] . '</option>';
            }
            ?>
        </select>
        <button name="acao" value="salvar" id="acao" type="submit">Salvar</button>
        <br>
        
    </form>
</body>
</html>