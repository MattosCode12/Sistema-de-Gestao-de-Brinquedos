<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "crud_brinquedos";
$porta = 3306;

try {

    $conexao = new mysqli(
        $servidor,
        $usuario,
        $senha,
        $banco,
        $porta
    );

    $conexao->set_charset("utf8mb4");

} catch (mysqli_sql_exception $erro) {

    die("Erro ao conectar com o banco de dados: " . $erro->getMessage());

}
?>