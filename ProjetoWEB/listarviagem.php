 
<!DOCTYPE html>
<?php
include_once "conf/default.inc.php";
require_once "conf/Conexao.php";
?>
<html lang="pt-br">

<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url;
        }
    </script>
    <style>
        table {
            text-align: center;
            margin: 0 auto;
            border-collapse: collapse;
            border-radius: 5px;
            border-style: hidden;
            /* hide standard table (collapsed) border */
            box-shadow: 0 0 0 1px black;
            /* this draws the table border  */
        }

        tr,
        th,
        td {
            border: 1px solid black;
        }

        th {
            width: 150px;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
<?php
    include  "menu.php" ;
?>
    <a href="cadviagem.php">Nova Viagem</a><br><br>

    <form method="POST">
        <b>Consultar por: </b><br>
        <input type="radio" name="optionSearchUser" id="" value="id_viagem" required>Código<br>
        <input type="radio" name="optionSearchUser" id="" value="id_motorista" required>Motorista<br>
        <b>Ordenar por:</b><br>
        <input type="radio" name="optionOrderUser" id="" value="id_viagem" required>Código<br>
        <input type="radio" name="optionOrderUser" id="" value="id_motorista" required>Descrição<br>
        <br>
        <a href="listarviagem.php">Listar todos</a><br>
        <input type="text" name="valorUser">
        <input type="submit" value="Consultar">
    </form>
    <?php
  try {

    $optionSearchUser = isset($_POST["optionSearchUser"]) ? $_POST["optionSearchUser"] : "";
    $optionOrderUser = isset($_POST["optionOrderUser"]) ? $_POST["optionOrderUser"] : "id_viagem";
    $valorUser = isset($_POST["valorUser"]) ? $_POST["valorUser"] : "";

    $sql = ("SELECT * FROM motorista, veiculo, viagem, modelo
             WHERE viagem.id_veiculo1 = veiculo.id_veiculo
             AND veiculo.id_modelo = modelo.id_modelo
             AND viagem.id_motorista1 = motorista.id_motorista
             AND viagem.id_viagem;");
    
    /*('SELECT viagem.id_viagem , veiculo.id_veiculo, descricao, placa,id_motorista1, nome  FROM viagem, veiculo, motorista, modelo WHERE viagem.id_motorista1 = motorista.id_motorista
             And viagem.id_veiculo1 = veiculo.id_veiculo
             and viagem.id_motorista1= motorista.id_motorista
             and id_viagem');*/

    if ($optionSearchUser != "") {
        if ($optionSearchUser == "id_viagem") {
            $sql = ("SELECT viagem.id_viagem , veiculo.id_veiculo, descricao, placa,id_motorista1, nome  FROM viagem, veiculo, motorista, modelo WHERE viagem.id_motorista1 = motorista.id_motorista
            And viagem.id_veiculo1 = veiculo.id_veiculo
            and id_viagem = $valorUser ORDER BY $optionOrderUser;"); 
        }elseif ($optionSearchUser == "id_motorista") {
            $sql =("SELECT viagem.id_viagem , veiculo.id_veiculo, descricao, placa,id_motorista1, nome  FROM viagem, veiculo, motorista, modelo AND $optionSearchUser LIKE '$valorUser%' ORDER BY $optionOrderUser;");   
        }  
    } 
    if($valorUser == ""){
        $sql =  ("SELECT * FROM motorista, veiculo, viagem, modelo
        WHERE viagem.id_veiculo1 = veiculo.id_veiculo
        AND modelo.id_modelo = veiculo.id_modelo
        AND viagem.id_motorista1 = motorista.id_motorista
        AND viagem.id_viagem  ORDER BY $optionOrderUser;");
            
            /*"SELECT viagem.id_viagem , veiculo.id_veiculo, descricao, placa,id_motorista1, nome  FROM viagem, veiculo, motorista, modelo WHERE viagem.id_motorista1 = motorista.id_motorista
        And viagem.id_veiculo1 = veiculo.id_veiculo
        and viagem.id_motorista1= motorista.id_motorista
        and id_viagem  ORDER BY $optionOrderUser;");*/
    }

    $pdo = Conexao::getInstance();
    $consulta = $pdo->query($sql);
    echo "<br><table><tr><th>Codigo</th><th>Motorista</th><th>Modelo</th><th>Placa</th><th>Alterar</th><th>Excluir</th></tr>";
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
?>
        <tr>
            <td><?php echo $linha['id_viagem']; ?></td>
            <td><?php echo $linha['nome']; ?></td>
            <td><?php echo $linha['descricao']; ?></td>
            <td><?php echo $linha['placa']; ?></td>
            <td><a href='cadviagem.php?acao=editar&id_viagem=<?php echo $linha['id_viagem']; ?>'><img class="icon" src="img/edit.png" alt=""></a></td>
            <td><a href="javascript:excluirRegistro('acao.php?acao=excluir&id_viagem=<?php echo $linha['id_viagem']; ?>')"><img class="icon" src="img/delete.png" alt=""></a></td>
        </tr>
    <?php } ?>
    </table>
<?php
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
    
?>

</body>

</html>