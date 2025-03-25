<?php 
class usePDO {
    private $dbname = "bd_crud"; 
    private $servername = "localhost"; 
    private $username = "root";
    private $password = ""; 

    private function connection() {
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Connection Failed: " . $e->getMessage();
            exit();
        }
    }

    public function createTable() {
        try {
            $cnx = $this->connection();

            $sqlFornecedor = "SELECT 1 FROM fornecedor LIMIT 1";
            $stmt = $cnx->prepare($sqlFornecedor);
            $stmt->execute();
            if (!$stmt->fetch()) {
                echo "A tabela 'fornecedor' não encontrada. Por favor, crie a tabela 'fornecedor'.";
                return;
            }

            $sql = "CREATE TABLE IF NOT EXISTS produto (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
                nome VARCHAR(100) NOT NULL,
                fornecedor_id INT(6) UNSIGNED NOT NULL,  
                quantidade INT NOT NULL,
                cor VARCHAR(20) NOT NULL,
                tamanho VARCHAR(5) NOT NULL,
                preco_unitario DECIMAL(10, 2) NOT NULL,
                descricao TEXT,
                FOREIGN KEY (fornecedor_id) REFERENCES fornecedor(id) ON DELETE CASCADE
            )";
            $cnx->exec($sql);
            echo "Tabela 'produto' criada com sucesso.";
        } catch (PDOException $e) {
            echo "Erro ao criar a tabela: " . $e->getMessage();
        }
    }

    public function cadastrarProduto($nome, $fornecedor_id, $quantidade, $cor, $tamanho, $preco_unitario, $descricao) {
        try {
            $cnx = $this->connection();

            $sqlFornecedor = "SELECT id, nome FROM fornecedor WHERE id = :fornecedor_id";
            $stmt = $cnx->prepare($sqlFornecedor);
            $stmt->bindParam(':fornecedor_id', $fornecedor_id);
            $stmt->execute();
            if ($stmt->rowCount() == 0) {
                echo "Fornecedor não encontrado.";
                return false;
            }

            $sql = "INSERT INTO produto (nome, fornecedor_id, quantidade, cor, tamanho, preco_unitario, descricao) 
                    VALUES (:nome, :fornecedor_id, :quantidade, :cor, :tamanho, :preco_unitario, :descricao)";
            $stmt = $cnx->prepare($sql);

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':fornecedor_id', $fornecedor_id);
            $stmt->bindParam(':quantidade', $quantidade);
            $stmt->bindParam(':cor', $cor);
            $stmt->bindParam(':tamanho', $tamanho);
            $stmt->bindParam(':preco_unitario', $preco_unitario);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);

            $stmt->execute();
        
            return true;
        } catch (PDOException $e) {
            echo "Erro ao cadastrar o produto: " . $e->getMessage();
            return false;
        }
    }
    
    public function listarFornecedores() {
        try {
            $cnx = $this->connection();
            $sql = "SELECT id, nome FROM fornecedor";
            $stmt = $cnx->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); 
        } catch (PDOException $e) {
            echo "Erro ao listar fornecedores: " . $e->getMessage();
            return [];
        }
    }
}
?>
