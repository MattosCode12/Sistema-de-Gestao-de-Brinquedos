<?php

require_once("../conexao.php");

$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST["nome"]);
    $categoria = trim($_POST["categoria"]);
    $faixa_etaria = trim($_POST["faixa_etaria"]);
    $preco = $_POST["preco"];
    $quantidade_estoque = $_POST["quantidade_estoque"];

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

    } elseif (!filter_var($quantidade_estoque, FILTER_VALIDATE_INT) === false && $quantidade_estoque < 0) {

        $erro = "Digite uma quantidade válida.";

    } else {

        try {

            $sql = "INSERT INTO brinquedos 
                    (nome, categoria, faixa_etaria, preco, quantidade_estoque)
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = $conexao->prepare($sql);

            $stmt->bind_param(
                "sssdi",
                $nome,
                $categoria,
                $faixa_etaria,
                $preco,
                $quantidade_estoque
            );

            $stmt->execute();

            header("Location: listar.php?sucesso=1");
            exit;

        } catch (mysqli_sql_exception $erroBanco) {

            $erro = "Erro ao cadastrar o brinquedo.";

        }

    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastrar Brinquedo</title>

    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >

</head>

<body>

<div class="container mt-5">

    <h1 class="mb-4">Cadastrar Brinquedo</h1>

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
                placeholder="Ex: 6 a 10 anos"
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
                required
            >

        </div>

        <button type="submit" class="btn btn-success">
            Cadastrar
        </button>

        <a href="listar.php" class="btn btn-secondary">
            Voltar
        </a>

    </form>

</div>

</body>

</html>