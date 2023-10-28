<?php
class Conexao {
    private $conn;

    public function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "login";

        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($this->conn->connect_error) {
            die("Falha na conexão: " . $this->conn->connect_error);
        }
    }

    public function getConexao() {
        return $this->conn;
    }

    public function fecharConexao() {
        $this->conn->close();
    }
}
?>
