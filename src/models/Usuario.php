<?php

class Usuario {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function cadastrarUsuario($name, $email, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        if ($stmt->execute()) {
            return "Usuário criado com sucesso";
        } else {
            return "Erro ao criar o usuário.";
        }
    }
    

    public function autenticarUsuario($email, $password) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {
                $_SESSION["loggedin"] = true;
                $_SESSION["user_id"] = $row['id'];  // Armazena o user_id na sessão
                $_SESSION["name"] = $row['name'];
                $_SESSION["email"] = $row['email'];
                
                header("Location: site.php");
                return "Login realizado";
                exit;
            }
        }
        return "Usuário e/ou senha incorretos";
    }
    public function verificarSenha($user_id, $senha) {
        $sql = "SELECT password FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
    
            if ($row) {
                $senha_hash = $row['password'];
                return password_verify($senha, $senha_hash);
            }
        }
    
        return false;
    }
    
    public function excluirConta($user_id) {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
    
        if ($stmt->execute()) {
            // Logout do usuário após excluir a conta
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            session_unset();
            session_destroy();
    
            return "Conta excluída com sucesso";
        } else {
            return "Erro ao excluir a conta.";
        }
    }
    
    
    public function cadastrarEndereco($user_id, $cep, $rua, $numero, $bairro, $cidade) {
        $sql = "UPDATE users SET cep = ?, rua = ?, numero = ?, bairro = ?, cidade = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssissi", $cep, $rua, $numero, $bairro, $cidade, $user_id);
    
        if ($stmt->execute()) {
            return "Endereço cadastrado com sucesso.";
        } else {
            return "Erro ao cadastrar endereço.";
        }
    }
    
    public function obterEndereco($user_id){
        $sql = "SELECT cep, rua, numero, bairro, cidade FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1){
            return $result->fetch_assoc();
        }else {
            return false; // Nenhum endereço cadastrado
        }
    }
    public function obterInformacoesUsuario($user_id) {
        $sql = "SELECT name, email FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function obterTodosUsuarios() {
        $sql = "SELECT id, name FROM users";
        $result = $this->conn->query($sql);

        $usuarios = array();
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }

        return $usuarios;
    }
    public function editarEndereco($user_id, $cep, $rua, $numero, $bairro, $cidade) {
        // Obter o endereço atual
        $enderecoAtual = $this->obterEndereco($user_id);
    
        // Atualizar apenas os campos fornecidos
        $cep = !empty($cep) ? $cep : $enderecoAtual['cep'];
        $rua = !empty($rua) ? $rua : $enderecoAtual['rua'];
        $numero = !empty($numero) ? $numero : $enderecoAtual['numero'];
        $bairro = !empty($bairro) ? $bairro : $enderecoAtual['bairro'];
        $cidade = !empty($cidade) ? $cidade : $enderecoAtual['cidade'];
    
        // Atualizar o endereço no banco de dados
        $sql = "UPDATE users SET cep = ?, rua = ?, numero = ?, bairro = ?, cidade = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssissi", $cep, $rua, $numero, $bairro, $cidade, $user_id);
    
        if ($stmt->execute()) {
            return "Endereço editado com sucesso.";
        } else {
            return "Erro ao atualizar endereço.";
        }
    }
    
    public function excluirEndereco($user_id) {
        $sql = "UPDATE users SET cep = NULL, rua = NULL, numero = NULL, bairro = NULL, cidade = NULL WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
    
        if ($stmt->execute()) {
            return "Endereço excluído com sucesso.";
        } else {
            return "Erro ao excluir endereço.";
        }
    }
    public function adicionarPontos($user_id, $pontos) {
        $sql = "UPDATE users SET pontos = pontos + ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $pontos, $user_id);

        if ($stmt->execute()) {
            return "Pontuação adicionada com sucesso.";
        } else {
            return "Erro ao adicionar pontuação.";
        }
    }
    
    public function obterPontos($user_id) {
        $sql = "SELECT pontos FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row['pontos'];
        } else {
            return 0;
        }
    }


    public function obterRanking() {
        $sql = "SELECT id, name, pontos FROM users ORDER BY pontos DESC";
        $result = $this->conn->query($sql);

        $usuariosRanking = array();

        while ($row = $result->fetch_assoc()) {
            $usuariosRanking[] = $row;
        }

        return $usuariosRanking;
    }

}
?>
