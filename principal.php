<?php
/**
 * // caminho do arquivo: \principal.php
 */

include ('verifica_sessao.php');
include ('includes/header.php');
include ('includes/menu.php');
?>

<p style="text-align: center; padding-top: 200px;"><?php echo $_SESSION['status']; ?></p>

<?php

include 'includes/header.php';
