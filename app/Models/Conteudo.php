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

    public function getIdConteudo() { return $this->id_conteudo; }
    public function setIdConteudo($id_conteudo) { $this->id_conteudo = $id_conteudo; }

    public function getTextos() { return $this->textos; }
    public function setTextos($textos) { $this->textos = $textos; }

    public function getInfograficos() { return $this->infograficos; }
    public function setInfograficos($infograficos) { $this->infograficos = $infograficos; }

    public function getVideos() { return $this->videos; }
    public function setVideos($videos) { $this->videos = $videos; }

    public function getPalavrasChave() { return $this->palavras_chave; }
    public function setPalavrasChave($palavras_chave) { $this->palavras_chave = $palavras_chave; }

    public function getPerfilAssociado() { return $this->perfil_associado; }
    public function setPerfilAssociado($perfil_associado) { $this->perfil_associado = $perfil_associado; }

    public function listarTodos($pdo)
    {
        $sql = "SELECT * FROM conteudo ORDER BY id_conteudo DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar($pdo)
    {
        $sql = "INSERT INTO conteudo (textos, infograficos, videos, palavras_chave, perfil_associado) 
                VALUES (:textos, :infograficos, :videos, :palavras_chave, :perfil_associado)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':textos' => $this->textos,
            ':infograficos' => $this->infograficos ?: null,
            ':videos' => $this->videos ?: null,
            ':palavras_chave' => $this->palavras_chave,
            ':perfil_associado' => $this->perfil_associado
        ]);
    }
}