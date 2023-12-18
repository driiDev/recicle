<?php
include 'Usuario.php';
class Residuo {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

   // Adicione esta função à classe Residuo
public function cadastrarResiduo($tiporesiduo, $qtd, $unidade, $destinacao, $user_id) {
    $sql = "INSERT INTO residuos (tiporesiduo, qtd, unidade, destinacao, user_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ssssi", $tiporesiduo, $qtd, $unidade, $destinacao, $user_id);

    if ($stmt->execute()) {
        // Crie uma instância de Usuario
        $usuario = new Usuario($this->conn);

        // Obtenha informações adicionais sobre o resíduo
        $residuoInfo = $this->obterDetalhesResiduo($tiporesiduo);

        // Chame o método calcularPontuacao
        $this->calcularPontuacao($usuario, $user_id, $qtd, $unidade);

        // Retorne um array contendo informações sobre o resíduo
        return [
            'mensagem' => "Resíduo cadastrado com sucesso!",
            'tempo_decomposicao' => $residuoInfo['tempo_decomposicao'],
            'classificacao' => $residuoInfo['classificacao'],
        ];
    } else {
        return ['mensagem' => "Erro ao cadastrar resíduo."];
    }
}
        public function excluirResiduo($residuo_id) {
            // Implemente a lógica para excluir o resíduo no banco de dados
            // Certifique-se de verificar se o usuário tem permissão para excluir

            // Exemplo básico:
            $query = "DELETE FROM residuos WHERE idresiduo = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $residuo_id);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function verificarUsuario($residuo_id, $user_id) {
            // Implemente a lógica para verificar se o usuário tem permissão para excluir o resíduo
            // Exemplo básico: verificar se o resíduo pertence ao usuário

            $query = "SELECT user_id FROM residuos WHERE idresiduo = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $residuo_id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($user_id);

            if ($stmt->fetch()) {
                return $user_id == $user_id;
            } else {
                return false;
            }
        }


        public function obterDetalhesResiduo($tiporesiduo) {
            $sql = "SELECT * FROM residuosdetalhes WHERE tipo_residuo = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $tiporesiduo);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows == 1) {
                    return $result->fetch_assoc();
                }
            }

            return false;
        }

        public function listarResiduosUsuario($user_id) {
            $sql = "SELECT r.*, rd.tempo_decomposicao, rd.classificacao
                    FROM residuos r
                    LEFT JOIN residuosdetalhes rd ON r.tiporesiduo = rd.tipo_residuo
                    WHERE r.user_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
        
            $residuos = array();
            while ($row = $result->fetch_assoc()) {
                $residuos[] = $row;
            }
        
            return $residuos;  // Adicionado o retorno
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
    public function listarResiduosColetados($user_id = null) {
        $sql = "SELECT tiporesiduo, COUNT(*) as qtd 
                FROM residuos
                WHERE coletado = 1";
    
        // Adicione a cláusula WHERE se um usuário específico for fornecido
        if ($user_id !== null) {
            $sql .= " AND user_id = ?";
        }
    
        $sql .= " GROUP BY tiporesiduo";
    
        $stmt = $this->conn->prepare($sql);
    
        // Adicione um parâmetro se um usuário específico for fornecido
        if ($user_id !== null) {
            $stmt->bind_param("i", $user_id);
        }
    
        $stmt->execute();
        $result = $stmt->get_result();
        $residuos = array();
    
        while ($row = $result->fetch_assoc()) {
            $residuos[] = $row;
        }
    
        if (empty($residuos)) {
            return "Não há resíduos coletados.";
        }
    
        return $residuos;
    }
    
    
    public function calcularPontuacao($usuario, $user_id, $qtd, $unidade) {
        // Converte a quantidade para número
        $qtd = floatval($qtd);
        // Adiciona pontos com base na quantidade de resíduos cadastrados
        if ($unidade === 'kg') {
            if ($qtd < 5) {
                $usuario->adicionarPontos($user_id, 50);
            } elseif ($qtd >= 5) {
                $usuario->adicionarPontos($user_id, 150);
            } 
        } elseif ($unidade === 'unidade') {
            if ($qtd < 5) {
                $usuario->adicionarPontos($user_id, 50);
            } elseif($qtd >=5 && $qtd<=10){
                $usuario->adicionarPontos($user_id, 100);
            } elseif($qtd>10){
                $usuario->adicionarPontos($user_id, 150);
        }
        } else {
            // Unidade desconhecida ou não especificada
            return "Unidade de resíduo inválida ou não especificada.";
        }
        return "Pontuação calculada com sucesso.";
    }
    public function obterQuantidadeResiduos($user_id, $unidade = null) {
        $sql = "SELECT SUM(qtd) as total FROM residuos WHERE user_id = ?";
        
        // Adiciona um filtro opcional para a unidade
        if ($unidade !== null) {
            $sql .= " AND unidade = ?";
        }
    
        $stmt = $this->conn->prepare($sql);
    
        // Adiciona um parâmetro para o user_id
        if ($unidade !== null) {
            $stmt->bind_param("is", $user_id, $unidade);
        } else {
            $stmt->bind_param("i", $user_id);
        }
    
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            return 0;
        }
    }
    
}
?>
