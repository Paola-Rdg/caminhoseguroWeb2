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

    public function getIdQuiz() { return $this->id_quiz; }
    public function setIdQuiz($id_quiz) { $this->id_quiz = $id_quiz; }

    public function getQuantPerguntas() { return $this->quant_perguntas; }
    public function setQuantPerguntas($quant_perguntas) { $this->quant_perguntas = $quant_perguntas; }

    public function getNivelDificuldade() { return $this->nivel_dificuldade; }
    public function setNivelDificuldade($nivel_dificuldade) { $this->nivel_dificuldade = $nivel_dificuldade; }

    public function getPontuacaoTotal() { return $this->pontuacao_total; }
    public function setPontuacaoTotal($pontuacao_total) { $this->pontuacao_total = $pontuacao_total; }

    public function getPerfilAssociado() { return $this->perfil_associado; }
    public function setPerfilAssociado($perfil_associado) { $this->perfil_associado = $perfil_associado; }

    public function getIdUsuario() { return $this->id_usuario; }
    public function setIdUsuario($id_usuario) { $this->id_usuario = $id_usuario; }

    public function listarTodos($pdo)
    {
        $sql = "SELECT q.*, u.nome AS nome_usuario 
                FROM quiz q 
                INNER JOIN usuario u ON q.id_usuario = u.id_usuario 
                ORDER BY q.id_quiz DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
}