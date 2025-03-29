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
            $sql = "CREATE TABLE IF NOT EXISTS fornecedor (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
                nome VARCHAR(100) NOT NULL,
                cnpj VARCHAR(25) NOT NULL,
                telefone VARCHAR(20) NOT NULL
            )";
            $cnx->exec($sql);
            echo "Tabela 'fornecedor' já existe.";
        } catch (PDOException $e) {
            echo "Erro ao criar a tabela: " . $e->getMessage();
        }
    }

    public function cadastrarFornecedor($nome, $cnpj, $telefone) {
        try {
            $cnx = $this->connection();
    
            $sql = "INSERT INTO fornecedor (nome, cnpj, telefone) VALUES (:nome, :cnpj, :telefone)";
            $stmt = $cnx->prepare($sql);
    
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':cnpj', $cnpj);
            $stmt->bindParam(':telefone', $telefone);
    
            $stmt->execute();
   
            return true;
        } catch (PDOException $e) {
            echo "Erro ao cadastrar: " . $e->getMessage();
            return false;
        }
    }
    

}
?>
