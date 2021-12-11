<!DOCTYPE html>
<?php 
    $title = "Cadastro de Produtos";
    include 'connect/connect.php';
    include 'acaoveiculo.php';
    include  "menu.php" ;
    $acao = '';
    $id = '';
    $dados;
    if (isset($_GET["acao"]))
        $acao = $_GET["acao"];
    if ($acao == "editar"){
        if (isset($_GET["id_veiculo"])){
            $codigo = $_GET["id_veiculo"];
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
    <a href="listarveiculo.php"><button>Listar</button></a><br>
    
    <form action="acaoveiculo.php" id="form" method="post">
    <input readonly  type="text" name="id_veiculo" id="id_veiculo" value="<?php if ($acao == "editar") echo $dados['id_veiculo']; else echo 0; ?>"><br>
    Placa do veiculo: 
    <input required=true   type="text" name="placa" id="placa" value="<?php if ($acao == "editar") echo $dados['placa']; ?>"><br> 
    <label for="">Modelo</label>
        <select name="modelo" id="modelo">
            <?php
            $sql = "SELECT * FROM modelo;";
            #$pdo = Conexao::getInstance();
            #$consulta = $pdo->query($sql);
            $result = mysqli_query($conexao, $sql);
            #while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            while ($row = mysqli_fetch_array($result)) {
                echo '<option value="' . $row['id_modelo'] . '"';
                if ($acao == "editar" && $dados['modelo'] == $row['id_modelo'])
                    echo ' selected';
                echo '>' . $row['descricao'] . '</option>';
            }
            ?>
        </select>
        <button name="acao" value="salvar" id="acao" type="submit">Salvar</button>
        <br>
        
    </form>
</body>
</html>