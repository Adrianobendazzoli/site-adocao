<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // campos 
    $nome       = $_POST["nome"] ?? "";
    $descricao  = $_POST["descricao"] ?? "";
    $cor        = $_POST["cor"] ?? "";
    $tamanho    = $_POST["tamanho"] ?? "";
    $peso       = $_POST["peso"] ?? "";
    $castrado   = isset($_POST["castrado"]) ? 1 : 0;
    $vacinas    = $_POST["vacinas"] ?? "";
    $id_tipo    = $_POST["tipo"] ?? "";
    $raca       = $_POST["raca"] ?? "";
    $id_usuario = 1; 
    // operador '??' coloca um valor padrão caso o campo não exista (evita erros).

    
    // upload da imagem
    $foto = null;

    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === 0) {

        // cria nome único
        $nomeArquivo = uniqid() . "_" . basename($_FILES["foto"]["name"]);
        $destino = "uploads/" . $nomeArquivo;

        // cria pasta se não existir
        if (!is_dir("uploads")) {
            mkdir("uploads", 0777, true);
        }

        // move o arquivo
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $destino)) {
            $foto = $destino;
        } else {
            echo "Erro ao enviar a imagem.";
            exit;
        }
    }


    // inserir no banco

    try {

        $sql = "INSERT INTO animal 
        (nome, descricao, cor, tamanho, peso, castrado, vacinas, id_tipo, raca, foto, favorito, id_status, id_usuario)
        VALUES 
        (:nome, :descricao, :cor, :tamanho, :peso, :castrado, :vacinas, :id_tipo, :raca, :foto, 0, 1, :id_usuario)";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":cor", $cor);
        $stmt->bindParam(":tamanho", $tamanho);
        $stmt->bindParam(":peso", $peso);
        $stmt->bindParam(":castrado", $castrado);
        $stmt->bindParam(":vacinas", $vacinas);
        $stmt->bindParam(":id_tipo", $id_tipo);
        $stmt->bindParam(":raca", $raca);
        $stmt->bindParam(":foto", $foto);
        $stmt->bindParam(":id_usuario", $id_usuario);

        $stmt->execute();

        echo "Pet cadastrado com sucesso!";

    } catch (PDOException $e) {
        echo "Erro ao cadastrar pet: " . $e->getMessage();
    }
}
?>
