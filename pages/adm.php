<?php

session_start();
require_once "../routes/db-connection.php";

// Verifica se o usuário não está logado ou não tem o papel de 'admin'

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
   echo "Acesso restrito. Você precisa ser administrador para acessar esta página.";
    exit;
}

// Prepara a consulta para buscar todos os postos
$stmt = $pdo->prepare("SELECT * FROM posts");
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC); // Recupera todos os registros

// Verifica se há registros
if ($posts) {
    // Processar os dados (se necessário)
} else {
    // Opcional: Mensagem caso não haja postos
    $error_message = "Nenhum posto de vacinação encontrado.";
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css" />
    <script src="https://kit.fontawesome.com/c8e307d42e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="./assets/img/icon.png">
    <title>Gerenciamento de Postos</title>
</head>

<body class="bg-gray-100 h-screen">

    <?php
     include '../components/navbar.php'
     ?>

    <section class="w-[90vw] flex flex-col gap-[5vh] mt-[5vh] mx-[5vw]">
        <div class="flex justify-between">
            <h1 class="text-xl md:text-3xl">Painel</h1>
            <a href="../posts/create-post.php"
                class="bg-blue-500 text-white px-4 py-2 text-xs md:text-sm rounded-md hover:bg-blue-600">
                Adicionar novo posto
            </a>
        </div>

        <table class="min-w-full max-w-[100vw] bg-white border border-gray-200 shadow-md">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border-b text-left text-xs md:text-sm font-medium text-gray-600">ID</th>
                    <th class="px-2 py-2 border-b text-left text-xs md:text-sm font-medium text-gray-600">Nome do Posto
                    </th>
                    <th class="px-2 py-2 border-b text-left text-xs md:text-sm font-medium text-gray-600">Rua</th>
                    <th class="px-2 py-2 border-b text-left text-xs md:text-sm font-medium text-gray-600">Cidade</th>
                    <th class="px-2 py-2 border-b text-left text-xs md:text-sm font-medium text-gray-600">Estado</th>
                    <th class="px-2 py-2 border-b text-left text-xs md:text-sm font-medium text-gray-600">Ações</th>
                </tr>
            </thead>
            <tbody>

                <?php if (empty($posts)): ?>
                <tr>
                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">Nenhum posto cadastrado!</td>
                </tr>
                <?php endif; ?>

                <?php foreach ($posts as $post): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b text-xs md:text-sm text-gray-800"><?= $post['id'] ?></td>
                    <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800"><?= $post['name'] ?></td>
                    <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800"><?= $post['address'] ?></td>
                    <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800"><?= $post['city'] ?></td>
                    <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800"><?= $post['state'] ?></td>
                    <td class="px-2 py-2 border-b text-xs md:text-sm flex gap-2 flex-col md:flex-row">
                        <!-- <button
                            class="bg-green-600 text-white px-3 py-1 text-xs md:text-sm rounded-md hover:bg-green-600">Gerenciar
                            Vacinas</button> -->
                        <a href="../posts/update-post.php?id=<?= $post['id']; ?>"
                            class="bg-blue-500 text-white px-3 py-1 text-xs md:text-sm rounded-md hover:bg-blue-600">Editar</a>
                        <a href="../posts/delete-post.php?id=<?= $post['id']; ?>"
                            class="bg-red-500 text-white px-3 py-1 text-xs md:text-sm rounded-md hover:bg-red-600">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

</body>

</html>