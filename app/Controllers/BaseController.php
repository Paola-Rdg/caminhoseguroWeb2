<?php

namespace App\Controllers;

use Config\Database;

class BaseController
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    protected function render($view, $dados = [])
    {
        extract($dados);
        require_once __DIR__ . '/../Views/' . $view . '.php';
    }

    protected function redirect($rota)
    {
        header('Location: /caminhoseguroWeb2/' . ltrim($rota, '/'));
        exit;
    }

    protected function isLogado()
    {
        return isset($_SESSION['usuario_id']);
    }

    protected function isAdmin()
    {
        return isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'admin';
    }

    protected function exigirLogin()
    {
        if (!$this->isLogado()) {
            $_SESSION['erro_login'] = "Faça login para acessar esta área.";
            $this->redirect('auth/login');
        }
    }

    protected function exigirAdmin()
    {
        if (!$this->isAdmin()) {
            $this->redirect('home/index');
        }
    }
}
