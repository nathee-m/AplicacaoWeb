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
            $sql = "CREATE TABLE IF NOT EXISTS lojista (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
                nome VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL UNIQUE,
                senha VARCHAR(100) NOT NULL
            )";
            $cnx->exec($sql);
            echo "Tabela 'lojista' já existe.";
        } catch (PDOException $e) {
            echo "Erro ao criar a tabela: " . $e->getMessage();
        }
    }

    public function cadastrarLojista($nome, $email, $senha) {
        try {
            $cnx = $this->connection();
    
            $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
    
            $sql = "INSERT INTO lojista (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $cnx->prepare($sql);
    
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senhaHash);
    
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo "Erro ao cadastrar: " . $e->getMessage();
            return false;
        }
    }

    public function verificarLojista($email, $senha) {
        try {
            $cnx = $this->connection();
        
            $sql = "SELECT * FROM lojista WHERE email = :email";
            $stmt = $cnx->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
        
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($usuario) {
                echo "Senha fornecida: " . $senha . "<br>";
                echo "Hash armazenado: " . $usuario['senha'] . "<br>";
    
                if (password_verify($senha, $usuario['senha'])) {
                    return true;  
                } else {
                    return false; 
                }
            } else {
                return false;  
            }
        } catch (PDOException $e) {
            echo "Erro ao verificar usuário: " . $e->getMessage();
            return false;
        }
    }
    
       
}
?>
