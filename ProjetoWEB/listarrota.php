<!DOCTYPE html>
<?php
include_once "conf/default.inc.php";
require_once "conf/Conexao.php";
include  "menu.php" ;
?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Rotas</title>
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
  
?>
    <a href="cadrota.php">Nova Rota</a>

    <form method="POST">
        Consultar por: <br>
        <input type="radio" name="optionSearchUser" id="" value="id_rota" required>Código<br>
        <input type="radio" name="optionSearchUser" id="" value="destino" required>Destino<br>
        Ordenar por: <br>
        <input type="radio" name="optionOrderUser" id="" value="id_rota" required>Código
        <input type="radio" name="optionOrderUser" id="" value="destino" required>Destino
        <br>
        <a href="listarrota.php">Listar todos</a><br>
        <input type="text" name="valorUser">
        <input type="submit" value="Consultar">
    </form>
    <?php

    try {

        $optionSearchUser = isset($_POST["optionSearchUser"]) ? $_POST["optionSearchUser"] : "";
        $optionOrderUser = isset($_POST["optionOrderUser"]) ? $_POST["optionOrderUser"] : "";
        $valorUser = isset($_POST["valorUser"]) ? $_POST["valorUser"] : "";

        $sql = "";

        if ($optionSearchUser != "") {
            if ($valorUser == "") {

                $sql = ("SELECT * FROM rota ORDER BY $optionOrderUser;");
            } elseif ($optionSearchUser == "destino") {
                $sql = ("SELECT * FROM modelo WHERE $optionSearchUser = $valorUser;");
            } else {
                $sql = ("SELECT * FROM modelo WHERE $optionSearchUser LIKE '$valorUser%' ORDER BY $optionOrderUser;");
            }
        } else {
            $sql = ("SELECT * FROM rota;");
        }
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);
        echo "<br><table><tr><th>Código</th><th>Distância entre as cidades</th><th>Cidade de origem</th>
        <th>Cidade de destino</th><th>Alterar</th><th>Excluir</th></tr>";
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {

    ?>
            <tr>
                <td><?php echo $linha['id_rota']; ?></td>
                <td><?php echo $linha['km']; ?></td>
                <td><?php echo $linha['origem']; ?></td>
                <td><?php echo $linha['destino']; ?></td>
                <td><a href='cadrota.php?acao=editar&id_rota=<?php echo $linha['id_rota']; ?>'><img class="icon" src="img/edit.png" alt=""></a></td>
                <td><a href="javascript:excluirRegistro('acaorota.php?acao=excluir&id_rota=<?php echo $linha['id_rota']; ?>')"><img class="icon" src="img/delete.png" alt=""></a></td>
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