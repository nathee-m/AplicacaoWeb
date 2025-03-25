<?php
include('pdo.php');

$pdo = new usePDO();

$pdo->createTable();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['name'];
    $email = $_POST['email'];
    $senha = $_POST['password'];

    if ($pdo->cadastrarCliente($nome, $email, $senha)) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar. Tente novamente.";
    }
}
?>
