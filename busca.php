<?php
/**
 * // caminho do arquivo: \busca.php
 */
/**
 * Includes necessárias
 */
include ('verifica_sessao.php');
include ('includes/header.php');
include ('includes/menu.php');
include('classes/ConnectionFactory.php');

/**
 * Instancia a classe de conexão com o banco de dados
 */
$conn = new Conexao();

/**
 * Se retornar uma string, significa que deu erro ao acessar o banco
 * caso contrário, retorna uma conexão válida
 */
if (gettype($conn->getConnection()) == 'string') {
    echo $conn->getConnection();
} else {
    $conexao = $conn->getConnection();
}

/**
 * Recupera os dados informados no formulário
 */
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);

/**
 * Monta a estrutura da string SQL com as variáveis recuperadas
 * Usando INNER JOIN, pois existem duas tabelas
 */
 
 //FOI ADICIONADO NO SELECT MAIS DOIS CAMPOS data_nascimento E imagem
$query = "SELECT contato.id, contato.nome, contato.email, contato.telefone, contato.data_nascimento , contato.imagem "
        . "FROM contato "
        . "INNER JOIN usuario "
        . "ON contato.id_usuario = usuario.id "
        . "WHERE "
        . "contato.nome LIKE '%$nome%' AND contato.id_usuario = "
        . $_SESSION['usuario']['id'] . " "
        . "ORDER BY contato.nome ASC";

/**
 * Prepara a string SQL
 */
$stmt = $conexao->prepare($query);

/**
 * Executa a consulta
 */
$stmt->execute();

/**
 * Verifica se houve algum retorno do banco de dados
 * Caso seja verdade, cria uma sessão de identificação
 * Caso contrário, destroi todas as sessões e envia para a página de login
 */
if ((int) $stmt->fetchColumn() === 0) {
    $mensagem = '<p style="text-align: center; padding-top: 200px;">';
    $mensagem.= 'O termo [<strong>' . $nome . '</strong>] ';
    $mensagem.= 'não foi localizado!</p>';

    echo($mensagem);
} else {

    /**
     * Se passou no teste anterior, então executa a consulta novamente e
     * armazena o resultado na variável contatos
     */
    $stmt->execute();
    $contatos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    /**
     * Percorre o array retornado pelo banco de dados e atribui os 
     * valores desejados em uma sessão que será recuperada posteriormente
     */
    ?>
   <!-- 
       CENTRALIZA A TABELA 
   -->
    <table  align="center">
	
        <h3>Contato(s) localizado(s)</h3>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Nascimento</th>
				<th>imagem</th>				
            </tr>
        </thead>
        <tbody>
            <?php
            /**
             * Percorre os registros retornados do banco de dados e
             * apresenta no navegador
             */
            foreach ($contatos as $contato) {
                ?>
                <tr>
                    <td><?php echo($contato['id']); ?></td>
                    <td><?php echo($contato['nome']); ?></td>
                    <td><?php echo($contato['email']); ?></td>
                    <td><?php echo($contato['telefone']); ?></td>
					<td><?php echo($contato['data_nascimento']); ?></td>
					 <!-- 
						  ADICIONANDO A IMAGEM NA TABELA 
					 -->
						<td><img src="upload_imagens\<?php if(empty($contato['imagem'])){ echo "img.jpg";} else {echo($contato['imagem']);} ?>"  width="42" height="42"> </td>

                    <td><a href="editar.php?id=<?php echo($contato['id']); ?>">Editar</a></td>
					<!-- 
						 ADICIONAR O BOTÃO DE EXCLUSÃO  PASSANDO O PARAMETRO PELA URL
						 E RECUPERANDO NA PAGINA excluir.php
						 FOI ADICIONADO UM JAVASCRIPTS PARA PEDIR A CONFIRMAÇÃO NA HORA DE EXCLUIR 
					 -->
                     <td><a href="excluir.php?id=<?php echo($contato['id']); ?>" onClick="confirm('Deseja excluir contato!?')"  >Excluir </a></td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
    <?php
}
include 'includes/footer.php';
