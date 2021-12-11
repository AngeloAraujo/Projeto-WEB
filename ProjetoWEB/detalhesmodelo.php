<!DOCTYPE html>
<?php 
     include_once "conf/default.inc.php";
     require_once "conf/Conexao.php";
     $title = "Detalhes Motorista";
     $id = isset($_GET['id']) ? $_GET['id'] : "1";
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
</head>
<body>
<?php
   
    $sql = "SELECT * FROM modelo WHERE id_modelo = $id";
  
    $pdo = Conexao::getInstance(); 
    $consulta = $pdo->query($sql);
    ?>
    <table border="1">
    <thead>
    <tr><th>CÓDIGO</th>
    <th>DESCRIÇÃO</th>
    <th>CONSUMO</th>
    <th>TANQUE</th>
    </thead> 
    <tbody>
<?php
while ($linha = $consulta->fetch(PDO::FETCH_BOTH)){
    echo "<tr><td>{$linha['id_modelo']}</td>";
    echo "<td> {$linha['descricao']}</td>";
    echo "<td> {$linha['consumo']}</td>";
    echo "<td> {$linha['tanque']}</td>";
}   
?>
<form action="listarmodelo.php">
        <input type="submit" value="voltar" />
    </form>
</body>
</html>