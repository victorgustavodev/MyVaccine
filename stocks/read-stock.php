<?php
// Inclui os arquivos necessários
require_once '../routes/db-connection.php';
require_once '../routes/authenticate-adm.php';

// Verifica se o usuário tem permissão para acessar a página
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    echo "Acesso restrito. Você precisa ser administrador para acessar esta página.";
    exit;
}

$post_id = $_GET['id']; // Obtém o ID do posto pela URL

// Verifica se o ID do posto é válido
if (!isset($post_id) || !is_numeric($post_id)) {
    die("Posto não encontrado.");
}

// Busca o posto de vacinação
$stmt_post = $pdo->prepare("SELECT id, name FROM posts WHERE id = ?");
$stmt_post->execute([$post_id]);
$post = $stmt_post->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    echo "Posto de vacinação não encontrado.";
    exit;
}

// Busca as vacinas disponíveis no posto
$stmt_stocks = $pdo->prepare("
    SELECT v.name AS vaccine_name, s.quantity, s.batch, s.expiration_date 
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
    <link rel="stylesheet" href="../assets/style/style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="./assets/img/icon.png">
    <title>Estoque de Vacinas - <?= htmlspecialchars($post['name']) ?></title>
</head>

<body class="bg-gray-100 h-screen flex">

    <nav class="flex flex-col justify-between p-5 items-center border-r-2">
        <div class="flex flex-col items-center gap-4">
            <a href="../posts/read-post.php"><img src="../assets/img/logo-mobile.png" class="w-[36px]" alt="logo my-vaccine"></a>
            <!-- ... (menu de navegação) ... -->
        </div>
        <a href="../admin/logout-admin.php">
            <i class="fa-solid fa-arrow-right-from-bracket text-[20px] text-red-400 hover:text-red-600 transition all"></i>
        </a>
    </nav>

    <section class="w-[90vw] flex justify-center">
        <div class="w-[70%] flex flex-col gap-[5vh] mt-[5vh] mx-[5vw]">
            <h1 class="text-xl md:text-3xl">Gerenciar Estoque - <?= htmlspecialchars($post['name']) ?></h1>
            <table>
                <thead>
                    <tr class="flex flex-col text-left text-xs md:text-sm text-[#B5B7C0]">
                        <th class="font-light pl-4 py-2">Vacina</th>
                        <th class="font-light px-2 py-2">Quantidade</th>
                        <th class="font-light px-2 py-2">Lote</th>
                        <th class="font-light px-2 py-2">Data de Validade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($stocks as $stock): ?>
                        <tr class="flex flex-col text-sm">
                            <td class="pl-4 py-2"><?= htmlspecialchars($stock['vaccine_name']) ?></td>
                            <td class="px-2 py-2"><?= htmlspecialchars($stock['quantity']) ?></td>
                            <td class="px-2 py-2"><?= htmlspecialchars($stock['batch']) ?></td>
                            <td class="px-2 py-2"><?= htmlspecialchars($stock['expiration_date']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

</body>

</html>
