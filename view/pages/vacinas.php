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
    <title>Cadastro de Vacinas</title>
  </head>
  <body class="overflow-x-hidden">

  <?php include '../layout/navbar-visit.php'; ?>

    <!-- Cadastro de Vacinas -->
    <section class="flex justify-center items-center w-full h-[90vh]">
      <form
        action="POST"
        class="flex flex-col gap-3 px-6 lg:px-[32px] w-full lg:w-4/6 justify-center"
      >
        <h1 class="text-2xl font-semibold">Cadastro de Vacinas</h1>

        <!-- Nome da Vacina -->
        <div class="flex flex-col gap-2">
          <label for="vaccine-name">Nome da vacina:</label>
          <select name="vaccine_name" id="vaccine-name" form="vaccineform" class="p-3 border-2 rounded-lg">
            <option value="" class="text-gray-500">Selecione uma vacina</option>
            <option value="bcg">Vacina BCG</option>
            <option value="dtp">Vacina DTP</option>
            <option value="hep_b">Vacina Hepatite B</option>
            <option value="mmr">Vacina MMR</option>
            <option value="influenza">Vacina contra a Gripe (Influenza)</option>
          </select>
        </div>

        <div class="flex flex-col gap-2">
          <label for="health_post">Selecionar posto:</label>
          <select name="health_post" id="health_post" form="health_post_form" class="p-3 border-2 rounded-lg">
            <option value="" class="text-gray-500">Selecione um posto</option>
            <option value="bcg">UPA - Desterro (Desterro, Abreu e Lima - PE, 53600-000)</option>
            <option value="dtp">UPA - Igarassu (Rodovia Br-101 Norte, km 47 - Cruz de Rebouças, Igarassu - PE, 53600-000)</option>
            <option value="dtp">UPA - Paulista (Estr. do Frio, 1000 - Jardim Paulista, Paulista - PE, 53401-030)</option>
            <option value="dtp">UPA - Olinda (Av. Dr. Joaquim Nabuco, S/N - Tabajara, Olinda - PE, 53350-005)</option>
            <option value="dtp">UPA - Nova Descoberta (Av. Ver. Otacílio Azevedo, s/n - Nova Descoberta, Recife - PE, 52081-550)</option>
            <option value="dtp">UPA - Caxangá (R. Ribeiro Pessoa, s/n - Iputinga, Recife - PE, 50980-000)</option>
          </select>
        </div>

        <!-- Quantidade -->
        <div class="flex flex-col gap-2">
          <label for="quantity">Quantidade:</label>
          <input
            type="number"
            id="quantity"
            name="quantity"
            class="border-2 p-3 rounded-lg"
            placeholder="Digite a quantidade de vacinas"
            required
          />
        </div>

        <!-- Validade -->
        <div class="flex flex-col gap-2">
          <label for="expiry-date">Validade:</label>
          <input
            type="date"
            id="expiry-date"
            name="expiry_date"
            class="border-2 p-3 rounded-lg"
            required
          />
        </div>

        <!-- Data de Chegada -->
        <div class="flex flex-col gap-2">
          <label for="arrival-date">Data de Chegada:</label>
          <input
            type="date"
            id="arrival-date"
            name="arrival_date"
            class="border-2 p-3 rounded-lg"
            required
          />
        </div>

        <!-- Botão de envio -->
        <div class="flex flex-col mt-5 sm:flex-row gap-3 w-full text-xs md:text-base text-center sm:text-start">
          <input
            type="submit"
            value="Cadastrar Vacina"
            class="bg-[#0B5FFF] text-white font-semibold py-4 px-10 rounded-lg hover:bg-[#074DD2] cursor-pointer"
          />
        </div>
      </form>
    </section>

    <script src="../../assets/js/script.js"></script>

  </body>
</html>
