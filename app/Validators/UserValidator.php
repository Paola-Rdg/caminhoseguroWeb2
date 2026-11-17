<?php

namespace App\Validators;

class UserValidator
{
    public static function validar($dados)
    {
        $erros = [];

        if (empty(trim($dados['nome'] ?? ''))) {
            $erros[] = "O nome completo é obrigatório.";
        }

        $email = trim($dados['email'] ?? '');
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erros[] = "Informe um e-mail válido.";
        }

        if (empty($dados['senha'] ?? '')) {
            $erros[] = "A senha é obrigatória.";
        }

        $cpf = preg_replace('/[^0-9]/', '', $dados['cpf'] ?? '');
        if (strlen($cpf) !== 11) {
            $erros[] = "O CPF deve conter 11 dígitos.";
        }

        if (empty($dados['data_nascimento'] ?? '')) {
            $erros[] = "A data de nascimento é obrigatória.";
        }

        if (empty($dados['perfil_interesse'] ?? '')) {
            $erros[] = "Selecione o perfil de interesse.";
        }

        return $erros;
    }
}