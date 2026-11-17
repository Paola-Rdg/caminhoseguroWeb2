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

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
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
        $this->cpf = $cpf;
    }

    public function getDataNascimento()
    {
        return $this->data_nascimento;
    }

    public function setDataNascimento($data_nascimento)
    {
        $this->data_nascimento = $data_nascimento;
    }

    public function getPerfilInteresse()
    {
        return $this->perfil_interesse;
    }

    public function setPerfilInteresse($perfil_interesse)
    {
        $this->perfil_interesse = $perfil_interesse;
    }

    public function listarTodos($pdo)
    {
        $sql = "SELECT id_usuario, nome, email, cpf, data_nascimento, perfil_interesse FROM usuario ORDER BY nome ASC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function emailExiste($pdo, $email)
    {
        $sql = "SELECT id_usuario FROM usuario WHERE email = :email LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    public function salvar($pdo)
    {
        $sql = "INSERT INTO usuario (nome, email, senha, cpf, data_nascimento, perfil_interesse) 
                VALUES (:nome, :email, :senha, :cpf, :data_nascimento, :perfil_interesse)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':nome' => $this->nome,
            ':email' => $this->email,
            ':senha' => md5($this->senha),
            ':cpf' => $this->cpf,
            ':data_nascimento' => $this->data_nascimento,
            ':perfil_interesse' => $this->perfil_interesse
        ]);
    }
}