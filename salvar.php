<?php

session_start();
include('classes/ConnectionFactory.php');
include('./funcoes/Utils.php');

$conn = new Conexao();
$conexao = $conn->getConnection();

//VERIFICA SE TEM UPLOAD DE ARQUIVO FEITO
if(!empty($_FILES['arquivos']['name']))
{

if(isset($_FILES['arquivos'])){
$extensao = strtolower(substr($_FILES['arquivos']['name'],-4)); //pega a extensão do arquivo
$novo_nome = md5(time()) . $extensao; //define um novo nome para o arquivo para que não haja nomes iguais
$diretorio = "upload_imagens/"; //define o diretorio para o arquivo
move_uploaded_file($_FILES['arquivos']['tmp_name'],$diretorio.$novo_nome); //efetua o upload
}
}else{

$novo_nome = $_POST['imagem'];

}


$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
$dataNascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_STRING);



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

if(empty($dataNascimento))
{
$erro = 1;
$msg .= "Campo data vazio!</br>";

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




$query = "UPDATE contato SET "
        . "nome = '$nome', "
        . "email = '$email',"
        . "telefone = '$telefone',"
        . "data_nascimento = '$dataNascimento', "
		. "imagem = '$novo_nome' "
        . " WHERE id = $id";


$stmt = $conexao->prepare($query);
$stmt->execute();

$_SESSION['status'] = 'Contato atualizado com sucesso!';
header('Location: principal.php');
}