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
    <link rel="icon" type="image/x-icon" href="./assets/img/icon.png">
    <title>404 - Not Found</title>
  </head>
  <body class="overflow-x-hidden text-[#100E3D]">

  <navbar class="px-[6%] h-[8vh] flex justify-between items-center shadow-lg navbar text-[#100E3D]">
        <!-- logo -->
        <a href="../index.php"><img src="../assets/img/logo.png" alt="logo" class="w-[190px]" /></a>
        <!-- options -->
        <div class="flex gap-[64px] text-[16px]">
            <ul class="flex gap-4 transition-all duration-500 ease-in-out">
                <li><a href="../index.php" class="hover:underline text-xs  md:text-base">Voltar para página principal</a></li>
            </ul>
        </div>
    </navbar>

    <main class="w-full flex items-center flex-col">
      <section class="max-w-[1200px] flex flex-col items-center gap-6 my-10 text-center">
        <figure>
          <img src="../assets/img/zeGotinha.png" class="w-[150px] h-[150px]" alt="Imagem do Zé Gotinha triste" />
        </figure>
        <h1 class="text-[48px] font-bold text-[#d9534f] uppercase">404</h1>
        <p class="text-[20px]">Ops! A página que você está procurando não foi encontrada.</p>
        <a href="../index.php"
          class="bg-[#0B5FFF] text-white text-center font-semibold py-4 px-6 rounded-lg hover:bg-[#074DD2] cursor-pointer">
          Voltar para a página inicial
        </a>
      </section>
    </main>

    <footer class="w-full text-center text-[10px]">
      Copyright © 2025. MyVaccine. Todos os direitos reservados.
    </footer>

    <script src="../../assets/js/script.js"></script>
  </body>
</html>