<?php

session_start();
require_once "../routes/db-connection.php";

// Verifica se o usuário não está logado ou não tem o papel de 'admin'

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
   echo "Acesso restrito. Você precisa ser administrador para acessar esta página.";
    exit;
}

// Prepara a consulta para buscar todos os vacinas
$stmt = $pdo->prepare("SELECT * FROM vaccines");
$stmt->execute();
$vaccines = $stmt->fetchAll(PDO::FETCH_ASSOC); // Recupera todos os registros

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
    <title>Gerenciamento de vacinas</title>
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
                    <i class="fa-solid fa-syringe text-[20px] text-black"></i>
                </a>
            </div>

            <!-- barrinha -->
            <span class="h-[1px] w-full bg-gray-300 rounded-full"></span>

            <span class="uppercase text-xs text-gray-300 font-semibold">config</span>

            <!-- configs -->
            <a href="">
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
                <h1 class="text-xl md:text-3xl">Painel de vacinas</h1>
                <a href="../vaccines/create-vaccine.php"
                    class="bg-blue-500 text-white px-4 py-2 text-xs md:text-sm rounded-md hover:bg-blue-600">
                    Cadastrar nova vacina
                </a>
            </div>

            <table class="min-w-full max-w-[100vw] bg-white border border-gray-200 shadow-md text-nowrap">
                <thead>
                    <tr class="bg-[#EEEEEE] text-left text-xs md:text-sm text-[#B5B7C0]">
                        <th class="font-light py-3 px-6 text-center w-[10%] border-b">ID</th>
                        <th class="font-light border-b">Nome</th>
                        <th class="font-light px-6 py-2 border-b">Idade mín / max</th>
                        <th class="font-light px-6 py-2 border-b">Validade</th>
                        <th class="font-light px-6 py-2 border-b w-full">Contraindicações</th>
                        <th class="font-light px-6 py-2 border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($vaccines)): ?>
                    <tr>
                        <td colspan="7" class="px-4 py-4 text-center text-gray-400">Nenhuma vacina cadastrada!</td>
                    </tr>
                    <?php endif; ?>

                    <?php foreach ($vaccines as $vaccine): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="w-[10%] py-3 border-b text-center text-xs md:text-sm text-gray-800">
                            <?= $vaccine['id'] ?></td>
                        <td class="py-2 border-b text-xs md:text-sm text-gray-800"><?= $vaccine['name'] ?></td>
                        <td class="px-6 border-b py-2 text-xs md:text-sm text-gray-800"><?= $vaccine['min_age'] ?> ano(s) / <?= $vaccine['max_age'] ?> anos</td>
                        <td class="px-6 border-b py-2 text-xs md:text-sm text-gray-800"><?= $vaccine['validate'] ?></td>
                        <td class="px-6 border-b py-2 text-xs md:text-sm text-gray-800 w-full text-wrap">
                            <?= $vaccine['contraindications'] ?> Não administrar em imunodeprimidos Não administrar em imunodeprimidos Não administrar em imunodeprimidos Não administrar em imunodeprimidosNão administrar em imunodeprimidosNão administrar em imunodeprimidosNão administrar em imunodeprimidos</td>
                        <td class="px-2 py-2 border-b text-xs md:text-xs flex flex-col md:flex-row gap-2 items-center justify-center">
                            <a href="../vaccines/update-vaccine.php?id=<?= $vaccine['id']; ?>"
                                class="border-blue-500 border-2 text-blue-500 px-3 py-1 md:text-sm rounded-md transition all hover:bg-blue-500 hover:text-white flex gap-2 items-center">
                                Editar <i class="fa-solid fa-pencil"></i>
                            </a>
                            <a href="../vaccines/delete-vaccine.php?id=<?= $vaccine['id']; ?>"
                                class="border-red-500 border-2 text-red-500 hover:bg-red-500 hover:text-white px-3 py-1 rounded-md">
                                Excluir <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>


</body>

</html>