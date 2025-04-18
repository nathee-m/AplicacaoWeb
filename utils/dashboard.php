<?php
session_start();

if (!isset($_SESSION['lojista_logged_in']) || $_SESSION['lojista_logged_in'] !== true) {
    header('Location: dash-login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/styles-dash.css">
</head>
<body>

    <header id="banner-dash">
        <div class="logo-dash">
            <p>CRUD</p>
        </div>

        <nav class="navbar-dash">
            <a href="dashboard.php" class="dashboard">Dashboard</a>
        </nav>

        <div class="icons-dash">
            <a class="icon-dash"><img src="../icons/search-icon.png"></a>
            <a href="dashboard.php" class="icon-dash"><img src="../icons/user-icon-dash.png"></a>
            <a href="dash-logout.php" class="icon-dash"><img src="../icons/logout-icon.png"></a>
        </div>
    </header>

    <main>
        <div class="dashboard-container">
            <div class="menu-lateral">
                <ul class="menu-lateral-itens">
                    <li class="menu-item" id="clientes">
                        Clientes
                        <ul class="submenu">
                            <li><a href="#">Listar Clientes</a></li>
                        </ul>
                    </li>
                    <li class="menu-item" id="produtos">
                        Produtos
                        <ul class="submenu">
                            <li><a href="#">Listar Produtos</a></li>
                            <li><a href="../dash-add-produto.php">Adicionar Produto</a></li>
                            <li><a href="#">Atualizar Produto</a></li>
                            <li><a href="#">Remover Produto</a></li>
                        </ul>
                    </li>
                    <li class="menu-item" id="fornecedores">
                        Fornecedores
                        <ul class="submenu">
                            <li><a href="#">Listar Fornecedores</a></li>
                            <li><a href="../dash-add-fornecedor.html">Adicionar Fornecedor</a></li>
                            <li><a href="#">Atualizar Fornecedor</a></li>
                            <li><a href="#">Remover Fornecedor</a></li>
                        </ul>
                    </li>
                    <li class="menu-item" id="pedidos">
                        Pedidos
                        <ul class="submenu">
                            <li><a href="#">Listar Pedidos</a></li>
                            <li><a href="#">Adicionar Pedido</a></li>
                            <li><a href="#">Visualizar Pedidos</a></li>
                            <li><a href="#">Detalhes Pedido</a></li>
                            <li><a href="#">Histórico</a></li>
                            <li><a href="#">Relatórios</a></li>
                        </ul>
                    </li>
                    <li class="menu-item" id="estoque">
                        Estoque
                        <ul class="submenu">
                            <li><a href="#">Listar Itens</a></li>
                            <li><a href="#">Histórico</a></li>
                            <li><a href="#">Relatórios</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
    
            <div class="content-dash">
                <p>Seja bem-vindo!</p> 
            </div>
        </div>
    </main>
    
    <script src="../js/script-dash.js"></script>
</body>
</html>

