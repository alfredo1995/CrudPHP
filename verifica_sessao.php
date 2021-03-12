<?php
/**
 * // caminho do arquivo: \verifica_sessao.php
 */

/**
 * Incializa a sessão
 */
session_start();

/**
 * Verifica se há uma sessão ativa, senão envia para index.php
 * Isso é uma proteção de que não será acessada nenhuma página
 * que não tiver autorização (login efetuado)
 */
if (!isset($_SESSION['idSession'])) {
    /* @var $header type */
    $header = \header('Location: index.php');
}
