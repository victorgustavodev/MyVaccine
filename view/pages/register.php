<!DOCTYPE html>
<html>
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
  </head>
  <body class="overflow-x-hidden">
    
    <!-- navbar -->
    <?php include '../layout/navbar-visit.php'; ?>

    <div class="w-full flex">
      <!-- left login -->
      <section
        class="flex justify-center items-center w-full lg:w-[60vw] h-[92vh]"
      >
        <form
          action=""
          class="flex flex-col gap-3 px-6 mt-[25vh] md:mt-0 lg:px-[32px] py-6 m:py:0 w-full lg:w-4/6 justify-center"
        >
          <h1 class="text-2xl font-semibold">Cadastro</h1>

          <!-- Nome Completo -->
          <div class="flex flex-col gap-2">
            <label for="name">Nome Completo:</label>
            <input
              type="text"
              name="name"
              id="name"
              class="border-2 p-3 rounded-lg"
              placeholder="Digite seu nome completo"
            />
          </div>

          <!-- Email -->
          <div class="flex flex-col gap-2">
            <label for="email">Email:</label>
            <input
              type="email"
              name="email"
              id="email"
              class="border-2 p-3 rounded-lg"
              placeholder="Digite seu email"
            />
          </div>

          <!-- CPF -->
          <div class="flex flex-col gap-2">
            <label for="cpf">CPF:</label>
            <input
              type="text"
              name="cpf"
              id="cpf"
              class="border-2 p-3 rounded-lg"
              placeholder="Digite seu CPF"
            />
          </div>

          <!-- Data de Nascimento -->
          <div class="flex flex-col gap-2">
            <label for="dob">Data de Nascimento:</label>
            <input
              type="date"
              name="dob"
              id="dob"
              class="border-2 p-3 rounded-lg"
            />
          </div>

          <!-- Senha -->
          <div class="flex flex-col gap-2">
            <label for="password">Senha:</label>
            <input
              type="password"
              name="password"
              id="password"
              class="border-2 p-3 rounded-lg"
              placeholder="Digite sua senha"
            />
          </div>

          <!-- Confirmar Senha -->
          <div class="flex flex-col gap-2">
            <label for="confirm-password">Confirmar Senha:</label>
            <input
              type="password"
              name="confirm-password"
              id="confirm-password"
              class="border-2 p-3 rounded-lg"
              placeholder="Confirme sua senha"
            />
          </div>

          <!-- Botões -->
          <div
            class="flex flex-col sm:flex-row gap-3 w-full text-xs md:text-base text-center sm:text-start mt-5"
          >
            <input
              type="submit"
              value="Cadastrar"
              class="bg-[#0B5FFF] text-white font-semibold py-4 px-10 rounded-lg hover:bg-[#074DD2] cursor-pointer"
            />
            <a
              href="login.php"
              class="bg-[#000A2E] text-white font-semibold py-4 px-10 rounded-lg hover:bg-[#1A2C6F]"
            >
              Já possuo conta
            </a>
          </div>
        </form>
      </section>

      <!-- right login -->
      <div
        class="flex lg:w-[40vw] hidden lg:block"
        style="
          background-image: url(../../assets/img/bg-login.png);
          background-repeat: no-repeat;
          background-size: cover;
        "
      ></div>
    </div>
    <script src="../../assets/js/script.js"></script>

  </body>
</html>
