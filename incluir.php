<?php

session_start();
include('classes/ConnectionFactory.php');
include('./funcoes/Utils.php');

$conn = new Conexao();
$conexao = $conn->getConnection();

//VERIFICA SE TEM UPLOAD DE ARQUIVO FEITO
if(isset($_FILES['arquivos'])){
$extensao = strtolower(substr($_FILES['arquivos']['name'],-4)); //pega a extensão do arquivo
$novo_nome = md5(time()) . $extensao; //define um novo nome para o arquivo para que não haja nomes iguais
$diretorio = "upload_imagens/"; //define o diretorio para o arquivo
move_uploaded_file($_FILES['arquivos']['tmp_name'],$diretorio.$novo_nome); //efetua o upload
}

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
$dia = filter_input(INPUT_POST, 'dia', FILTER_SANITIZE_STRING);
$mes = filter_input(INPUT_POST, 'mes', FILTER_SANITIZE_STRING);
$ano = filter_input(INPUT_POST, 'ano', FILTER_SANITIZE_STRING);
$dataNascimento = $dia . '/' . $mes . '/' . $ano;

$erro = 0;
$msg = "";
if(empty($nome))
{
$erro = 1;
$msg .= "Campo nome vazio!</br>";
}
if(empty($email))
{
$erro = 1;
$msg .= "Campo e-mail vazio!</br>";
}
if(empty($telefone))
{
$erro = 1;
$msg .= "Campo telefone vazio!</br>";

}

if(empty($dia))
{
$erro = 1;
$msg .= "Campo dia vazio!</br>";

}

if(empty($ano))
{
$erro = 1;
$msg .= "Campo ano vazio!</br>";

}

if($erro)
{
echo "<html><body>";
echo "<p align=center> $msg</p>";
echo "<p align=center><a href='javascript:history.back()'> Voltar </a></p>";
echo "</body></html>";
}
else
{

$query = "INSERT INTO contato "
        . "(nome, email, telefone, data_nascimento, imagem ,  id_usuario) "
        . "VALUES ('$nome', "
        . "'$email', "
        . "'$telefone', "
        . "'$dataNascimento', "
		. "'$novo_nome',"
        . $_SESSION['usuario']['id']
        . ')';

$stmt = $conexao->prepare($query);
$stmt->execute();

$_SESSION['status'] = 'Contato inserido com sucesso!';
header('Location: principal.php');
}