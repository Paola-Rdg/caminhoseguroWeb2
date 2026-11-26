<?php

namespace App\Models;

use PDO;

class Alternativa
{
    private $id_alternativa;
    private $texto_alternativa;
    private $status_alternativa;
    private $explicacao_altern;
    private $id_pergunta;

    public function __construct($dados = [])
    {
        if (!empty($dados)) {
            $this->id_alternativa = $dados['id_alternativa'] ?? null;
            $this->texto_alternativa = trim($dados['texto_alternativa'] ?? '');
            $this->status_alternativa = !empty($dados['status_alternativa']) ? 1 : 0;
            $this->explicacao_altern = trim($dados['explicacao_altern'] ?? 'Sem observação adicional.');
            $this->id_pergunta = (int)($dados['id_pergunta'] ?? 0);
        }
    }

    public function getIdAlternativa() { return $this->id_alternativa; }
    public function setIdAlternativa($id) { $this->id_alternativa = $id; }

    public function getTextoAlternativa() { return $this->texto_alternativa; }
    public function setTextoAlternativa($texto) { $this->texto_alternativa = $texto; }

    public function getStatusAlternativa() { return $this->status_alternativa; }
    public function setStatusAlternativa($status) { $this->status_alternativa = $status ? 1 : 0; }

    public function getExplicacaoAltern() { return $this->explicacao_altern; }
    public function setExplicacaoAltern($explicacao) { $this->explicacao_altern = $explicacao; }

    public function getIdPergunta() { return $this->id_pergunta; }
    public function setIdPergunta($idPergunta) { $this->id_pergunta = (int)$idPergunta; }

    public function listarPorPergunta($pdo, $idPergunta)
    {
        $sql = "SELECT * FROM alternativas WHERE id_pergunta = :id_pergunta ORDER BY id_alternativa ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_pergunta' => $idPergunta]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($pdo, $id)
    {
        $sql = "SELECT * FROM alternativas WHERE id_alternativa = :id LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar($pdo)
    {
        $sql = "INSERT INTO alternativas (texto_alternativa, status_alternativa, explicacao_altern, id_pergunta) 
                VALUES (:texto, :status, :explicacao, :id_pergunta)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':texto' => $this->texto_alternativa,
            ':status' => $this->status_alternativa,
            ':explicacao' => $this->explicacao_altern ?: 'Sem observação adicional.',
            ':id_pergunta' => $this->id_pergunta
        ]);
    }

    public function atualizar($pdo)
    {
        $sql = "UPDATE alternativas 
                SET texto_alternativa = :texto, status_alternativa = :status, explicacao_altern = :explicacao 
                WHERE id_alternativa = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':texto' => $this->texto_alternativa,
            ':status' => $this->status_alternativa,
            ':explicacao' => $this->explicacao_altern ?: 'Sem observação adicional.',
            ':id' => $this->id_alternativa
        ]);
    }

    public function excluir($pdo, $id)
    {
        $sql = "DELETE FROM alternativas WHERE id_alternativa = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}