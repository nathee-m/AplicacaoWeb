<?php
session_start();
include('pdo-dash.php');  

$pdo = new usePDO();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $senha = $_POST['password'];

    if ($pdo->verificarLojista($email, $senha)) {

        $_SESSION['lojista_logged_in'] = true; 
        $_SESSION['email'] = $email;  
        header('Location: dashboard.php');  
        exit();
    } else {
        echo "Credenciais incorretas. Tente novamente.";
    }
}

?>
