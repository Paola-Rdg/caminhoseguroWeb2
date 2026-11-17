<?php

namespace App\Validators;

class ConteudoValidator
{
    public static function validar($dados)
    {
        $erros = [];

        if (empty(trim($dados['textos'] ?? ''))) {
            $erros[] = "O texto explicativo do conteúdo é obrigatório.";
        }

        if (empty(trim($dados['palavras_chave'] ?? ''))) {
            $erros[] = "Informe pelo menos uma palavra-chave.";
        }

        if (empty($dados['perfil_associado'] ?? '')) {
            $erros[] = "Selecione o perfil associado ao conteúdo.";
        }

        return $erros;
    }
}