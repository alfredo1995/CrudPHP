<?php
/**
 * // caminho do arquivo: \editar.php
 */
include ('verifica_sessao.php');
include ('includes/header.php');
include ('includes/menu.php');
include ('./funcoes/Utils.php');
include ('classes/ConnectionFactory.php');

$conn = new Conexao();
if (gettype($conn->getConnection()) == 'string') {
    echo $conn->getConnection();
} else {
    $conexao = $conn->getConnection();
}

$id = $_GET['id'];
$query = "SELECT contato.id, contato.nome, contato.email, contato.telefone, contato.data_nascimento , contato.imagem FROM "
        . "contato "
        . "INNER JOIN usuario "
        . "ON contato.id_usuario = usuario.id "
        . "WHERE contato.id = " . $id . " "
        . "ORDER BY contato.nome ASC";

/**
 * Prepara a string SQL
 */
$stmt = $conexao->prepare($query);

/**
 * Executa a consulta
 */
$stmt->execute();
$contatos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div id="centraliza">
    <form id="cadastro" action="salvar.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Editar Contato</legend>
            <?php
            foreach ($contatos as $contato) {
                ?>
                <table>
                    <tr>
                        <td>Nome:</td>
                        <td>
                            <input type="text" name="nome" value="<?php echo($contato['nome']); ?>"  class="input" title="Preencha o campo Nome" required name=nome/>
                        </td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>
                            <input type="text" name="email" value="<?php echo($contato['email']); ?>" class="input" title="Preencha o campo Nome" required email=email/>
                        </td>
                    </tr>
                    <tr>
                        <td>Telefone:</td>
                        <td>
                            <input type="text" name="telefone" value="<?php echo($contato['telefone']); ?>" class="input" title="Preencha o campo Nome" required telefone=telefone/>
                        </td>
                    </tr>
                    <tr>
                        <td>Nascimento:</td>
                        <td>
                            <input type="text" name="data_nascimento" value="<?php echo($contato['data_nascimento']); ?>" class="input" title="Preencha o campo Nome" required data_nascimento=data_nascimento/>

                        </td>
                    </tr>
					
					
					
					  <tr>
                        <td>Imagem:</td>
                        <td>

                           <input type="file"  name="arquivos">
                          
                        </td>
						<td style="display:block">
						 <input type="text" name="imagem" value="<?php echo($contato['imagem']); ?>"/>
						 </td>
                    </tr>
					
					
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <input type="submit" name="btCadastrar" value="Salvar" class="botao2"/>
                            <input type="button" name="btVoltar" onclick="history.go(-1);" value="Voltar" class="botao2">
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="id" value="<?php echo($contato['id']); ?>">
            <?php } ?>
        </fieldset>
    </form>
</div>
<?php
include 'includes/footer.php';

