<?php
/**
 * // caminho do arquivo: \logout.php
 */

/**
 * Destroi todas as sessões e redireciona para a página de login
 */
session_start();
session_destroy();
header('Location: index.php');
