<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css" />
    <script src="https://kit.fontawesome.com/c8e307d42e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="./assets/img/icon.png">
    <title>Esqueceu a senha?</title>
</head>

<body class="overflow-x-hidden">


    <!-- navbar -->


    <navbar class="px-[6%] h-[8vh] flex justify-between items-center shadow-lg navbar text-[#100E3D]">
        <!-- logo -->
        <a href="../index.php"><img src="../assets/img/logo.png" alt="logo" class="w-[190px]" /></a>
        <!-- options -->
        <div class="flex gap-[64px] text-[16px]">
            <ul class="flex gap-4 transition-all duration-500 ease-in-out">
                <li><a href="../index.php" class="hover:underline">Voltar para página principal</a></li>
            </ul>
        </div>
    </navbar>

    <!-- body -->
    <div class="w-full flex">
        <!-- left forgot password -->
        <section class="flex justify-center items-center w-full lg:w-[60vw] h-[92vh]">
            <form action="" class="flex flex-col gap-6 px-6 lg:px-[32px] w-full lg:w-4/6 justify-center">
                <h1 class="text-2xl font-semibold">Recuperar Senha</h1>
                <p class="text-sm text-gray-600">
                    Digite seu email para receber as instruções de recuperação de senha.
                </p>

                <!-- Email -->
                <div class="flex flex-col gap-2">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="border-2 p-3 rounded-lg"
                        placeholder="Digite seu email" required />
                </div>

                <!-- btn -->
                <div class="flex flex-col sm:flex-row gap-3 w-full text-xs md:text-base text-center sm:text-start">
                    <input type="submit" value="Enviar"
                        class="bg-[#0B5FFF] text-white font-semibold py-4 px-10 rounded-lg hover:bg-[#074DD2] cursor-pointer" />
                    <a href="login.php"
                        class="bg-[#000A2E] text-white font-semibold py-4 px-10 rounded-lg hover:bg-[#1A2C6F]">
                        Voltar ao login
                    </a>
                </div>
            </form>
        </section>

        <!-- right forgot password -->
        <div class="flex lg:w-[40vw] hidden lg:block"
            style="background-image: url(../assets/img/bg-login.png); background-repeat: no-repeat; background-size: cover;">
        </div>
    </div>
    <script src="../../assets/js/script.js"></script>

</body>

</html>