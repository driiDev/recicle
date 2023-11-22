<?php
class Cooperativa {
    private $conn;
    private $cooperativa_id;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function autenticarCooperativa($user, $password) {
        $sql = "SELECT idcooperativa FROM cooperativa WHERE user = ? AND password = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $user, $password);
        $stmt->execute();
        $stmt->store_result();

        $cooperativa_id = null; // Inicializa a variável

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($cooperativa_id);
            $stmt->fetch();

            $this->cooperativa_id = $cooperativa_id;
            return "Login realizado";
        } else {
            return "Usuário ou senha incorretos";
        }
    }

    public function getCooperativaId() {
        return $this->cooperativa_id;
    }
}
?>
