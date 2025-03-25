<?php
include('pdo-dash.php');

$pdo = new usePDO();

$pdo->createTable();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['name'];
    $email = $_POST['email'];
    $senha = $_POST['password'];

    if ($pdo->cadastrarLojista($nome, $email, $senha)) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar. Tente novamente.";
    }
}
?>
