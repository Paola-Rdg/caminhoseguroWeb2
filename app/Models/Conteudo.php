<?php

namespace App\Models;

use PDO;

class Conteudo
{
    private $id_conteudo;
    private $textos;
    private $infograficos;
    private $videos;
    private $palavras_chave;
    private $perfil_associado;

    public function __construct($dados = [])
    {
        if (!empty($dados)) {
            $this->id_conteudo = $dados['id_conteudo'] ?? null;
            $this->textos = trim($dados['textos'] ?? '');
            $this->infograficos = trim($dados['infograficos'] ?? '');
            $this->videos = trim($dados['videos'] ?? '');
            $this->palavras_chave = trim($dados['palavras_chave'] ?? '');
            $this->perfil_associado = $dados['perfil_associado'] ?? '';
        }
    }

    public function getIdConteudo()
    {
        return $this->id_conteudo;
    }
    public function setIdConteudo($id)
    {
        $this->id_conteudo = $id;
    }

    public function getTextos()
    {
        return $this->textos;
    }
    public function setTextos($textos)
    {
        $this->textos = $textos;
    }

    public function getInfograficos()
    {
        return $this->infograficos;
    }
    public function setInfograficos($infograficos)
    {
        $this->infograficos = $infograficos;
    }

    public function getVideos()
    {
        return $this->videos;
    }
    public function setVideos($videos)
    {
        $this->videos = $videos;
    }

    public function getPalavrasChave()
    {
        return $this->palavras_chave;
    }
    public function setPalavrasChave($palavras)
    {
        $this->palavras_chave = $palavras;
    }

    public function getPerfilAssociado()
    {
        return $this->perfil_associado;
    }
    public function setPerfilAssociado($perfil)
    {
        $this->perfil_associado = $perfil;
    }

    public function listarTodos($pdo)
    {
        $sql = "SELECT * FROM conteudo ORDER BY id_conteudo DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorPerfil($pdo, $perfil)
    {
        $sql = "SELECT * FROM conteudo WHERE perfil_associado = :perfil ORDER BY id_conteudo DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':perfil' => $perfil]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function pesquisar($pdo, $termo)
    {
        $sql = "SELECT * FROM conteudo 
                WHERE palavras_chave LIKE :termo OR textos LIKE :termo OR perfil_associado LIKE :termo 
                ORDER BY id_conteudo DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':termo' => '%' . $termo . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($pdo, $id)
    {
        $sql = "SELECT * FROM conteudo WHERE id_conteudo = :id LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar($pdo)
    {
        $sql = "INSERT INTO conteudo (textos, infograficos, videos, palavras_chave, perfil_associado) 
                VALUES (:textos, :infograficos, :videos, :palavras_chave, :perfil_associado)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':textos' => $this->textos,
            ':infograficos' => $this->infograficos !== '' ? $this->infograficos : null,
            ':videos' => $this->videos !== '' ? $this->videos : null,
            ':palavras_chave' => $this->palavras_chave,
            ':perfil_associado' => $this->perfil_associado
        ]);
    }

    public function atualizar($pdo)
    {
        $sql = "UPDATE conteudo SET textos = :textos, infograficos = :infograficos, videos = :videos, 
                palavras_chave = :palavras_chave, perfil_associado = :perfil_associado 
                WHERE id_conteudo = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':textos' => $this->textos,
            ':infograficos' => $this->infograficos !== '' ? $this->infograficos : null,
            ':videos' => $this->videos !== '' ? $this->videos : null,
            ':palavras_chave' => $this->palavras_chave,
            ':perfil_associado' => $this->perfil_associado,
            ':id' => $this->id_conteudo
        ]);
    }

    public function excluir($pdo, $id)
    {
        $sql = "DELETE FROM conteudo WHERE id_conteudo = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
