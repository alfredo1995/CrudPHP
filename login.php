<?php

/**
 * // caminho do arquivo: \login.php
 */
session_start();
include('classes/ConnectionFactory.php');

/**
 * Instancia a classe de conexão com o banco de dados
 */
$conn = new Conexao();

/**
 * Se retornar uma string, significa que deu erro ao acessar o banco
 * Caso contrário, retorna uma conexão válida
 */
if (gettype($conn->getConnection()) == 'string') {
    echo $conn->getConnection();
} else {
    $conexao = $conn->getConnection();
}

/**
 * Recupera os dados informados no formulário
 */
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

/**
 * Monta a estrutura da string SQL com as variáveis recuperadas
 */
$query = "SELECT * FROM "
        . "usuario "
        . "WHERE "
        . "usuario = '$usuario' AND senha = '$senha'";

/**
 * Prepara a string SQL
 */
$stmt = $conexao->prepare($query);

/**
 * Executa a consulta
 */
$stmt->execute();

/**
 * Verifica se houve algum retorno do banco de dados - usuário existe
 * Caso seja verdade, cria uma sessão de identificação
 * Caso contrário, destroi todas as sessões e envia para a página de login
 */
if ((int) $stmt->fetchColumn() > 0) {
    $_SESSION['idSession'] = session_id();
} else {
    $_SESSION['erro'] = TRUE;
    header('Location: index.php');
}

/**
 * Se passou no teste anterior, então executa a consulta novamente e
 * armazena o resultado na variável usuarios
 */
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

/**
 * Percorre o array retornado pelo banco de dados e atribui os valores desejados
 * em uma sessão que será recuperada posteriormente
 */
foreach ($usuarios as $usuario) {

    $_SESSION['usuario'] = array(
        'id' => $usuario['id'],
        'nome' => $usuario['nome']
    );
}

/**
 * Se chegou até aqui, envia para a página de resposta (saída)
 */
$_SESSION['status'] = "Olá, seja bem vindo!";
header('Location: principal.php');

