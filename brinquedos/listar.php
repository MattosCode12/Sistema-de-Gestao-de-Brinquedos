<?php

require_once("../conexao.php");

$sql = "SELECT id, nome, categoria, faixa_etaria, preco, quantidade_estoque 
        FROM brinquedos 
        ORDER BY id DESC";

$resultado = $conexao->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lista de Brinquedos</title>

    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >

</head>

<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>Gestão de Brinquedos</h1>

        <a href="cadastrar.php" class="btn btn-primary">
            Cadastrar Brinquedo
        </a>

    </div>

    <?php if (isset($_GET["sucesso"])): ?>

        <div class="alert alert-success">
            Operação realizada com sucesso!
        </div>

    <?php endif; ?>

    <?php if (isset($_GET["erro"])): ?>

        <div class="alert alert-danger">
            Ocorreu um erro durante a operação.
        </div>

    <?php endif; ?>

    <div class="table-responsive">

        <table class="table table-bordered table-striped">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Faixa Etária</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Ações</th>

                </tr>

            </thead>

            <tbody>

                <?php while ($brinquedo = $resultado->fetch_assoc()): ?>

                    <tr>

                        <td>
                            <?= $brinquedo["id"] ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($brinquedo["nome"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($brinquedo["categoria"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($brinquedo["faixa_etaria"]) ?>
                        </td>

                        <td>
                            R$ <?= number_format($brinquedo["preco"], 2, ",", ".") ?>
                        </td>

                        <td>
                            <?= $brinquedo["quantidade_estoque"] ?>
                        </td>

                        <td>

                            <a 
                                href="editar.php?id=<?= $brinquedo["id"] ?>" 
                                class="btn btn-warning btn-sm"
                            >
                                Editar
                            </a>

                            <a 
                                href="excluir.php?id=<?= $brinquedo["id"] ?>" 
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Tem certeza que deseja excluir este brinquedo?')"
                            >
                                Excluir
                            </a>

                        </td>

                    </tr>

                <?php endwhile; ?>

            </tbody>

        </table>

    </div>

</div>

</body>

</html>