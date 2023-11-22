<?php
class Residuo {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function cadastrarResiduo($tiporesiduo, $qtd, $destinacao, $user_id) {
        $sql = "INSERT INTO residuos (tiporesiduo, qtd, destinacao, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $tiporesiduo, $qtd, $destinacao, $user_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function listarResiduosColetaPortaPorta() {
        $sql = "SELECT residuos.idresiduo, users.name, users.cep, users.rua, users.numero, users.bairro, users.cidade, residuos.tiporesiduo, residuos.qtd 
                FROM residuos
                INNER JOIN users ON residuos.user_id = users.id
                WHERE residuos.destinacao = 'porta_a_porta' AND residuos.coletado = 0";
        $result = $this->conn->query($sql);
    
        $residuos = array();
        while ($row = $result->fetch_assoc()) {
            $enderecoCompleto = $row['cep'] . ' ' . $row['rua'] . ', <br>' . $row['numero'] . ',<br> ' . $row['bairro'] . ', <br>' . $row['cidade'];
            $row['endereco_completo'] = $enderecoCompleto;
            $residuos[] = $row;
        }
    
        if (empty($residuos)) {
            return "Não há resíduos para coleta.";
        }
    
        return $residuos;
    }
    
    public function confirmarColeta($idresiduo) {
        $sql = "UPDATE residuos SET coletado = 1 WHERE idresiduo = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $idresiduo);
            if ($stmt->execute()) {
                return true;
            } else {
                echo "Algo deu errado.";
            }
        }
        $stmt->close();
    }
    public function listarResiduosColetados() {
        $sql = "SELECT tiporesiduo, COUNT(*) as qtd 
                FROM residuos
                WHERE coletado = 1
                GROUP BY tiporesiduo";
        $result = $this->conn->query($sql);
    
        $residuos = array();
        while ($row = $result->fetch_assoc()) {
            $residuos[] = $row;
        }
    
        if (empty($residuos)) {
            return "Não há resíduos coletados.";
        }
    
        return $residuos;
    }
    
    
 
}
?>
