<?php

session_start();
require_once "../routes/db-connection.php";

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/style/style.css" />
    <script src="https://kit.fontawesome.com/c8e307d42e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="./assets/img/icon.png">
    <title>Gerenciamento de Postos</title>
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
                    <i class="fa-solid fa-house-medical text-[20px] text-gray-400 hover:text-black"></i>
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
            <a href="">
                <i class="fa-solid fa-gear text-[20px] text-black transition all"></i>
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
                <h1 class="text-xl md:text-3xl">Configurações gerais</h1>
                <div class="flex gap-6">
                </div>
            </div>

            <section class="flex flex-col gap-3">
                <button onclick="alert(`Funcionalidade desabilitada.`)" class="px-6 py-2 border-2 border-red-500 text-red-500 rounded-md hover:text-white hover:bg-red-500 transition-all">Apagar todos os postos</button>
                <button onclick="alert(`Funcionalidade desabilitada.`)" class="px-6 py-2 border-2 border-red-500 text-red-500 rounded-md hover:text-white hover:bg-red-500 transition-all">Apagar todos os registros de vacina</button>
            </section>

        </div>
    </section>
    <script src="../assets/js/index.js"></script>
</body>

</html>