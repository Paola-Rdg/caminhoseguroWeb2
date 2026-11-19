<?php

namespace App\Validators;

class QuizValidator
{
    public static function validar($dados)
    {
        $erros = [];

        if (empty($dados['quant_perguntas']) || (int)$dados['quant_perguntas'] <= 0) {
            $erros[] = "A quantidade de perguntas deve ser maior que zero.";
        }

        if (empty($dados['nivel_dificuldade'])) {
            $erros[] = "Selecione o nível de dificuldade.";
        }

        if (empty($dados['pontuacao_total']) || (float)$dados['pontuacao_total'] <= 0) {
            $erros[] = "A pontuação total deve ser maior que zero.";
        }

        if (empty($dados['perfil_associado'])) {
            $erros[] = "Selecione o perfil associado ao quiz.";
        }

        return $erros;
    }
}
