<?php
include("../conexao.php");


// --- Futuro: substituir por $_SESSION['id_usuario'] ---
$id_usuario = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Campos do formulário
    $nome = $_POST["nome"] ?? "";
    $descricao = $_POST["descricao"] ?? "";
    $cor = $_POST["cor"] ?? "";
    $tamanho = $_POST["tamanho"] ?? "";
    $peso = $_POST["peso"] ?? "";
    $castrado = $_POST["castrado"] ?? 0;
    $vacinas = $_POST["vacinas"] ?? "";
    $id_tipo = $_POST["id_tipo"] ?? null;
    $id_raca = $_POST["id_raca"] ?? null;

    // -----------------------------------------------------
    // Upload da foto
    // -----------------------------------------------------
    $foto = null;

    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === 0) {

        $nomeArquivo = uniqid() . "_" . basename($_FILES["foto"]["name"]);
        $destino = "../uploads/" . $nomeArquivo;

        // cria a pasta se nao existir
        if (!is_dir("../uploads")) {
            mkdir("../uploads", 0777, true);
        }

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $destino)) {
            $foto = $destino;
        } else {
            echo "Erro ao enviar a imagem.";
            exit;
        }
    }

    // -----------------------------------------------------
    // Inserir no banco
    // -----------------------------------------------------
    try {

        $sql = "INSERT INTO animal 
                (nome, descricao, cor, tamanho, peso, foto, castrado, vacinas, id_tipo, id_raca, id_status, id_usuario, favorito)
                VALUES 
                (:nome, :descricao, :cor, :tamanho, :peso, :foto, :castrado, :vacinas, :id_tipo, :id_raca, 1, :id_usuario, 0)";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":cor", $cor);
        $stmt->bindParam(":tamanho", $tamanho);
        $stmt->bindParam(":peso", $peso);
        $stmt->bindParam(":foto", $foto);
        $stmt->bindParam(":castrado", $castrado);
        $stmt->bindParam(":vacinas", $vacinas);
        $stmt->bindParam(":id_tipo", $id_tipo);
        $stmt->bindParam(":id_raca", $id_raca);
        $stmt->bindParam(":id_usuario", $id_usuario);

        $stmt->execute();

        echo "<h1>Pet cadastrado com sucesso! 🐾💜</h1>";

    } catch (PDOException $e) {
        echo "Erro ao cadastrar pet: " . $e->getMessage();
    }
}
?>
