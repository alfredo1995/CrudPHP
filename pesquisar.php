<?php
/**
 * // caminho do arquivo: \pesquisar.php
 */

include ('verifica_sessao.php');
include ('includes/header.php');
include ('includes/menu.php');
?>
<div id="centraliza">
    <form id="pesquisar" action="busca.php" method="POST">
        <fieldset>
            <legend>Insira um nome ou parte dele</legend>
            <table>
                <tr>
                    <td>Nome:</td>
                    <td>
                        <input type="text" name="nome" value="" class="input"/>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="submit" name="btPesquisar" 
                               value="Pesquisar" class="botao"/>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>
<?php
include 'includes/footer.php';
