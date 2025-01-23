<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css" />
    <script
      src="https://kit.fontawesome.com/c8e307d42e.js"
      crossorigin="anonymous"
    ></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <title>Responsive Navbar</title>
  </head>
  <body class="overflow-x-hidden text-[#100E3D]">
  <navbar
      class="px-[6%] h-[8vh] flex justify-between items-center shadow-lg navbar text-[#100E3D]"
    >
      <a href="../../public/index.php"
        ><img src="../assets/img/logo.png" alt="logo" class="w-[190px]"
      /></a>
      <!-- <button class="text-xl md:text-2xl" onclick="toggleMenu()">
        <i class="fa-solid fa-bars"></i>
      </button> -->
<div class="flex gap-[64px] text-[16px]">
      <ul class="flex gap-4 transition-all duration-500 ease-in-out">
        <li><a href="../../public/index.php" class="hover:underline">Home</a></li>
        <li><a href="../pages/dependentes.php" class="hover:underline">Dependentes</a></li>
        <li><a href="../pages/postos.php" class="hover:underline">Posto de saúde</a></li>
      </ul>
      <a href="" class="font-bold hover:text-">Login</a>
      </div>
    </navbar>

    <!-- Menu -->
    <div id="menu" class="absolute top-[10vh] right-0 h-fit w-full lg:w-fit rounded-lg flex justify-center items-center bg-white shadow-lg p-10 transform translate-x-full opacity-0 transition-all duration-500 ease-in-out">
      <ul class="flex flex-col items-center space-y-4 text-lg font-semibold">
        <li>
          <a
            href="index.php"
            class="px-6 py-2 hover:bg-gray-100 rounded-lg transition-colors"
            >Home</a
          >
        </li>
        <li>
          <a
            href="/view/pages/login.php"
            class="px-6 py-2 hover:bg-gray-100 rounded-lg transition-colors"
            >Fazer login</a
          >
        </li>

      </ul>
      <!-- Botão para fechar o menu -->
      <button
        class="absolute top-4 right-4 text-2xl text-gray-700"
        onclick="toggleMenu()"
      >
        <i class="fa-solid fa-x"></i>
      </button>
    </div>
</navbar>

    <main class="w-full flex items-center flex flex-col">
        <section class="max-w-[1200px] flex justify-center items-center gap-[180px] my-10">
            <div class="w-2/3 flex flex-col gap-[24px]">
                <h1 class="text-[58px] font-bold mt-10 uppercase">conheça mais sobre nosso sistema</h1>

                <p class="text-[20px]">O <span class="font-bold">MyVaccine</span> é uma plataforma digital destinada a facilitar o acesso, o agendamento e o acompanhamento das vacinas públicas. O sistema visa otimizar a gestão de campanhas de vacinação, promovendo a educação em saúde e melhorando a comunicação entre cidadãos e unidades de saúde.</p>

                <a href="../view/pages/login.php" class="bg-[#0B5FFF] w-1/3 text-white text-center font-semibold py-4 px-6 rounded-lg hover:bg-[#074DD2] cursor-pointer">Acessar sistema</a>
            </div>

            <div class="w-1/3 flex justify-center items-center">
                <figure>
                    <img src="../assets/img/zeGotinha.png" class="w-[300px] h-[300px]" alt="imagem do zé gotinha">
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
