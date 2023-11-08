<?php
class Meta {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function cadastrarMeta($titulo, $qtd, $data_inicial, $data_final) {
        $sql = "INSERT INTO metas (titulo, qtd, data_inicial, data_final) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $titulo, $qtd, $data_inicial, $data_final);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
