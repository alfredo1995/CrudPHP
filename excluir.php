<?php
include ('verifica_sessao.php');
include ('./funcoes/Utils.php');
include ('classes/ConnectionFactory.php');

$conn = new Conexao();
if (gettype($conn->getConnection()) == 'string') {
    echo $conn->getConnection();
} else {
    $conexao = $conn->getConnection();
}

$id = $_GET['id'];
$query = "DELETE FROM contato "
       . "WHERE id = " . $id . " ";
   

/**
 * Prepara a string SQL
 */
$stmt = $conexao->prepare($query);

/**
 * Executa a consulta
 */
$stmt->execute();
$_SESSION['status'] = 'Contato excluido com exito!';
header('Location: principal.php');
?>