<!DOCTYPE html>
<?php 
    $title = "Cadastro de Produtos";
    include 'connect/connect.php';
    include 'acaoviagem.php';
    include  "menu.php" ;
    $acao = '';
    $id = '';
    $dados;
    if (isset($_GET["acao"]))
        $acao = $_GET["acao"];
    if ($acao == "editar"){
        if (isset($_GET["id_viagem"])){
            $codigo = $_GET["id_viagem"];
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
    <a href="listarviagem.php"><button>Listar</button></a><br>
    
    <form action="acaoviagem.php" id="form" method="post">
    <input readonly  type="text" name="id_viagem" id="id_viagem" value="<?php if ($acao == "editar") echo $dados['id_viagem']; else echo 0; ?>"><br>
    <label for="">Motorista</label>
        <select name="motorista" id="motorista">
            <?php
            $sql = "SELECT * FROM motorista
            where motorista.id_motorista"; 
            #$pdo = Conexao::getInstance();
            #$consulta = $pdo->query($sql);
            $result = mysqli_query($conexao, $sql);
            #while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            while ($row = mysqli_fetch_array($result)) {
                echo '<option value="' . $row['id_motorista'] . '"';
                if ($acao == "editar" && $dados['id_motorista1'] == $row['id_motorista'])
                    echo ' selected';
                echo '>' . $row['nome'] . '</option>';
    
                
            }
            
            ?>
            
        </select> <br>
    <label for="">Veiculo</label>
        <select name="veiculo" id="veiculo">
            <?php
            $sql = "SELECT * FROM veiculo, modelo
            where veiculo.id_modelo = modelo.id_modelo";
            #$pdo = Conexao::getInstance();
            #$consulta = $pdo->query($sql);
            $result = mysqli_query($conexao, $sql);
            #while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            while ($row = mysqli_fetch_array($result)) {
                echo '<option value="' . $row['id_veiculo'] . '"';
                if ($acao == "editar" && $dados['id_veiculo1'] == $row['id_veiculo'])
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