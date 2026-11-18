<?php

namespace App\Controllers;

use App\Models\Conteudo;
use App\Validators\ConteudoValidator;
use Config\Database;

class ConteudoController
{
    public function index()
    {
        $pdo = Database::connect();
        $conteudoModel = new Conteudo();
        $conteudos = $conteudoModel->listarTodos($pdo);

        require_once __DIR__ . '/../Views/conteudos/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../Views/conteudos/create.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $erros = ConteudoValidator::validar($_POST);

            if (!empty($erros)) {
                require_once __DIR__ . '/../Views/conteudos/create.php';
                return;
            }

            $pdo = Database::connect();
            $conteudo = new Conteudo();
            $conteudo->setTextos(trim($_POST['textos']));
            $conteudo->setInfograficos(trim($_POST['infograficos'] ?? ''));
            $conteudo->setVideos(trim($_POST['videos'] ?? ''));
            $conteudo->setPalavrasChave(trim($_POST['palavras_chave']));
            $conteudo->setPerfilAssociado($_POST['perfil_associado']);

            if ($conteudo->salvar($pdo)) {
                header('Location: /caminhoseguroWeb2/conteudo/index');
                exit;
            }
        }
    }
}