<?php

session_start();

if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
    header('Location: ./admin');
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/c8e307d42e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="./assets/img/icon.png">
    <title>My Vaccine</title>
</head>

<body class="overflow-x-hidden text-[#100E3D]">
    <nav class="px-[6%] h-[8vh] flex justify-between items-center shadow-lg navbar text-[#100E3D]">
        <a href="/"><img src="./assets/img/logo.png" alt="logo" class="w-[190px]" /></a>
        <ul class="flex gap-12 uppercase text-[12px] transition-all">

            <li class="flex flex-col items-center">
                <a class="cursor-pointer font-semibold">home</a>
                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
            </li>
            <li class="cursor-pointer hover:font-semibold"><a href="./pages/posts.php">postos</a></li>
            <li class="cursor-pointer hover:font-semibold">histórico de vacinas</li>
            <li class="cursor-pointer hover:font-semibold">sobre</li>
        </ul>

        <?php if(isset($_SESSION['user_id'])): ?>
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
    </nav>

    <body>
        <main class="h-[70vh] flex justify-center px-[6%] gap-[32px] my-[4rem">

            <div class="flex flex-col justify-center gap-6 max-w-[640px]">
                <h1 class="font-bold text-[40px]">Experienced <span class="text-blue-400">mobile and web</span>
                    applications and website builders measuring.</h1>
                <p class="text-gray-400">KODEX TECHNOLOGY (PVT) LTD is a team of experienced mobile and web applications
                    and website builders measuring dozens of completed projects. We build and develop mobile
                    applications for several top platforms, including Android & IOS.</p>
                <div class="transition-all">
                    <button
                        class="bg-blue-500 text-white px-8 py-2 text-xs md:text-sm rounded-md hover:bg-white border-[1px] border-white hover:border-blue-500 hover:text-blue-500 cursor-pointer">Contact
                        us</button>
                </div>
            </div>

            <div class="flex justify-center items-center">
                <img src="./assets/img/vetor-main.jpg" alt="" class="max-w-[700px] max-h-[467px]">
            </div>
        </main>

        <section class="px-[6%] py-[4rem]">
            <ul class="flex gap-[80px] justify-center">

                <li class="flex gap-4 justify-center items-center">
                    <img src="./assets/img/check-heart-icon.png" alt="">
                    <span class="flex flex-col gap-1">
                        <p class="font-semibold text-[20px]">Web Application</p>
                        <p class="text-[15px] text-gray-400">Web Application Web</p>
                    </span>
                </li>
                <li class="flex gap-4 justify-center items-center">
                    <img src="./assets/img/syringe-vaccine-icon.png" alt="">
                    <span class="flex flex-col gap-1">
                        <p class="font-semibold text-[20px]">Web Application</p>
                        <p class="text-[15px] text-gray-400">Web Application Web</p>
                    </span>
                </li>
                <li class="flex gap-4 justify-center items-center">
                    <img src="./assets/img/health-check-icon.png" alt="">
                    <span class="flex flex-col gap-1">
                        <p class="font-semibold text-[20px]">Web Application</p>
                        <p class="text-[15px] text-gray-400">Web Application Web</p>
                    </span>
                </li>
            </ul>
        </section>

        <!-- image in right -->

        <section class="py-[2rem] flex justify-center">
            <div class="w-[1252px] flex justify-between items-center">
                <div class="flex flex-col gap-8 max-w-[516px] pr-8">
                    <h1 class="font-bold text-[30px]"><span class="text-blue-400">Lorem Ipsum</span> is simply dummy
                        text of
                        the printing. </h1>
                    <p class="text-[16px]">KODEX TECHNOLOGY (PVT) LTD is a team of experienced mobile and web
                        applications
                        and website builders
                        measuring dozens of completed projects. We build and develop mobile applications for several top
                        platforms, including Android & IOS. </p>
                </div>

                <img src="./assets/img/cellphone.png" alt="">
            </div>

        </section>

        <!-- image in left -->

        <section class="py-[2rem] flex justify-center">
            <div class="w-[1252px] flex justify-between items-center">


                <figure class="w-full"><img src="./assets/img/cellphone-2.png" alt=""></figure>

                <div class="flex flex-col gap-8 max-w-[516px] pl-8">
                    <h1 class="font-bold text-[30px]"><span class="text-blue-400">Lorem Ipsum</span> is simply dummy
                        text of
                        the printing. </h1>
                    <p class="text-[16px]">KODEX TECHNOLOGY (PVT) LTD is a team of experienced mobile and web
                        applications
                        and website builders
                        measuring dozens of completed projects. We build and develop mobile applications for several top
                        platforms, including Android & IOS. </p>
                </div>

            </div>

        </section>

        <!-- image in right -->

        <section class="py-[2rem] flex justify-center">
            <div class="w-[1252px] flex justify-between items-center">
                <div class="flex flex-col gap-8 max-w-[516px] pr-8">
                    <h1 class="font-bold text-[30px]"><span class="text-blue-400">Lorem Ipsum</span> is simply dummy
                        text of
                        the printing. </h1>
                    <p class="text-[16px]">KODEX TECHNOLOGY (PVT) LTD is a team of experienced mobile and web
                        applications
                        and website builders
                        measuring dozens of completed projects. We build and develop mobile applications for several top
                        platforms, including Android & IOS. </p>
                </div>

                <img src="./assets/img/cellphone.png" alt="">
            </div>

        </section>

    </body>

    <script src="./assets/js/index.js"></script>
</body>

</html>