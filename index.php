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
    <title>Responsive Navbar</title>
</head>

<body class="overflow-x-hidden text-[#100E3D]">
    <navbar class="px-[6%] h-[8vh] flex justify-between items-center shadow-lg navbar text-[#100E3D]">
        <a href="/"><img src="./assets/img/logo.png" alt="logo" class="w-[190px]" /></a>
        <div class="flex gap-[32px] text-[16px]">
            <ul class="flex gap-4 transition-all duration-500 ease-in-out">
                <li><a href="../../public/index.php" class="hover:underline">Home</a></li>
                <li><a href="../pages/dependentes.php" class="hover:underline">Dependentes</a></li>
                <li><a href="../pages/postos.php" class="hover:underline">Posto de saúde</a></li>
            </ul>

            <!-- NAVBAR -->

            <?php if (isset($_SESSION['user_id'])): ?>
            <div class="flex gap-4">
                <p>Seja bem-vindo,<span class="font-bold"> <?= htmlspecialchars($_SESSION['name']); ?></span> </p>
                <a href="./routes/logout.php" class="font-bold text-red-500">Sair da conta</a>
            </div>
            <?php else: ?>
                <a href="./pages/login.php" class="font-bold">Login</a>
            <?php endif; ?>

        </div>
    </navbar>

    <main class="w-full flex items-center flex flex-col">
        <section class="max-w-[1200px] flex justify-center items-center gap-[180px] my-10">
            <div class="w-2/3 flex flex-col gap-[24px]">
                <h1 class="text-[58px] font-bold mt-10 uppercase">conheça mais sobre nosso sistema</h1>

                <p class="text-[20px]">O <span class="font-bold">MyVaccine</span> é uma plataforma digital destinada a
                    facilitar o acesso, o agendamento e o acompanhamento das vacinas públicas. O sistema visa otimizar a
                    gestão de campanhas de vacinação, promovendo a educação em saúde e melhorando a comunicação entre
                    cidadãos e unidades de saúde.</p>

            </div>

            <div class="w-1/3 flex justify-center items-center">
                <figure>
                    <img src="./assets/img/zeGotinha.png" class="w-[300px] h-[300px]" alt="imagem do zé gotinha">
                </figure>
            </div>
        </section>

        <section class="max-w-[1200px] flex justify-center items-center gap-[180px] my-10">

            <div class="flex flex-col gap-2 px-8 py-6 text-center w-4/6 shadow-md rounded-[8px] h-[200px] border-[1px]">
                <figure><i class="fa-solid fa-address-book text-[40px]"></i></figure>
                <h3 class="text-[20px] font-bold">Cadastro de Dependentes</h3>
                <p class="text-[12px]">Cadastre seus dependentes e acompanhe suas vacinas.</p>
            </div>

            <div class="flex flex-col gap-2 px-8 py-6 text-center w-4/6 shadow-md rounded-[8px] h-[200px] border-[1px]">
                <figure><i class="fa-regular fa-hospital text-[40px]"></i></i></figure>

                <h3 class="text-[20px] font-bold">Postos de vacinação</h3>
                <p class="text-[12px]">Localização dos postos de saúde próximos da sua casa.</p>
            </div>

            <div class="flex flex-col gap-2 px-8 py-6 text-center w-4/6 shadow-md rounded-[8px] h-[200px] border-[1px]">
                <figure><i class="fa-solid fa-syringe text-[40px]"></i></i></i></figure>
                <h3 class="text-[20px] font-bold">Cartilha de Vacinação</h3>
                <p class="text-[12px]"> Informações sobre vacinas, sequência e datas de reforço.</p>
            </div>
        </section>
    </main>

    <footer class="w-full text-center text-[10px]">Copyright © 2025. MyVaccine. Todos os direitos reservados.</footer>

    <script src="../../assets/js/script.js"></script>
</body>

</html>