<?php
include_once 'utils/processa-dash-produto.php'; 

$pdo = new usePDO(); 
$fornecedores = $pdo->listarFornecedores(); 
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto</title>
    <link rel="stylesheet" href="css/styles-dash.css">
</head>
<body>

    <header id="banner-dash">
        <div class="logo-dash">
            <p>CRUD</p>
        </div>

        <nav class="navbar-dash">
            <a href="dash-painel.html" class="dashboard">Dashboard</a>
        </nav>

        <div class="icons-dash">
            <a class="icon-dash"><img src="icons/search-icon.png"></a>
            <a class="icon-dash"><img src="icons/user-icon-dash.png"></a>
            <a class="icon-dash"><img src="icons/logout-icon.png"></a>
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
                            <li><a href="dash-add-produto.php">Adicionar Produto</a></li>
                            <li><a href="#">Atualizar Produto</a></li>
                            <li><a href="#">Remover Produto</a></li>
                        </ul>
                    </li>
                    <li class="menu-item" id="fornecedores">
                        Fornecedores
                        <ul class="submenu">
                            <li><a href="#">Listar Fornecedores</a></li>
                            <li><a href="dash-add-fornecedor.html">Adicionar Fornecedor</a></li>
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
            <h2>Novo Produto</h2>
            <form id="form-novo-produto" action="utils/processa-dash-produto.php" method="POST">
                <div class="form-dash">
                    <label for="produto-nome">Nome do Produto</label>
                    <input type="text" id="produto-nome" name="produto-nome">
                </div>
        
                <div class="form-dash">
                    <label for="fornecedor">Fornecedor</label>
                    <select id="fornecedor_id" name="fornecedor_id">
                        <option value="" disabled selected>Selecione o fornecedor...</option>
                        <?php
                        $fornecedores = $pdo->listarFornecedores();
                        if (!empty($fornecedores)) {
                            foreach ($fornecedores as $fornecedor) {
                                echo "<option value='{$fornecedor['id']}'>{$fornecedor['nome']}</option>"; 
                            }
                        } else {
                            echo "<option disabled>Não há fornecedores cadastrados</option>";
                        }
                        ?>
                    </select>
                </div>
        
                <div class="form-dash">
                    <label for="quantidade">Quantidade</label>
                    <input type="number" id="quantidade" name="quantidade">
                </div>
        
                <div class="form-dash">
                    <label for="cor">Cor</label>
                    <input type="text" id="cor" name="cor">
                </div>
        
                <div class="form-dash">
                    <label for="tamanho">Tamanho</label>
                    <input type="text" id="tamanho" name="tamanho">
                </div>
        
                <div class="form-dash">
                    <label for="preco">Preço</label>
                    <input type="number" id="preco" name="preco" step="0.01" min="0">
                </div>
        
                <div class="form-dash">
                    <label for="descricao">Descrição (Opcional)</label>
                    <textarea id="descricao" name="descricao"></textarea>
                </div>
        
                <div class="form-dash-buttons">
                    <button type="submit" class="add-form-btn">Adicionar Produto</button>
                    <button type="button" class="cancel-form-btn" onclick="cancelAddProduto()">Cancelar</button>
                </div>
            </form>
        </div>
        
    </main>
    
    
    <script src="js/script-dash.js"></script>
</body>
</html>


