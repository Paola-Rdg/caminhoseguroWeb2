<?php

namespace App\Models;

use PDO;

class Quiz
{
    private $id_quiz;
    private $quant_perguntas;
    private $nivel_dificuldade;
    private $pontuacao_total;
    private $perfil_associado;
    private $id_usuario;

    public function __construct($dados = [])
    {
        if (!empty($dados)) {
            $this->id_quiz = $dados['id_quiz'] ?? null;
            $this->quant_perguntas = (int)($dados['quant_perguntas'] ?? 0);
            $this->nivel_dificuldade = (int)($dados['nivel_dificuldade'] ?? 1);
            $this->pontuacao_total = (float)($dados['pontuacao_total'] ?? 0);
            $this->perfil_associado = $dados['perfil_associado'] ?? '';
            $this->id_usuario = (int)($dados['id_usuario'] ?? 0);
        }
    }

    public function getIdQuiz()
    {
        return $this->id_quiz;
    }
    public function setIdQuiz($id)
    {
        $this->id_quiz = $id;
    }

    public function getQuantPerguntas()
    {
        return $this->quant_perguntas;
    }
    public function setQuantPerguntas($qtd)
    {
        $this->quant_perguntas = $qtd;
    }

    public function getNivelDificuldade()
    {
        return $this->nivel_dificuldade;
    }
    public function setNivelDificuldade($nivel)
    {
        $this->nivel_dificuldade = $nivel;
    }

    public function getPontuacaoTotal()
    {
        return $this->pontuacao_total;
    }
    public function setPontuacaoTotal($pontos)
    {
        $this->pontuacao_total = $pontos;
    }

    public function getPerfilAssociado()
    {
        return $this->perfil_associado;
    }
    public function setPerfilAssociado($perfil)
    {
        $this->perfil_associado = $perfil;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }
    public function setIdUsuario($id)
    {
        $this->id_usuario = $id;
    }

    public function listarTodos($pdo)
    {
        $sql = "SELECT q.*, u.nome AS nome_usuario,
                (SELECT COUNT(*) FROM perguntas_quiz p WHERE p.id_quiz = q.id_quiz) AS perguntas_cadastradas
                FROM quiz q 
                INNER JOIN usuario u ON q.id_usuario = u.id_usuario 
                ORDER BY q.id_quiz DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function pesquisar($pdo, $termo)
    {
        $sql = "SELECT q.*, 
                (SELECT COUNT(*) FROM perguntas_quiz p WHERE p.id_quiz = q.id_quiz) AS perguntas_cadastradas
                FROM quiz q 
                WHERE q.perfil_associado LIKE :termo 
                ORDER BY q.id_quiz DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':termo' => '%' . $termo . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($pdo, $id)
    {
        $sql = "SELECT * FROM quiz WHERE id_quiz = :id LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar($pdo)
    {
        $sql = "INSERT INTO quiz (quant_perguntas, nivel_dificuldade, pontuacao_total, perfil_associado, id_usuario) 
                VALUES (:quant_perguntas, :nivel_dificuldade, :pontuacao_total, :perfil_associado, :id_usuario)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':quant_perguntas' => $this->quant_perguntas,
            ':nivel_dificuldade' => $this->nivel_dificuldade,
            ':pontuacao_total' => $this->pontuacao_total,
            ':perfil_associado' => $this->perfil_associado,
            ':id_usuario' => $this->id_usuario
        ]);
    }

    public function atualizar($pdo)
    {
        $sql = "UPDATE quiz SET quant_perguntas = :quant_perguntas, nivel_dificuldade = :nivel_dificuldade, 
                pontuacao_total = :pontuacao_total, perfil_associado = :perfil_associado 
                WHERE id_quiz = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':quant_perguntas' => $this->quant_perguntas,
            ':nivel_dificuldade' => $this->nivel_dificuldade,
            ':pontuacao_total' => $this->pontuacao_total,
            ':perfil_associado' => $this->perfil_associado,
            ':id' => $this->id_quiz
        ]);
    }

    public function excluir($pdo, $id)
    {
        $sql = "DELETE FROM quiz WHERE id_quiz = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function registrarResultado($pdo, $idUsuario, $idQuiz, $pontuacaoObtida)
    {
        $sql = "INSERT INTO resultado_quiz (id_usuario, id_quiz, pontuacao_obtida) 
                VALUES (:id_usuario, :id_quiz, :pontuacao)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':id_usuario' => $idUsuario,
            ':id_quiz' => $idQuiz,
            ':pontuacao' => $pontuacaoObtida
        ]);
    }

    public function listarDesempenhoUsuario($pdo, $idUsuario)
    {
        $sql = "SELECT r.*, q.perfil_associado, q.nivel_dificuldade, q.pontuacao_total 
                FROM resultado_quiz r 
                INNER JOIN quiz q ON r.id_quiz = q.id_quiz 
                WHERE r.id_usuario = :id_usuario 
                ORDER BY r.data_realizacao DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_usuario' => $idUsuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
