<?php
include 'Usuario.php';
class Meta {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function cadastrarMeta($titulo, $qtd, $unidade, $data_inicial, $data_final, $user_id) {
        $sql = "INSERT INTO metas (titulo, qtd, unidade, data_inicial, data_final, user_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sisssi", $titulo, $qtd, $unidade, $data_inicial, $data_final, $user_id);

        if ($stmt->execute()) {
            $this->calcularPontuacao($user_id, $qtd);

            return true;
        } else {
            return false;
        }
    }
    private function calcularPontuacao($user_id, $qtd) {
        $usuario = new Usuario($this->conn);

        // Adiciona pontos com base na quantidade da meta
        if ($qtd < 5) {
            $usuario->adicionarPontos($user_id, 50);
        } elseif ($qtd >= 5 && $qtd < 15) {
            $usuario->adicionarPontos($user_id, 100);
        } else {
            $usuario->adicionarPontos($user_id, 150);
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

    public function completarMeta($meta_id, $qtd_coletada) {
        $usuario = new Usuario($this->conn);
        // Atualiza o status da meta para atingida
        $sql = "UPDATE metas SET qtd_coletada = ?, atingida = 1 WHERE idmeta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $qtd_coletada, $meta_id);
    
        if ($stmt->execute()) {
            // Adiciona 200 pontos ao usuário pela meta atingida
            $usuario->adicionarPontos($_SESSION["user_id"], 200);
    
            echo "Meta atingida com sucesso!";
        } else {
            echo "Erro ao atingir a meta: " . $stmt->error;
        }
    
        $stmt->close();
    }
    
}


?>