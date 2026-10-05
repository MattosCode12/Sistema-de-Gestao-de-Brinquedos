<?php

require_once("../conexao.php");

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    header("Location: listar.php");
    exit;

}

$id = (int) $_GET["id"];

$erro = "";


// Buscar o brinquedo
$sql = "SELECT id, nome, categoria, faixa_etaria, preco, quantidade_estoque
        FROM brinquedos
        WHERE id = ?";

$stmt = $conexao->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {

    header("Location: listar.php?erro=1");
    exit;

}

$brinquedo = $resultado->fetch_assoc();


// Atualizar o brinquedo
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST["nome"]);
    $categoria = trim($_POST["categoria"]);
    $faixa_etaria = trim($_POST["faixa_etaria"]);
    $preco = $_POST["preco"];
    $quantidade_estoque = $_POST["quantidade_estoque"];


    // Validação
    if (
        empty($nome) ||
        empty($categoria) ||
        empty($faixa_etaria) ||
        $preco === "" ||
        $quantidade_estoque === ""
    ) {

        $erro = "Preencha todos os campos.";

    } elseif (!is_numeric($preco) || $preco < 0) {

        $erro = "Digite um preço válido.";

    } elseif (
        filter_var($quantidade_estoque, FILTER_VALIDATE_INT) === false ||
        $quantidade_estoque < 0
    ) {

        $erro = "Digite uma quantidade válida.";

    } else {

        try {

            $sql = "UPDATE brinquedos
                    SET nome = ?,
                        categoria = ?,
                        faixa_etaria = ?,
                        preco = ?,
                        quantidade_estoque = ?
                    WHERE id = ?";

            $stmt = $conexao->prepare($sql);

            $stmt->bind_param(
                "sssdii",
                $nome,
                $categoria,
                $faixa_etaria,
                $preco,
                $quantidade_estoque,
                $id
            );

            $stmt->execute();

            header("Location: listar.php?sucesso=1");
            exit;

        } catch (mysqli_sql_exception $erroBanco) {

            $erro = "Erro ao editar o brinquedo.";

        }

    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Brinquedo</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body>

<div class="container mt-5">

    <h1 class="mb-4">Editar Brinquedo</h1>

    <?php if ($erro != ""): ?>

        <div class="alert alert-danger">
            <?= htmlspecialchars($erro) ?>
        </div>

    <?php endif; ?>


    <form method="POST">

        <div class="mb-3">

            <label class="form-label">
                Nome
            </label>

            <input
                type="text"
                name="nome"
                class="form-control"
                value="<?= htmlspecialchars($brinquedo["nome"]) ?>"
                required
            >

        </div>


        <div class="mb-3">

            <label class="form-label">
                Categoria
            </label>

            <input
                type="text"
                name="categoria"
                class="form-control"
                value="<?= htmlspecialchars($brinquedo["categoria"]) ?>"
                required
            >

        </div>


        <div class="mb-3">

            <label class="form-label">
                Faixa Etária
            </label>

            <input
                type="text"
                name="faixa_etaria"
                class="form-control"
                value="<?= htmlspecialchars($brinquedo["faixa_etaria"]) ?>"
                required
            >

        </div>


        <div class="mb-3">

            <label class="form-label">
                Preço
            </label>

            <input
                type="number"
                name="preco"
                class="form-control"
                step="0.01"
                min="0"
                value="<?= htmlspecialchars($brinquedo["preco"]) ?>"
                required
            >

        </div>


        <div class="mb-3">

            <label class="form-label">
                Quantidade em Estoque
            </label>

            <input
                type="number"
                name="quantidade_estoque"
                class="form-control"
                min="0"
                value="<?= htmlspecialchars($brinquedo["quantidade_estoque"]) ?>"
                required
            >

        </div>


        <button type="submit" class="btn btn-success">
            Salvar Alterações
        </button>

        <a href="listar.php" class="btn btn-secondary">
            Voltar
        </a>

    </form>

</div>

</body>

</html>