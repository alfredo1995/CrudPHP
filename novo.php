<?php
/**
 * // caminho do arquivo: \novo.php
 */

include ('verifica_sessao.php');
include ('includes/header.php');
include ('includes/menu.php');
include ('./funcoes/Utils.php');

?>
<div id="centraliza">
    <form id="cadastro" action="incluir.php" method="GET" enctype="multipart/form-data">
        <fieldset>
            <legend>Novo Contato</legend>
            <table>
                <tr>
                    <td>Nome:</td>
                    <td>
                        <input type="text" name="nome" value="" title="Preencha o campo Nome" required name=nome class="input"/>
					
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="text" name="email" value="" title="Preencha o campo E-mail" required email=email class="input"/>
                    </td>
                </tr>
                <tr>
                    <td>Telefone:</td>
                    <td>
                        <input type="text" name="telefone" value="" title="Preencha o campo telefone" required telefone=telefone class="input"/>
                    </td>
                </tr>
                <tr>	
				
                    <td>Nascimento:</td>
                    <td>
                        <select name="dia" title="dia" title="Selecione o dia" required dia=dia >
                            <?php echo getDias(""); ?>
                        </select>
                        <select name="mes" title="mes"  >
                            <?php echo getMes(""); ?>
                        </select>
                        <select name="ano" title="ano" title="selecione o ano" required ano=ano >
                            <?php echo getAnos(""); ?>
                        </select>
                    </td>
                </tr>
				<tr>
				 <td>Imagem:</td>
				<td>
               
				<input type="file" required name="arquivos">
				</td>
				</tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="submit" name="btCadastrar" value="Incluir" 
                               class="botao"/>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>
<?php
include 'includes/footer.php';
