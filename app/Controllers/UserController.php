<?php

namespace App\Controllers;

use App\Models\User;
use App\Validators\UserValidator;

class UserController extends BaseController
{
    public function index()
    {
        $this->exigirAdmin();
        $userModel = new User();
        $usuarios = $userModel->listarTodos($this->pdo);

        $this->render('users/index', ['usuarios' => $usuarios]);
    }

    public function create()
    {
        $this->exigirAdmin();
        $this->render('users/create');
    }

    public function store()
    {
        $this->exigirAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $erros = UserValidator::validar($_POST, true);
            $user = new User($_POST);

            if (empty($erros) && $user->buscarPorEmail($this->pdo, $user->getEmail())) {
                $erros[] = "Este e-mail já está cadastrado.";
            }

            if (!empty($erros)) {
                $this->render('users/create', ['erros' => $erros]);
                return;
            }

            if ($user->salvar($this->pdo)) {
                $this->redirect('user/index');
            }
        }
    }

    public function edit($id)
    {
        $this->exigirLogin();
        $id = (int)$id;

        if (!$this->isAdmin() && (int)$_SESSION['usuario_id'] !== $id) {
            $this->redirect('home/index');
        }

        $userModel = new User();
        $usuario = $userModel->buscarPorId($this->pdo, $id);

        if (!$usuario) {
            $this->redirect('user/index');
        }

        $this->render('users/edit', ['usuario' => $usuario]);
    }

    public function update($id)
    {
        $this->exigirLogin();
        $id = (int)$id;

        if (!$this->isAdmin() && (int)$_SESSION['usuario_id'] !== $id) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $erros = UserValidator::validar($_POST, false);
            $userModel = new User();
            $usuarioAtual = $userModel->buscarPorId($this->pdo, $id);

            if (!empty($erros)) {
                $this->render('users/edit', ['erros' => $erros, 'usuario' => $usuarioAtual]);
                return;
            }

            $user = new User($_POST);
            $user->setIdUsuario($id);
            $user->setTipoUsuario($this->isAdmin() ? ($_POST['tipo_usuario'] ?? 'comum') : $usuarioAtual['tipo_usuario']);

            if ($user->atualizar($this->pdo)) {
                if ((int)$_SESSION['usuario_id'] === $id) {
                    $_SESSION['usuario_nome'] = $user->getNome();
                    $_SESSION['usuario_perfil'] = $user->getPerfilInteresse();
                }
                $this->redirect($this->isAdmin() ? 'user/index' : 'home/index');
            }
        }
    }

    public function delete($id)
    {
        $this->exigirAdmin();
        $id = (int)$id;

        if ($id !== (int)$_SESSION['usuario_id']) {
            $userModel = new User();
            $userModel->excluir($this->pdo, $id);
        }

        $this->redirect('user/index');
    }
}
