<?php
    session_start();
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
    <title>Carteira de vacinação</title>
</head>

<body class="bg-gray-100 h-screen">

    <?php
     include '../components/navbaruser.php'
     ?>

    <section class="w-[75vw] flex flex-col gap-[5vh] mt-[5vh] mx-auto">
        <div class="flex justify-between">
            <h1 class="text-xl md:text-3xl">Carteira de Vacinas</h1>
        </div>
        <div class="overflow-x-auto w-full">
        <table class="min-w-full bg-white border border-gray-200 shadow-md">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border-b text-left text-xs md:text-sm font-medium text-gray-600">Data</th>
                    <th class="px-2 py-2 border-b text-left text-xs md:text-sm font-medium text-gray-600">Vacina</th>
                    <th class="px-2 py-2 border-b text-left text-xs md:text-sm font-medium text-gray-600">Lote</th>
                    <th class="px-2 py-2 border-b text-left text-xs md:text-sm font-medium text-gray-600">Carimbo</th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b text-xs md:text-sm text-gray-800">""</td>
                    <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800">""</td>
                    <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800">""</td>
                    <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800">""</td>
                </tr>
    
            </tbody>
        </table>
</div>
    </section>

</body>

</html>