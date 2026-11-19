<?php

namespace App\Validators;

class ConteudoValidator
{
    public static function validar($dados)
    {
        $erros = [];

        if (empty(trim($dados['textos'] ?? ''))) {
            $erros[] = "O texto explicativo é obrigatório.";
        }

        if (empty(trim($dados['palavras_chave'] ?? ''))) {
            $erros[] = "Informe as palavras-chave do conteúdo.";
        }

        if (empty($dados['perfil_associado'] ?? '')) {
            $erros[] = "Selecione o perfil associado.";
        }

        return $erros;
    }
}
