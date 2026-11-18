<?php

namespace App\Controllers;

use App\Models\User;
use App\Validators\UserValidator;
use Config\Database;

class UserController
{
    public function index()
    {
        $pdo = Database::connect();
        $userModel = new User();
        $usuarios = $userModel->listarTodos($pdo);

        require_once __DIR__ . '/../Views/users/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../Views/users/create.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $erros = UserValidator::validar($_POST);
            $pdo = Database::connect();
            $user = new User();

            $email = trim($_POST['email'] ?? '');
            if (empty($erros) && $user->emailExiste($pdo, $email)) {
                $erros[] = "Este e-mail já está cadastrado no sistema.";
            }

            if (!empty($erros)) {
                require_once __DIR__ . '/../Views/users/create.php';
                return;
            }

            $user->setNome(trim($_POST['nome']));
            $user->setEmail($email);
            $user->setSenha($_POST['senha']);
            $user->setCpf(preg_replace('/[^0-9]/', '', $_POST['cpf']));
            $user->setDataNascimento($_POST['data_nascimento']);
            $user->setPerfilInteresse($_POST['perfil_interesse']);

            if ($user->salvar($pdo)) {
                header('Location: /caminhoseguroWeb2/user/index');
                exit;
            }
        }
    }
}