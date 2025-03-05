<?php

session_start();

if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
    header('Location: ../admin');
    exit;
}

if (!isset($_SESSION['cpf'])) {
    header('Location: ./login.php');
}

require_once "../routes/db-connection.php";

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
    <script src="https://kit.fontawesome.com/c8e307d42e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="../assets/img/icon.png">
    <title>My Vaccine</title>
</head>

<body class="overflow-x-hidden text-[#100E3D]">
    <nav class="px-[6%] h-[8vh] flex justify-between items-center shadow-lg navbar text-[#100E3D] relative">
        <a href="/"><img src="../assets/img/logo.png" alt="logo" class="md:hidden w-[190px]" /></a>


        <!-- Desktop Menu -->
        <div class="hidden md:block w-full">

            <div class="flex w-full justify-between">
                <a href="../index.php"><img src="../assets/img/logo.png" alt="logo"
                        class="hidden md:block w-[190px]" /></a>
                <ul class="flex gap-12 uppercase text-[12px] transition-all">
                    <li class="cursor-pointer hover:font-semibold">
                        <a href="../index.php" class="cursor-pointer">home</a>
                    </li>
                    <li class="flex flex-col items-center">
                        <a href="./pages/posts.php" class="cursor-pointer font-semibold">postos de vacinação</a>
                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                    </li>
                    <li class="cursor-pointer hover:font-semibold">
                        <a href="./vaccines.php" class="cursor-pointer">Histórico de vacinas</a>
                    </li>
                </ul>

                <?php if(isset($_SESSION['cpf'])): ?>
                <div class="flex items-center gap-4">
                    <span class="text-gray-700 text-sm font-semibold">Olá,
                        <?= htmlspecialchars($_SESSION['name']); ?>!</span>
                    <a href="./routes/logout.php"
                        class="bg-red-500 text-white px-4 py-2 text-xs md:text-sm rounded-md hover:bg-red-600 cursor-pointer">
                        Sair
                    </a>
                </div>
                <?php else: ?>
                <a href="./pages/login.php"
                    class="bg-blue-500 text-white px-4 py-2 text-xs md:text-sm rounded-md hover:bg-blue-600 cursor-pointer">
                    Login
                </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Mobile Menu Button -->
        <button class="block md:hidden" onclick="toggleMenu()">
            <i class="fa-solid fa-bars text-xl"></i>
        </button>

        <!-- Mobile Menu -->
        <div id="mobileMenu"
            class="hidden absolute top-[8vh] left-0 w-full bg-white shadow-md md:hidden flex flex-col items-center p-4">
            <ul class="flex flex-col items-center gap-4 text-[14px]">
                <li class="cursor-pointer font-semibold"><a href="#">Home</a></li>
                <li class="cursor-pointer hover:font-semibold"><a href="./pages/posts.php">Postos de Vacinação</a></li>
                <li class="cursor-pointer hover:font-semibold">Histórico de Vacinas</li>
                <li class="cursor-pointer hover:font-semibold">Sobre</li>
            </ul>
            <div class="mt-4">
                <?php if(isset($_SESSION['cpf'])): ?>
                <a href="./routes/logout.php"
                    class="bg-red-500 text-white px-4 py-2 text-sm rounded-md hover:bg-red-600 cursor-pointer">
                    Sair
                </a>
                <?php else: ?>
                <a href="./pages/login.php"
                    class="bg-blue-500 text-white px-4 py-2 text-sm rounded-md hover:bg-blue-600 cursor-pointer">
                    Login
                </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <body>
        <main class="h-[70vh] flex flex-col px-[6%] gap-[32px] my-[4rem] items-center">

            <div class="w-[600px] flex flex-col gap-3">
                <h1 class="text-[24px] text-center font-bold">Pesquisar postos de saúde</h1>
                <input id="searchInput" class="text-[16px] w-full p-3 border-[1px] rounded-[16px] border-black"
                    type="text" placeholder="Insira o estado que deseja pesquisar. Ex: SP">

            </div>


            <table class="min-w-full max-w-[100vw] bg-white border border-gray-200 shadow-md text-nowrap">
                <thead>
                    <tr class="bg-[#EEEEEE] text-left text-xs md:text-sm text-[#B5B7C0]">
                        <th class="font-light border-b py-2 px-6">Nome do Posto
                        </th>
                        <th class="font-light p-2 border-b w-1/4">Rua</th>
                        <th class="font-light p-2 border-b w-1/4">Cidade</th>
                        <th class="font-light p-2 ">Estado</th>
                        <th class="font-light p-2">Ações</th>
                    </tr>
                </thead>
                <tbody>

                    <?php if (empty($posts)): ?>
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-400">Nenhum posto cadastrado!</td>
                    </tr>
                    <?php endif; ?>
                    <?php foreach ($posts as $post): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-2 border-b text-xs md:text-sm text-gray-800"><?= $post['name'] ?></td>
                        <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800"><?= $post['address'] ?></td>
                        <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800"><?= $post['city'] ?></td>
                        <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800"><?= $post['state'] ?></td>
                        <td class="px-2 py-2 border-b text-xs md:text-xs flex gap-2 flex-col md:flex-row">

                            <a href="./vaccines.php?id=<?= $post['id']; ?>"
                                class="border-blue-500 border-2 text-blue-500 px-3 py-1 md:text-sm rounded-md transition all hover:bg-blue-500 hover:text-white flex gap-2 items-center">Visualizar
                                vacinas
                                <i class="fa-solid fa-syringe"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </main>
        <script src="../assets/js/index.js"></script>
        <script src="../assets/js/filter.js"></script>
    </body>

</html>