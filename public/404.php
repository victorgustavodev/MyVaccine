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
    <title>404 - Página Não Encontrada</title>
  </head>
  <body class="overflow-x-hidden text-[#100E3D]">
    <?php include "../view/layout/navbar-visit.php" ?>

    <main class="w-full flex items-center flex-col">
      <section class="max-w-[1200px] flex flex-col items-center gap-6 my-10 text-center">
        <figure>
          <img src="../assets/img/zeGotinha.png" class="w-[150px] h-[150px]" alt="Imagem do Zé Gotinha triste" />
        </figure>
        <h1 class="text-[48px] font-bold text-[#d9534f] uppercase">404</h1>
        <p class="text-[20px]">Ops! A página que você está procurando não foi encontrada.</p>
        <a href="/"
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
