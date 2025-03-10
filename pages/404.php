<?php

session_start();

if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin') {
    header('Location: ./admin');
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
    <link rel="icon" type="image/x-icon" href="../assets/img/icon.png">
    <title>404 - Not Found</title>
</head>

<body class="overflow-x-hidden text-[#100E3D]">

    <nav class="px-[6%] h-[8vh] flex justify-between items-center shadow-lg navbar text-[#100E3D] relative">
        <a href="../index.php"><img src="../assets/img/logo.png" alt="logo" class="md:hidden w-[190px]" /></a>


        <!-- Desktop Menu -->
        <div class="hidden md:block w-full">

            <div class="flex w-full justify-between">
                <a href="../index.php"><img src="../assets/img/logo.png" alt="logo" class="md:hidden w-[190px]" /></a>
                <ul class="flex gap-12 uppercase text-[12px] transition-all">
                    <li class="flex flex-col items-center">
                        <a href="../index.php" class="cursor-pointer font-semibold">home</a>
                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                    </li>
                    <a href="./posts.php" class="cursor-pointer hover:font-semibold">postos de vacinação</a>
                    <a href="./vaccines.php" class="cursor-pointer hover:font-semibold">histórico de vacinas</a>

                </ul>

                <?php if (isset($_SESSION['cpf'])): ?>
                <div class="flex items-center gap-4">
                    <span class="text-gray-700 text-sm font-semibold">Olá,
                        <?= ($_SESSION['name']); ?>
                    </span>
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
            class="hidden absolute top-[8vh] right-0 w-2/3 rounded-br-lg rounded-bl-lg bg-white shadow-md md:hidden flex flex-col items-center p-4">
            <ul class="flex flex-col items-center gap-4 text-[14px]">
                <li class="cursor-pointer hover:font-semibold"><a href="../index.php">Home</a></li>
                <li class="cursor-pointer hover:font-semibold"><a href="./posts.php">Postos de Vacinação</a>
                </li>
                <li class="cursor-pointer hover:font-semibold"><a href="./history-vaccine.php">Histórico de
                        vacinação</a></li>
            </ul>
            <div class="mt-6 mb-3">
                <?php if(isset($_SESSION['cpf'])): ?>
                <a href="../routes/logout.php"
                    class="bg-red-500 text-white px-4 py-2 text-sm rounded-md hover:bg-red-600 cursor-pointer">
                    Sair
                </a>
                <?php else: ?>
                <a href="./login.php"
                    class="bg-blue-500 text-white px-4 py-2 text-sm rounded-md hover:bg-blue-600 cursor-pointer">
                    Login
                </a>
                <?php endif; ?>
            </div>

        </div>
    </nav>

    <main class="w-full flex items-center flex-col">
        <section class="max-w-[1200px] flex flex-col items-center gap-6 my-10 text-center">
            <figure>
                <img src="../assets/img/404.jpg" class="hidden md:block md:w-[300px]"
                    alt="Imagem do Zé Gotinha triste" />
            </figure>

            <p class="text-[20px]">Ops! A página que você está procurando não foi encontrada.</p>
            <a href="./index.php"
                class="bg-[#0B5FFF] text-white text-center font-semibold py-4 px-6 rounded-lg hover:bg-[#074DD2] cursor-pointer">
                Voltar para a página inicial
            </a>
        </section>
    </main>

    <footer class=" bg-[#100E3D] text-white py-8 md:mt-12 px-[6%]">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
            <!-- Logo e Nome -->
            <div class="flex flex-col items-center md:items-start">
                <img src="./assets/img/logo-white.png" alt="Logo My Vaccine" class="w-40 mb-2">
                <p class="text-sm text-gray-400">Facilitando o acesso à vacinação.</p>
            </div>

            <!-- Links -->
            <div class="flex flex-wrap justify-center gap-6 mt-6 md:mt-0">
                <a href="../index.php" class="text-sm hover:underline">Home</a>
                <a href="./posts.php" class="text-sm hover:underline">Postos de Vacinação</a>
                <a href="./history-vaccine.php" class="text-sm hover:underline">Histórico de Vacinas</a>
            </div>

            <!-- Redes Sociais -->
            <div class="flex gap-4 mt-6 md:mt-0">
                <button href="" class="text-gray-400 hover:text-white text-xl"><i class="fab fa-facebook"></i></button>
                <button href="" class="text-gray-400 hover:text-white text-xl"><i class="fab fa-instagram"></i></button>
                <button href="" class="text-gray-400 hover:text-white text-xl"><i class="fab fa-twitter"></i></button>
            </div>
        </div>

        <!-- Direitos Autorais -->
        <div class="text-center text-gray-400 text-xs mt-6 border-t border-gray-600 pt-4">
            &copy; 2025 My Vaccine. Todos os direitos reservados.
        </div>

    </footer>


    <script src="../../assets/js/script.js"></script>
</body>

</html>

<style>
html,
body {
    height: 100%;
    display: flex;
    flex-direction: column;
}

main {
    flex-grow: 1;
}
</style>

<script>
function toggleMenu() {
    document.getElementById('mobileMenu').classList.toggle('hidden');
}
</script>