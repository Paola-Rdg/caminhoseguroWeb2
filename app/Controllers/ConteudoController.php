<?php

namespace App\Controllers;

use App\Models\Conteudo;
use App\Validators\ConteudoValidator;

class ConteudoController extends BaseController
{
    public function index()
    {
        $this->exigirAdmin();
        $conteudoModel = new Conteudo();
        $conteudos = $conteudoModel->listarTodos($this->pdo);

        $this->render('conteudos/index', ['conteudos' => $conteudos]);
    }

    public function trilha($perfil = 'Pedestre')
    {
        $perfisValidos = ['Pedestre', 'Ciclista', 'Motorista'];
        if (!in_array($perfil, $perfisValidos)) {
            $perfil = 'Pedestre';
        }

        $conteudoModel = new Conteudo();
        $conteudos = $conteudoModel->buscarPorPerfil($this->pdo, $perfil);

        $this->render('conteudos/trilha', [
            'perfil' => $perfil,
            'conteudos' => $conteudos
        ]);
    }

    public function create()
    {
        $this->exigirAdmin();
        $this->render('conteudos/create');
    }

    public function store()
    {
        $this->exigirAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $erros = ConteudoValidator::validar($_POST);

            if (!empty($erros)) {
                $this->render('conteudos/create', ['erros' => $erros]);
                return;
            }

            $conteudo = new Conteudo($_POST);
            $conteudo->setIdUsuario((int)$_SESSION['usuario_id']);

            if ($conteudo->salvar($this->pdo)) {
                $this->redirect('conteudo/index');
            }
        }
    }

    public function edit($id)
    {
        $this->exigirAdmin();
        $conteudoModel = new Conteudo();
        $conteudo = $conteudoModel->buscarPorId($this->pdo, (int)$id);

        if (!$conteudo) {
            $this->redirect('conteudo/index');
        }

        $this->render('conteudos/edit', ['conteudo' => $conteudo]);
    }

    public function update($id)
    {
        $this->exigirAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $erros = ConteudoValidator::validar($_POST);
            $conteudoModel = new Conteudo();

            if (!empty($erros)) {
                $conteudo = $conteudoModel->buscarPorId($this->pdo, (int)$id);
                $this->render('conteudos/edit', ['erros' => $erros, 'conteudo' => $conteudo]);
                return;
            }

            $conteudo = new Conteudo($_POST);
            $conteudo->setIdConteudo((int)$id);

            if ($conteudo->atualizar($this->pdo)) {
                $this->redirect('conteudo/index');
            }
        }
    }

    public function delete($id)
    {
        $this->exigirAdmin();
        $conteudoModel = new Conteudo();
        $conteudoModel->excluir($this->pdo, (int)$id);

        $this->redirect('conteudo/index');
    }
}