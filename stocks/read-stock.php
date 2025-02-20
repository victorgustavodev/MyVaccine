<?php
// Inclui os arquivos necessários
require_once '../routes/db-connection.php';
require_once '../routes/authenticate-adm.php';

// Verifica se o usuário tem permissão para acessar a página
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    echo "Acesso restrito. Você precisa ser administrador para acessar esta página.";
    exit;
}

$post_id = $_GET['id'];

// Obtém o ID do posto pela URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Posto não encontrado.");
}

$id = (int) $_GET['id']; // Converte para inteiro para evitar SQL Injection


// Obtém o ID do post a partir da URL usando o método GET
$id = $_GET['id'];


// Busca o nome do posto
$stmt_post = $pdo->prepare("SELECT name FROM posts WHERE id = ?");
$stmt_post->execute([$post_id]);
$post = $stmt_post->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    echo "Posto de vacinação não encontrado.";
    exit;
}

// Busca as vacinas disponíveis no posto
$stmt_stocks = $pdo->prepare("
    SELECT v.name AS vaccine_name, s.quantity 
    FROM stocks s
    INNER JOIN vaccines v ON s.vaccine_id = v.id
    WHERE s.post_id = ?
    ORDER BY v.name ASC
");
$stmt_stocks->execute([$post_id]);
$stocks = $stmt_stocks->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css" />
    <script src="https://kit.fontawesome.com/c8e307d42e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="./assets/img/icon.png">
    <title>Estoque de Vacinas - <?= htmlspecialchars($post['name']) ?></title>
</head>

<body class="h-screen">

    <navbar class="px-[6%] h-[8%] flex justify-between items-center navbar text-[#100E3D] bg-white shadow-md">
        <a href="../index.php"><img src="../assets/img/logo.png" alt="logo" class="w-[190px]" /></a>
        <div class="flex gap-[64px] text-[16px]">
            <ul class="flex gap-4">
                <li>
                    <p class="font-bold">Modo Admin</p>
                </li>
                <li><a href="../routes/logout.php" class="font-bold text-red-500">Sair</a></li>
            </ul>
        </div>
    </navbar>

    <main class="flex w-screen h-[92%] items-center justify-center">
        <div class="bg-white w-[90%] md:w-[50%] p-6 rounded-lg shadow-lg">
            <h2 class="text-lg font-bold mb-4">Estoque de Vacinas - <?= htmlspecialchars($post['name']) ?></h2>


            <?php if (count($stocks) > 0): ?>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 p-2 text-left w-1/2">Vacina</th>
                        <th class="border border-gray-300 p-2 text-left w-1/2">Quantidade disponível</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($stocks as $stock): ?>
                    <tr>
                        <td class="border border-gray-300 p-2"><?= htmlspecialchars($stock['vaccine_name']); ?></td>
                        <td class="border border-gray-300 p-2"><?= $stock['quantity']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p class="text-gray-600">Nenhuma vacina cadastrada neste posto.</p>
            <?php endif; ?>

            <div class="w-full flex justify-end mt-4 gap-3">
                <a href="../posts/read-post.php" class="bg-red-500 text-white px-8 py-2 rounded-md hover:bg-red-600">
                    Voltar
                </a>

                <a href="create-stock.php?id=<?= $post_id?>"
                    class="bg-blue-500 text-white px-8 py-2 rounded-md hover:bg-blue-600">
                    Adicionar Estoque
                </a>
            </div>
        </div>
    </main>

</body>

</html>