<?php
// ic: include da conexao com o banco
include("../conexao.php");

// bt: buscar todos os tipos do banco
$tipos = $pdo->query("SELECT id_tipo, descricao FROM tipo ORDER BY descricao")
             ->fetchAll(PDO::FETCH_ASSOC);

// br: buscar todas as raças do banco
$racas = $pdo->query("SELECT id_raca, descricao FROM raca ORDER BY descricao")
             ->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ficha do Pet</title>

    <!-- tw: tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- ft: fonte poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet"/>

    <!-- cs: seu css personalizado -->
    <link rel="stylesheet" href="../projeto/css/estilo_cadastro_pet.css" />
  </head>

  <body class="text-white">

    <!-- hd: cabeçalho -->
    <header>
      <div class="logo">LOGO</div>
      <div class="menu">
        <a href="#">CADASTRE-SE</a>
        <a href="#">LOGIN</a>
      </div>
    </header>

    <!-- cp: caixa principal -->
    <section class="max-w-4xl mx-auto mt-12 bg-purple-700/90 p-8 rounded-2xl shadow-xl">
      <h1 class="text-3xl font-bold text-purple-200 mb-8">FICHA DO PET!</h1>

      <!-- fm: formulário -->
      <form
        class="space-y-6"
        action="processa_cadastro.php"
        method="POST"
        enctype="multipart/form-data"
      >

        <!-- dp: dados principais -->
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block font-semibold mb-1">Nome (do pet):</label>
            <input type="text" name="nome" class="w-full rounded-md p-2 text-gray-800"/>
          </div>

          <div>
            <label class="block font-semibold mb-1">Descrição:</label>
            <input type="text" name="descricao" class="w-full rounded-md p-2 text-gray-800"/>
          </div>
        </div>

        <!-- ds: dados secundários -->
        <div class="grid grid-cols-3 gap-4">
          <div>
            <label class="block font-semibold mb-1">Cor:</label>
            <input type="text" name="cor" class="w-full rounded-md p-2 text-gray-800"/>
          </div>

          <div>
            <label class="block font-semibold mb-1">Tamanho (cm):</label>
            <input type="number" name="tamanho" class="w-full rounded-md p-2 text-gray-800"/>
          </div>

          <div>
            <label class="block font-semibold mb-1">Peso:</label>
            <input type="number" name="peso" class="w-full rounded-md p-2 text-gray-800"/>
          </div>
        </div>

        <!-- vc: vacinas/castrado/foto -->
        <div class="grid grid-cols-2 gap-4 items-end">
          <div>
            <label class="block font-semibold mb-1">Castrado?</label>

            <!-- rc: radios -->
            <div class="flex gap-3 mb-3">
              <label class="flex items-center gap-1">
                <input type="radio" name="castrado" value="0" checked/> Não
              </label>

              <label class="flex items-center gap-1">
                <input type="radio" name="castrado" value="1" /> Sim
              </label>
            </div>

            <label class="block font-semibold mb-1">Vacinas:</label>
            <input type="text" name="vacinas" class="w-full rounded-md p-2 text-gray-800"/>
          </div>

          <div class="self-end">
            <label class="block font-semibold mb-1">Foto do pet:</label>
            <input type="file" name="foto" accept="image/*" class="w-full bg-white text-gray-800 rounded-md p-2"/>
          </div>
        </div>

        <!-- tp: tipo e raca puxados do banco -->
        <div class="grid grid-cols-2 gap-4">

          <!-- st: select de tipos -->
          <div>
            <label class="block font-semibold mb-1">Tipo:</label>
            <select name="id_tipo" class="w-full rounded-md p-2 text-gray-800">
              <option value="">Selecione...</option>

              <!-- lt: loop dos tipos -->
              <?php foreach ($tipos as $t): ?>
                <option value="<?= $t['id_tipo'] ?>">
                  <?= $t['descricao'] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- sr: select de racas -->
          <div>
            <label class="block font-semibold mb-1">Raça:</label>
            <select name="id_raca" class="w-full rounded-md p-2 text-gray-800">
              <option value="">Selecione...</option>

              <!-- lr: loop das racas -->
              <?php foreach ($racas as $r): ?>
                <option value="<?= $r['id_raca'] ?>">
                  <?= $r['descricao'] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

        </div>

        <!-- bt: botão -->
        <div class="flex justify-end">
          <button
            type="submit"
            class="bg-purple-300 hover:bg-purple-400 text-purple-900 font-semibold px-6 py-2 rounded-full transition"
          >
            CADASTRAR PET
          </button>
        </div>

      </form>
    </section>
  </body>
</html>
