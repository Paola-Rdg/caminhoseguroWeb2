<?php

namespace App\Models;

use PDO;

class User
{
    private $id_usuario;
    private $nome;
    private $email;
    private $senha;
    private $cpf;
    private $data_nascimento;
    private $perfil_interesse;
    private $tipo_usuario;

    public function __construct($dados = [])
    {
        if (!empty($dados)) {
            $this->id_usuario = $dados['id_usuario'] ?? null;
            $this->nome = trim($dados['nome'] ?? '');
            $this->email = trim($dados['email'] ?? '');
            $this->senha = $dados['senha'] ?? '';
            $this->cpf = $this->limparCpf($dados['cpf'] ?? '');
            $this->data_nascimento = $dados['data_nascimento'] ?? '';
            $this->perfil_interesse = $dados['perfil_interesse'] ?? 'Pedestre';
            $this->tipo_usuario = $dados['tipo_usuario'] ?? 'comum';
        }
    }

    private function limparCpf($cpf)
    {
        return preg_replace('/[^0-9]/', '', $cpf);
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }
    public function setIdUsuario($id)
    {
        $this->id_usuario = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSenha()
    {
        return $this->senha;
    }
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getCpf()
    {
        return $this->cpf;
    }
    public function setCpf($cpf)
    {
        $this->cpf = $this->limparCpf($cpf);
    }

    public function getDataNascimento()
    {
        return $this->data_nascimento;
    }
    public function setDataNascimento($data)
    {
        $this->data_nascimento = $data;
    }

    public function getPerfilInteresse()
    {
        return $this->perfil_interesse;
    }
    public function setPerfilInteresse($perfil)
    {
        $this->perfil_interesse = $perfil;
    }

    public function getTipoUsuario()
    {
        return $this->tipo_usuario;
    }
    public function setTipoUsuario($tipo)
    {
        $this->tipo_usuario = $tipo;
    }

    public function listarTodos($pdo)
    {
        $sql = "SELECT id_usuario, nome, email, cpf, data_nascimento, perfil_interesse, tipo_usuario 
                FROM usuario ORDER BY nome ASC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($pdo, $id)
    {
        $sql = "SELECT * FROM usuario WHERE id_usuario = :id LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorEmail($pdo, $email)
    {
        $sql = "SELECT * FROM usuario WHERE email = :email LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function autenticar($pdo, $email, $senha)
    {
        $sql = "SELECT * FROM usuario WHERE email = :email AND senha = :senha LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':email' => $email,
            ':senha' => md5($senha)
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar($pdo)
    {
        $sql = "INSERT INTO usuario (nome, email, senha, cpf, data_nascimento, perfil_interesse, tipo_usuario) 
                VALUES (:nome, :email, :senha, :cpf, :data_nascimento, :perfil_interesse, :tipo_usuario)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':nome' => $this->nome,
            ':email' => $this->email,
            ':senha' => md5($this->senha),
            ':cpf' => $this->cpf,
            ':data_nascimento' => $this->data_nascimento,
            ':perfil_interesse' => $this->perfil_interesse,
            ':tipo_usuario' => $this->tipo_usuario ?: 'comum'
        ]);
    }

    public function atualizar($pdo)
    {
        $params = [
            ':nome' => $this->nome,
            ':email' => $this->email,
            ':cpf' => $this->cpf,
            ':data_nascimento' => $this->data_nascimento,
            ':perfil_interesse' => $this->perfil_interesse,
            ':tipo_usuario' => $this->tipo_usuario,
            ':id' => $this->id_usuario
        ];

        if (!empty($this->senha)) {
            $sql = "UPDATE usuario SET nome = :nome, email = :email, senha = :senha, cpf = :cpf, 
                    data_nascimento = :data_nascimento, perfil_interesse = :perfil_interesse, tipo_usuario = :tipo_usuario 
                    WHERE id_usuario = :id";
            $params[':senha'] = md5($this->senha);
        } else {
            $sql = "UPDATE usuario SET nome = :nome, email = :email, cpf = :cpf, 
                    data_nascimento = :data_nascimento, perfil_interesse = :perfil_interesse, tipo_usuario = :tipo_usuario 
                    WHERE id_usuario = :id";
        }

        $stmt = $pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function redefinirSenha($pdo, $email, $cpf, $novaSenha)
    {
        $sql = "UPDATE usuario SET senha = :senha WHERE email = :email AND cpf = :cpf";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':senha' => md5($novaSenha),
            ':email' => $email,
            ':cpf' => $this->limparCpf($cpf)
        ]);
        return $stmt->rowCount() > 0;
    }

    public function excluir($pdo, $id)
    {
        $sql = "DELETE FROM usuario WHERE id_usuario = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
