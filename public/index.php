<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <script src="https://kit.fontawesome.com/c8e307d42e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <title>Responsive Navbar</title>
</head>

<body class="overflow-x-hidden">
    <!-- navbar.php -->
    <navbar class="px-[6%] h-[10vh] flex justify-between items-center shadow-lg navbar">
        <a href="index.php"><img src="../../assets/img/logo.svg" alt="logo" class="w-[190px]" /></a>
        <button class="text-xl md:text-2xl" onclick="toggleMenu()">
            <i class="fa-solid fa-bars"></i>
        </button>
    </navbar>

    <!-- Menu -->
    <div id="menu"
        class="absolute top-[10vh] right-0 h-fit w-full lg:w-fit rounded-lg flex justify-center items-center bg-white shadow-lg p-10 transform translate-x-full opacity-0 transition-all duration-500 ease-in-out">
        <ul class="flex flex-col items-center space-y-4 text-lg font-semibold">
            <li>
                <a href="index.php" class="px-6 py-2 hover:bg-gray-100 rounded-lg transition-colors">Home</a>
            </li>
            <li>
                <a href="../view/pages/login.php" class="px-6 py-2 hover:bg-gray-100 rounded-lg transition-colors">Fazer login</a>
            </li>
            <li>
                <a href="./view/pages/register.php" class="px-6 py-2 hover:bg-gray-100 rounded-lg transition-colors">Criar conta</a>
            </li>

        </ul>
        <!-- Botão para fechar o menu -->
        <button class="absolute top-4 right-4 text-2xl text-gray-700" onclick="toggleMenu()">
            <i class="fa-solid fa-x"></i>
        </button>
    </div>
    </navbar>


    <main class="flex flex-col gap-8 px-8 mb-10 mt-14">
        <h1 class="uppercase font-bold text-2xl text-[#100E3D]">Conheça mais sobre nosso sistema</h1>
        <p>Welcome to <span class="font-bold text-[#100E3D]">MyVaccine</span>, where we are dedicated to providing
            personalized and compassionate healthcare.</p>


        <div class="grid grid-cols-2 gap-4">
            <!-- #1 -->
            <div class="flex flex-col gap-2 p-4 shadow-lg rounded-2xl justify-center items-center text-center">
                <i class="fa-solid fa-notes-medical text-xl"></i>
                <h1 class="font-bold">Dependentes</h1>
                <p class="text-sm">branch of medicine that concerns.</p>
            </div>
            <!-- #2 -->
            <div class="flex flex-col gap-2 p-4 shadow-lg rounded-2xl justify-center items-center text-center">
                <i class="fa-solid fa-suitcase-medical text-xl"></i>
                <h1 class="font-bold">Dependentes</h1>
                <p class="text-sm">branch of medicine that concerns.</p>
            </div>
            <!-- #3 -->
            <div class="flex flex-col gap-2 p-4 shadow-lg rounded-2xl justify-center items-center text-center">
                <i class="fa-solid fa-syringe text-xl"></i>
                <h1 class="font-bold">Dependentes</h1>
                <p class="text-sm">branch of medicine that concerns.</p>
            </div>
            <!-- #4 -->
            <div class="flex flex-col gap-2 p-4 shadow-lg rounded-2xl justify-center items-center text-center">
                <i class="fa-solid fa-bandage text-xl"></i>
                <h1 class="font-bold">Dependentes</h1>
                <p class="text-sm">branch of medicine that concerns.</p>
            </div>
        </div>

        <div class="w-full flex justify-center mt-4">
            <a href="../view/pages/register.php"
                class="bg-[#100E3D] hover:bg-[#292669] transition-all px-4 text-white text-center py-4 w-fit rounded-md">
                Acessar sistema
            </a>
        </div>

        <section>
            <div class="flex gap-4 justify-center py-8">
                <div class="flex flex-col gap-1 text-center">
                    <span class="font-bold text-[#100E3D]">240</span>
                    <p class="text-sm font-semibold">Best Doctor</p>
                </div>
                <div class="flex flex-col gap-1 text-center">
                    <span class="font-bold text-[#100E3D]">240</span>
                    <p class="text-sm font-semibold">Best Doctor</p>
                </div>
                <div class="flex flex-col gap-1 text-center">
                    <span class="font-bold text-[#100E3D]">240</span>
                    <p class="text-sm font-semibold">Best Doctor</p>
                </div>
            </div>
            <div class="bg-[#100E3D] px-6 py-10 justify-between gap-4 rounded-lg text-white flex ">
                <h1 class="font-semibold text-nowrap">Emergency Call</h1>
                <p class="text-[8px] text-right">you are about to initiate an emergency call, confirm.</p>
            </div>
        </section>

        <img src="../../assets/img/family-mobile.png" alt="family" class="w-fit">

        <h1 class="font-bold text-center text-[#100E3D] text-xl">Gerencie seus dependentes</h1>
    </main>

    <footer class="w-full flex justify-evenly items-center mt-10 py-5" style="box-shadow: 0px -1px 10px 0px #00000047">
        <img src="../../assets/img/logo.svg" class="w-40" alt="logo">
        <span class="text-[10px] font-semibold">© 2024 Todos os direitos reservados</span>
    </footer>

    <!-- script -->
    <script src="../../assets/js/script.js"></script>
</body>

</html>