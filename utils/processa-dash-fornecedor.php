<?php
include('pdo-dash-fornecedor.php'); 
$pdo = new usePDO();  

$pdo->createTable();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = trim($_POST['nome']);
    $cnpj = trim($_POST['cnpj']);
    $telefone = trim($_POST['telefone']);

    if (empty($nome) || empty($cnpj) || empty($telefone)) {
        echo "Todos os campos são obrigatórios!";
    } else {
      
        if (!preg_match("/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/", $cnpj)) {
            echo "O CNPJ informado não é válido. O formato esperado é: XX.XXX.XXX/XXXX-XX.";
        } 
        elseif (!preg_match("/^\(\d{2}\)\d{5}-\d{4}$/", $telefone)) {
            echo "Telefone invalido. O formato esperado é: (XX)XXXXX-XXXX.";
        } else {
        
            if ($pdo->cadastrarFornecedor($nome, $cnpj, $telefone)) {
                echo "Fornecedor cadastrado com sucesso. Redirecionando para Dashboard...";
                echo "<script src='../js/script-dash.js'></script>";
                echo "<script>redirectToPage('dashboard.php', 2000);</script>";
                exit;
            } else {
                echo "Erro ao cadastrar fornecedor.";
            }
        }
    }
}
?>
