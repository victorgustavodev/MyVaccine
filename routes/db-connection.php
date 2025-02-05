<?php

    $host = '127.0.0.1'; // endereço do servidor mysql
    $db = 'my_vaccine'; // nome database
    $user = 'root'; // usuário
    $pass = ''; // senha
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "true";
        } catch (PDOException $e) {
        error_log($e->getMessage());
        echo $e;
        die('Erro ao conectar ao banco de dados. Tente novamente mais tarde.');
    }


?>