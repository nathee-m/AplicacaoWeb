<?php
include('pdo-dash-produto.php'); 

$pdo = new usePDO();  

$pdo->createTable();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = htmlspecialchars($_POST['produto-nome']);  
    $fornecedor_id = $_POST['fornecedor_id']; 
    $quantidade = $_POST['quantidade']; 
    $cor = htmlspecialchars ($_POST['cor']);  
    $tamanho = htmlspecialchars ($_POST['tamanho']); 
    $preco_unitario = $_POST['preco']; 
    $descricao = htmlspecialchars ($_POST['descricao']); 

 
    if (!is_numeric($preco_unitario)) {
        echo "O preço deve ser um número válido.";
    } else {
        if ($pdo->cadastrarProduto($nome, $fornecedor_id, $quantidade, $cor, $tamanho, $preco_unitario, $descricao)) {
            header("Location: dashboard.php"); 
        } else {
            echo "Erro ao cadastrar produto.";
        }
    }
}
?>
