<?php

namespace App\Models;

use PDO;

class PerguntaQuiz
{
    public function listarPorQuiz($pdo, $idQuiz)
    {
        $sql = "SELECT * FROM perguntas_quiz WHERE id_quiz = :id_quiz ORDER BY id_pergunta ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_quiz' => $idQuiz]);
        $perguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($perguntas as &$p) {
            $sqlAlt = "SELECT * FROM alternativas WHERE id_pergunta = :id_pergunta ORDER BY id_alternativa ASC";
            $stmtAlt = $pdo->prepare($sqlAlt);
            $stmtAlt->execute([':id_pergunta' => $p['id_pergunta']]);
            $p['alternativas'] = $stmtAlt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $perguntas;
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

        $idPergunta = $pdo->lastInsertId();

        $sqlAlt = "INSERT INTO alternativas (texto_alternativa, status_alternativa, explicacao_altern, id_pergunta) 
                   VALUES (:texto, :status, :explicacao, :id_pergunta)";
        $stmtAlt = $pdo->prepare($sqlAlt);

        foreach ($alternativas as $i => $alt) {
            if (!empty(trim($alt['texto'] ?? ''))) {
                $stmtAlt->execute([
                    ':texto' => trim($alt['texto']),
                    ':status' => ((int)$corretaIndex === (int)$i) ? 1 : 0,
                    ':explicacao' => trim($alt['explicacao'] ?? 'Sem observação adicional.'),
                    ':id_pergunta' => $idPergunta
                ]);
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
