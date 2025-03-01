<?php
// Inclui os arquivos necessários
require_once '../routes/db-connection.php';
require_once '../routes/authenticate-adm.php';

// Verifica se o usuário tem permissão para acessar a página
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    echo "Acesso restrito. Você precisa ser administrador para acessar esta página.";
    exit;
}

// Verifica se o ID do posto foi passado pela URL e se é um valor numérico válido
$stock_id = isset($_GET['id']) ? $_GET['id'] : null;
if (!$stock_id || !is_numeric($stock_id)) {
    die("Posto não encontrado.");
}

// Busca o posto de vacinação
$stmt_post = $pdo->prepare("SELECT id, name FROM posts WHERE id = ?");
$stmt_post->execute([$stock_id]);
$stock = $stmt_post->fetch(PDO::FETCH_ASSOC);

if (!$stock) {
    echo "Posto de vacinação não encontrado.";
    exit;
}

// Busca as vacinas disponíveis no posto
$stmt_stocks = $pdo->prepare("
    SELECT v.name AS vaccine_name, s.quantity, s.batch, s.expiration_date, s.last_updated
    FROM stocks s
    INNER JOIN vaccines v ON s.vaccine_id = v.id
    WHERE s.post_id = ?
    ORDER BY v.name ASC
");
$stmt_stocks->execute([$stock_id]);
$stocks = $stmt_stocks->fetchAll(PDO::FETCH_ASSOC);

// Verifica se há vacinas cadastradas no estoque
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/style/style.css" />
    <script src="https://kit.fontawesome.com/c8e307d42e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="./assets/img/icon.png">
    <title>Estoque de vacinas</title>
</head>

<body class="bg-gray-100 h-screen flex">

    <nav class="flex flex-col justify-between p-5 items-center border-r-2">
        <div class="flex flex-col items-center gap-4">
            <a href="../posts/read-post.php"><img src="../assets/img/logo-mobile.png" class="w-[36px]"
                    alt="logo my-vaccine"></a>

            <!-- barrinha -->
            <span class="h-[1px] w-full bg-gray-300 rounded-full"></span>

            <div class="grid grid-cols-1 gap-[32px] justify-items-center">
                <span class="uppercase text-xs text-gray-300 font-semibold">main</span>
                <!-- Postos de saude -->
                <a href="../posts/read-post.php">
                    <i class="fa-solid fa-house-medical text-[20px] text-black"></i>
                </a>
                <!-- Pacientes -->
                <a href="#">
                    <i class="fa-solid fa-bed text-[20px] text-gray-400 hover:text-black transition all"></i>
                </a>
                <!-- Vacinas -->
                <a href="../vaccines/read-vaccine.php">
                    <i class="fa-solid fa-syringe text-[20px] text-gray-400 hover:text-black transition all"></i>
                </a>
            </div>

            <!-- barrinha -->
            <span class="h-[1px] w-full bg-gray-300 rounded-full"></span>

            <span class="uppercase text-xs text-gray-300 font-semibold">config</span>

            <!-- configs -->
            <a href="../config/config.php">
                <i class="fa-solid fa-gear text-[20px] text-gray-400 hover:text-black transition all"></i>
            </a>

        </div>

        <a href="../admin/logout-admin.php">
            <i
                class="fa-solid fa-arrow-right-from-bracket text-[20px] text-red-400 hover:text-red-600 transition all"></i>
        </a>

    </nav>

    <section class="w-[90vw] flex justify-center">
        <div class="w-[70%] flex flex-col gap-[5vh] mt-[5vh] mx-[5vw]">

            <div class="flex justify-between">
                <h1 class="text-xl md:text-3xl">Gerenciar Estoque - <?= htmlspecialchars($stock['name']) ?></h1>


                <a href="./create-stock.php?id=<?= $stock['id'];?>"
                    class="bg-blue-500 text-white px-4 py-2 text-xs md:text-sm rounded-md hover:bg-blue-600">
                    Cadastrar novo lote
                </a>
            </div>

            <table class="min-w-full max-w-[100vw] bg-white border border-gray-200 shadow-md text-nowrap">
                <thead>
                    <tr class="bg-[#EEEEEE] text-left text-xs md:text-sm text-[#B5B7C0]">
                        <th class="font-light py-3 px-2 w-1/5 border-b">Vacina</th>
                        <th class="font-light px-2 py-2 border-b w-1/5">Quantidade em estoque
                        </th>
                        <th class="font-light px-2 py-2 border-b w-1/5">Lote</th>
                        <th class="font-light px-2 py-2 border-b w-1/5">Validade do Lote</th>
                        <th class="font-light px-2 py-2 border-b w-1/5">Ações</th>
                        <th class="font-light px-2 py-2 border-b w-1/5">Última atualização</th>
                    </tr>
                </thead>
                <tbody>

                    <?php if (empty($stocks)): ?>
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-400">Nenhuma vacina cadastrada nesse posto!</td>
                    </tr>
                    <?php endif; ?>

                    <?php foreach ($stocks as $stock): ?>
                    <tr class="hover:bg-gray-50">

                        <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800"><?= $stock['vaccine_name'] ?>
                        </td>
                        <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800"><?= $stock['quantity'] ?></td>
                        <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800"><?= $stock['batch'] ?></td>
                        <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800"><?= $stock['expiration_date'] ?>
                        </td>
                        <td class="px-2 py-2 border-b text-xs md:text-xs flex gap-2 flex-col md:flex-row">

                            <a class="h-full border-blue-500 border-2 text-blue-500 px-3 py-1 md:text-sm rounded-md transition all hover:bg-blue-500 hover:text-white flex gap-2 items-center" ">Editar <i class="
                                fa-solid fa-pencil"></i>
                            </a>

                            <a
                                class="h-full border-red-500 border-2 text-red-500 px-3 py-1 md:text-sm rounded-md transition all hover:bg-red-500 hover:text-white flex gap-2 items-center">Excluir
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                        <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800">
                            <?php 
        $lastUpdated = new DateTime($stock['last_updated']);
        echo $lastUpdated->format('d/m/Y - H:i:s');
    ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>


</body>

</html>