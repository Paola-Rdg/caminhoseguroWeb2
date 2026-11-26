<?php

namespace App\Models;

use PDO;

class PerguntaQuiz
{
    private $id_pergunta;
    private $texto_pergunta;
    private $pontuacao;
    private $explicacao;
    private $id_quiz;

    public function __construct($dados = [])
    {
        if (!empty($dados)) {
            $this->id_pergunta = $dados['id_pergunta'] ?? null;
            $this->texto_pergunta = trim($dados['texto_pergunta'] ?? '');
            $this->pontuacao = (float)($dados['pontuacao'] ?? 1);
            $this->explicacao = trim($dados['explicacao'] ?? '');
            $this->id_quiz = (int)($dados['id_quiz'] ?? 0);
        }
    }

    public function getIdPergunta() { return $this->id_pergunta; }
    public function setIdPergunta($id) { $this->id_pergunta = $id; }

    public function getTextoPergunta() { return $this->texto_pergunta; }
    public function setTextoPergunta($texto) { $this->texto_pergunta = $texto; }

    public function getPontuacao() { return $this->pontuacao; }
    public function setPontuacao($pontuacao) { $this->pontuacao = (float)$pontuacao; }

    public function getExplicacao() { return $this->explicacao; }
    public function setExplicacao($explicacao) { $this->explicacao = $explicacao; }

    public function getIdQuiz() { return $this->id_quiz; }
    public function setIdQuiz($idQuiz) { $this->id_quiz = (int)$idQuiz; }

    public function listarPorQuiz($pdo, $idQuiz)
    {
        $sql = "SELECT * FROM perguntas_quiz WHERE id_quiz = :id_quiz ORDER BY id_pergunta ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_quiz' => $idQuiz]);
        $perguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $alternativaModel = new Alternativa();
        foreach ($perguntas as &$p) {
            $p['alternativas'] = $alternativaModel->listarPorPergunta($pdo, $p['id_pergunta']);
        }

        return $perguntas;
    }

    public function buscarPorId($pdo, $idPergunta)
    {
        $sql = "SELECT * FROM perguntas_quiz WHERE id_pergunta = :id LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $idPergunta]);
        $pergunta = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($pergunta) {
            $alternativaModel = new Alternativa();
            $pergunta['alternativas'] = $alternativaModel->listarPorPergunta($pdo, $idPergunta);
        }

        return $pergunta;
    }

    public function salvarComAlternativas($pdo, $idQuiz, $textoPergunta, $pontuacao, $explicacao, $alternativas, $corretaIndex)
    {
        $sql = "INSERT INTO perguntas_quiz (texto_pergunta, pontuacao, explicacao, id_quiz) 
                VALUES (:texto, :pontuacao, :explicacao, :id_quiz)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':texto' => $textoPergunta,
            ':pontuacao' => $pontuacao,
            ':explicacao' => $explicacao,
            ':id_quiz' => $idQuiz
        ]);

        $idPergunta = (int)$pdo->lastInsertId();

        foreach ($alternativas as $i => $alt) {
            if (!empty(trim($alt['texto'] ?? ''))) {
                $alternativaObj = new Alternativa([
                    'texto_alternativa' => $alt['texto'],
                    'status_alternativa' => ((int)$corretaIndex === (int)$i) ? 1 : 0,
                    'explicacao_altern' => $alt['explicacao'] ?? 'Sem observação adicional.',
                    'id_pergunta' => $idPergunta
                ]);
                $alternativaObj->salvar($pdo);
            }
        }

        return true;
    }

    public function atualizarComAlternativas($pdo, $idPergunta, $textoPergunta, $pontuacao, $explicacao, $alternativas, $corretaIndex)
    {
        $sql = "UPDATE perguntas_quiz 
                SET texto_pergunta = :texto, pontuacao = :pontuacao, explicacao = :explicacao 
                WHERE id_pergunta = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':texto' => $textoPergunta,
            ':pontuacao' => $pontuacao,
            ':explicacao' => $explicacao,
            ':id' => $idPergunta
        ]);

        foreach ($alternativas as $i => $alt) {
            $textoAlt = trim($alt['texto'] ?? '');
            if ($textoAlt === '') {
                continue;
            }

            $alternativaObj = new Alternativa([
                'id_alternativa' => $alt['id_alternativa'] ?? null,
                'texto_alternativa' => $textoAlt,
                'status_alternativa' => ((int)$corretaIndex === (int)$i) ? 1 : 0,
                'explicacao_altern' => $alt['explicacao'] ?? 'Sem observação adicional.',
                'id_pergunta' => $idPergunta
            ]);

            if (!empty($alt['id_alternativa'])) {
                $alternativaObj->atualizar($pdo);
            } else {
                $alternativaObj->salvar($pdo);
            }
        }

        return true;
    }

    public function excluir($pdo, $idPergunta)
    {
        $sql = "DELETE FROM perguntas_quiz WHERE id_pergunta = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':id' => $idPergunta]);
    }
}