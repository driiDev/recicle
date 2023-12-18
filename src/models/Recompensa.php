<?php 
class Recompensa{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    // Dentro da classe Recompensa
    public function getRecompensaById($recompensa_id) {
        $sql = "SELECT id, descricao FROM recompensas WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $recompensa_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false; // Ou qualquer valor que indique que a recompensa não foi encontrada
        }
    }

    public function listarRecompensas(){
        $query = "SELECT * FROM recompensas";
        $result = $this->conn->query($query);

        $recompensas = [];
        while ($row = $result->fetch_assoc()) {
            $recompensas[] = $row;
        }

        return $recompensas;
    }
}

