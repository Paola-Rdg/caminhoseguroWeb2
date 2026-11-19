<?php

namespace App\Controllers;

use App\Models\User;
use App\Validators\UserValidator;

class AuthController extends BaseController
{
    public function login()
    {
        $erro = $_SESSION['erro_login'] ?? null;
        unset($_SESSION['erro_login']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $senha = $_POST['senha'] ?? '';

            $userModel = new User();
            $usuario = $userModel->autenticar($this->pdo, $email, $senha);

            if ($usuario) {
                $_SESSION['usuario_id'] = $usuario['id_usuario'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_perfil'] = $usuario['perfil_interesse'];
                $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

                if ($usuario['tipo_usuario'] === 'admin') {
                    $this->redirect('user/index');
                } else {
                    $this->redirect('conteudo/trilha/' . $usuario['perfil_interesse']);
                }
            } else {
                $erro = "E-mail ou senha inválidos.";
            }
        }

        $this->render('auth/login', ['erro' => $erro]);
    }

    public function register()
    {
        $erros = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $erros = UserValidator::validar($_POST, true);
            $user = new User($_POST);

            if (empty($erros) && $user->buscarPorEmail($this->pdo, $user->getEmail())) {
                $erros[] = "Este e-mail já está cadastrado no sistema.";
            }

            if (empty($erros)) {
                $user->setTipoUsuario('comum');
                if ($user->salvar($this->pdo)) {
                    $_SESSION['sucesso_auth'] = "Conta criada com sucesso! Entre com seu e-mail e senha.";
                    $this->redirect('auth/login');
                }
            }
        }

        $this->render('auth/register', ['erros' => $erros]);
    }

    public function resetSenha()
    {
        $mensagem = null;
        $erro = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $cpf = $_POST['cpf'] ?? '';
            $novaSenha = $_POST['nova_senha'] ?? '';

            if ($email === '' || strlen(preg_replace('/[^0-9]/', '', $cpf)) !== 11 || $novaSenha === '') {
                $erro = "Informe o e-mail, os 11 dígitos do CPF e a nova senha.";
            } else {
                $userModel = new User();
                if ($userModel->redefinirSenha($this->pdo, $email, $cpf, $novaSenha)) {
                    $mensagem = "Senha redefinida com sucesso! Você já pode fazer login.";
                } else {
                    $erro = "Nenhum cadastro encontrado com esse e-mail e CPF.";
                }
            }
        }

        $this->render('auth/reset_senha', ['mensagem' => $mensagem, 'erro' => $erro]);
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        $this->redirect('home/index');
    }
}
