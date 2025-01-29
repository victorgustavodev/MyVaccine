<?php
session_start(); // Inicia a sessão
session_unset(); // libera todos os registros da sessão
session_destroy(); // Destrói todas as variáveis da sessão
header('Location: ../pages/login.php'); // Redireciona para a página de login
exit();