<?php

namespace App\Controllers;

use App\Models\Quiz;
use App\Models\User;
use App\Validators\QuizValidator;
use Config\Database;

class QuizController
{
    public function index()
    {
        $pdo = Database::connect();
        $quizModel = new Quiz();
        $quizzes = $quizModel->listarTodos($pdo);

        require_once __DIR__ . '/../Views/quizzes/index.php';
    }

    public function create()
    {
        $pdo = Database::connect();
        $userModel = new User();
        $usuarios = $userModel->listarTodos($pdo);

        require_once __DIR__ . '/../Views/quizzes/create.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $erros = QuizValidator::validar($_POST);
            $pdo = Database::connect();

            if (!empty($erros)) {
                $userModel = new User();
                $usuarios = $userModel->listarTodos($pdo);
                require_once __DIR__ . '/../Views/quizzes/create.php';
                return;
            }

            $quiz = new Quiz();
            $quiz->setQuantPerguntas((int)$_POST['quant_perguntas']);
            $quiz->setNivelDificuldade((int)$_POST['nivel_dificuldade']);
            $quiz->setPontuacaoTotal((float)$_POST['pontuacao_total']);
            $quiz->setPerfilAssociado($_POST['perfil_associado']);
            $quiz->setIdUsuario((int)$_POST['id_usuario']);

            if ($quiz->salvar($pdo)) {
                header('Location: /caminhoseguroWeb2/quiz/index');
                exit;
            }
        }
    }
}