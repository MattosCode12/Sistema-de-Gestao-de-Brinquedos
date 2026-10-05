<?php

require_once("../conexao.php");

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    header("Location: listar.php");
    exit;

}

$id = (int) $_GET["id"];

try {

    $sql = "DELETE FROM brinquedos WHERE id = ?";

    $stmt = $conexao->prepare($sql);

    $stmt->bind_param("i", $id);

    $stmt->execute();

    header("Location: listar.php?sucesso=1");
    exit;

} catch (mysqli_sql_exception $erro) {

    header("Location: listar.php?erro=1");
    exit;

}

?>