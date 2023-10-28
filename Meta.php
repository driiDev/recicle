<?php
class Meta {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function cadastrarMeta($titulo, $qtd, $periodo) {
        $sql = "INSERT INTO metas (titulo, qtd, periodo) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $titulo, $qtd, $periodo);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
