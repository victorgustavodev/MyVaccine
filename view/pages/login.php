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
      <div class="flex lg:w-[40vw] hidden lg:block" style="background-image: url(../../assets/img/bg-login.png); background-repeat: no-repeat; background-size: cover;"> 
      </div>

      <!-- right login -->
      <section class="flex justify-center items-center w-full lg:w-[60vw] h-[90vh]">
        <form
          action=""
          class="flex flex-col gap-3 px-6 lg:px-[32px] w-full lg:w-4/6 justify-center"
        >
          <h1 class="text-2xl font-semibold">Login</h1>

          <div class="flex flex-col gap-2">
            <label for="">Email:</label>
            <input
              type="text"
              name=""
              id=""
              class="border-2 p-3 rounded-lg"
              placeholder="Digite seu email"
            />
          </div>
          <!-- senha -->
          <div class="flex flex-col gap-2">
            <label for="">Senha:</label>
            <input
              type="password"
              name=""
              id=""
              class="border-2 p-3 rounded-lg"
              placeholder="Digite sua senha"
            />
          </div>

          <!-- forgot password -->
           <a href="forgot-password.php" class="text-end text-cyan-500 hover:underline">Esqueceu a senha?</a>

          <!-- btn -->
          <div class="flex flex-col sm:flex-row gap-3 w-full text-xs md:text-base text-center sm:text-start">
            <input
              type="submit"
              value="Login"
              class="bg-[#0B5FFF] text-white font-semibold py-4 px-10 rounded-lg hover:bg-[#074DD2] cursor-pointer"
            />
            <a href="register.php" class="bg-[#000A2E] text-white font-semibold py-4 px-10 rounded-lg hover:bg-[#1A2C6F]"">            
                Criar conta
            </a>
          </div>
        </form>
      </section>
    </div>
    <script src="../../assets/js/script.js"></script>
  </body>
</html>
