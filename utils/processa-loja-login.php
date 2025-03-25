<?php
include('pdo.php');

$pdo = new usePDO();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    if ($pdo->verificarCliente($email, $senha)) {
        echo "Login realizado com sucesso!";
        header("Location: dash-cliente.php");
        exit();
    } else {
        echo "Credenciais incorretas.";
    }
}
?>
