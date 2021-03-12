<?php

/**
 * // caminho do arquivo: \index.php
 */
session_start();
$mensagem = (isset($_SESSION['erro']) ? 'Usuário e/ou Senha incorretos' : '');

/**
 * Verifica se há um usuário logado no sistema e redireciona para página
 * principal da agenda
 */
if (isset($_SESSION['contato']['nome'])) {
    header('Location: principal.php');
}

include 'includes/header.php'
?>
<div id="centraliza">
    <form id="frmPost" action="login.php" method="POST">
        <fieldset>
            <legend>Acesso a Agenda Pessoal</legend>
            <table>
                <tr>
                    <td>Usuário:</td>
                    <td><input type="text" name="usuario" value="" 
                               class="input" 
                               placeholder="Digite seu nome de usuário"/>
                    </td>
                </tr>
                <tr>
                    <td>Senha:</td>
                    <td><input type="password" name="senha" value="" 
                               class="input" placeholder="Digite sua senha"/>
                    </td>
                </tr>                        
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="submit" name="btLogin" value="Prosseguir" 
                               class="botao"/>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>
<p style="text-align: center;" class="erro"><?php echo $mensagem; ?></p>
<?php
include 'includes/footer.php';

