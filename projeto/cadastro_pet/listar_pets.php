<?php
include("../conexao.php");

// bp: buscar todos os pets
$pets = $pdo->query("
    SELECT a.id_animal, a.nome, a.foto, t.descricao AS tipo, r.descricao AS raca
    FROM animal a
    LEFT JOIN tipo t ON a.id_tipo = t.id_tipo
    LEFT JOIN raca r ON a.id_raca = r.id_raca
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Pets cadastrados</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">

<h1 class="text-3xl font-bold mb-6">Pets cadastrados</h1>

<div class="grid grid-cols-3 gap-6">

<?php foreach($pets as $p): ?>
  <div class="bg-white rounded-xl shadow p-4">
    
    <!-- foto -->
    <img src="<?= $p['foto'] ?>" class="w-full h-48 object-cover rounded-lg mb-3">

    <h2 class="text-xl font-semibold"><?= $p['nome'] ?></h2>
    <p class="text-gray-600"><?= $p['tipo'] ?> - <?= $p['raca'] ?></p>

    <!-- botoes -->
    <div class="mt-4 flex gap-2">
      <a href="detalhes_pet.php?id=<?= $p['id_animal'] ?>" class="bg-blue-500 px-3 py-1 text-white rounded">Ver</a>
      <a href="editar_pet.php?id=<?= $p['id_animal'] ?>" class="bg-yellow-500 px-3 py-1 text-white rounded">Editar</a>
      <a href="excluir_pet.php?id=<?= $p['id_animal'] ?>" class="bg-red-500 px-3 py-1 text-white rounded"
         onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
    </div>

  </div>
<?php endforeach; ?>

</div>

</body>
</html>
