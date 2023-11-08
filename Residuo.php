<?php
class Residuo {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function cadastrarResiduo($tiporesiduo, $qtd, $destinacao) {
        $sql = "INSERT INTO residuos (titulo, qtd, periodo) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $tiporesiduo, $qtd, $destinacao);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
