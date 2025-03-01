<?php

session_start();

if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
    header('Location: ../admin');
    exit;
}

if (!isset($_SESSION['user_id'])) {
    header('Location: ./login.php');
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
    <nav class="px-[6%] h-[8vh] flex justify-between items-center shadow-lg navbar text-[#100E3D]">
        <a href="/"><img src="../assets/img/logo.png" alt="logo" class="w-[190px]" /></a>
        <ul class="flex gap-12 uppercase text-[12px] transition-all">

            <a href="../index.php" class="cursor-pointer hover:font-semibold">home</a>

            <li class="flex flex-col items-center">
                <a class="cursor-pointer font-semibold">postos</a>
                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
            </li>
            <li class="cursor-pointer hover:font-semibold">histórico de vacinas</li>
        </ul>

        <?php if(isset($_SESSION['user_id'])): ?>
        <div class="flex items-center gap-4">
            <span class="text-gray-700 text-sm font-semibold">Olá,
                <?= htmlspecialchars($_SESSION['name']); ?>!</span>
            <a href="../routes/logout.php"
                class="bg-red-500 text-white px-4 py-2 text-xs md:text-sm rounded-md hover:bg-red-600 cursor-pointer">
                Sair
            </a>
        </div>
        <?php else: ?>
        <a href="../pages/login.php"
            class="bg-blue-500 text-white px-4 py-2 text-xs md:text-sm rounded-md hover:bg-blue-600 cursor-pointer">
            Login
        </a>
        <?php endif; ?>
    </nav>

    <body>
        <main class="h-[70vh] flex flex-col px-[6%] gap-[32px] my-[4rem] items-center">

            <div class="w-[600px] flex flex-col gap-3">
                <h1 class="text-[24px] text-center font-bold">Pesquisar postos de saúde</h1>
                <input class="text-[16px] w-full p-3 border-[1px] rounded-[16px] border-black" type="text" placeholder="Insira o estado que deseja pesquisar. Ex: SP ">
            </div>

        </main <script src="../assets/js/index.js">
        </script>
    </body>

</html>