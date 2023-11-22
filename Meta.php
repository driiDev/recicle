<?php
class Meta {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function cadastrarMeta($titulo, $qtd, $data_inicial, $data_final, $user_id) {
        $sql = "INSERT INTO metas (titulo, qtd, data_inicial, data_final, user_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sissi", $titulo, $qtd, $data_inicial, $data_final, $user_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function listarMetas($user_id) {
        $sql = "SELECT * FROM metas WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array(); // Retorna um array vazio se não houver metas
        }
    }

    public function carregarMeta($meta_id) {
        $sql = "SELECT * FROM metas WHERE idmeta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $meta_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function atualizarMeta($meta_id, $qtd_coletada) {
        $sql = "UPDATE metas SET qtd_coletada = ? WHERE idmeta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $qtd_coletada, $meta_id);

        return $stmt->execute();
    }
    public function verificarUsuario($meta_id, $user_id) { // verifica meta do usuário
        $sql = "SELECT * FROM metas WHERE idmeta = ? AND user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $meta_id, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }
    // Exclui a meta do banco de dados
    public function excluirMeta($meta_id) {
        $sql = "DELETE FROM metas WHERE idmeta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $meta_id);

        return $stmt->execute();
    }
}
?>
