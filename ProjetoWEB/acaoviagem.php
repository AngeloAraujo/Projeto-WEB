<?php
header('Content-Type: text/html; charset=UTF-8');
include 'connect/connect.php';
include_once "conf/default.inc.php";
require_once "conf/Conexao.php";

$acao = '';
if (isset($_GET["acao"]))
    $acao = $_GET["acao"];

if ($acao == "excluir") {
    $codigo = 0;
    if (isset($_GET["id_viagem"])) {
        $codigo = $_GET["id_viagem"];
        excluir($codigo);
    }
} else {
    if (isset($_POST["acao"])) {
        $acao = $_POST["acao"];
        if ($acao == "salvar") {
            $codigo = 0;
            if (isset($_POST["id_viagem"])) {
                $codigo = $_POST["id_viagem"];
                if ($codigo == 0)
                    inserir();
                else
                    alterar($codigo);
            }
        }
    }
}

function excluir($codigo)
{
    $sql = "DELETE FROM viagem WHERE id_viagem = $codigo;";
    $result = mysqli_query($GLOBALS['conexao'], $sql);
    if ($result == 1)
        header('location:listarviagem.php');
    else
        header('location:listarviagem.php');
        echo $sql;
}

function alterar($codigo)
{
    $vet = carregarTelaParaVetor();
    $sql = 'UPDATE ' . $GLOBALS['tb_viagem'] .
        ' SET id_motorista1 = "' . $vet['motorista'] . '"' .
        ', id_veiculo1 = "' . $vet['veiculo'] . '"' .
        ' WHERE id_viagem = ' . $codigo;
    $result = mysqli_query($GLOBALS['conexao'], $sql);
    if ($result == 1)
        header('location:cadviagem.php?msg="sa"&acao=editar&id_viagem=' . $codigo);
    else
        header('location:cadviagem.php?msg="er"&acao=editar&id_viagem=' . $codigo);
        var_dump($sql);
}

function inserir()
{

    $dados = carregarTelaParaVetor();
    var_dump($dados);

    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('INSERT INTO viagem (id_viagem, id_motorista1, id_veiculo1) 
                            VALUES (:id_viagem, :id_motorista, :id_veiculo)');
    $codigo = $dados['id_viagem'];
    $motorista = $dados['id_motorista'];
    $veiculo = $dados['id_veiculo'];
    $stmt->bindParam(':id_viagem', $codigo, PDO::PARAM_INT);
    $stmt->bindParam(':id_motorista', $motorista, PDO::PARAM_INT);
    $stmt->bindParam(':id_veiculo', $veiculo, PDO::PARAM_INT);

    $stmt->execute();

    header("location:cadviagem.php");

}

function carregarTelaParaVetor()
{
    $vet = array();
    $vet['id_viagem'] = $_POST["id_viagem"];
    $vet['id_motorista1'] = $_POST["id_motorista1"];
    $vet['id_veiculo1'] = $_POST["id_veiculo1"];
    return $vet;
}

function carregaBDParaVetor($codigo)
{
    $sql = "SELECT * FROM viagem WHERE id_viagem = $codigo;";
    $result = mysqli_query($GLOBALS['conexao'], $sql);
    $dados = array();
    while ($row = mysqli_fetch_array($result)) {
        $dados['id_viagem'] = $row['id_viagem'];
        $dados['id_veiculo'] = $row['id_veiculo1'];
        $dados['id_motorista'] = $row['id_motorista1'];
    }
    return $dados;
}
	