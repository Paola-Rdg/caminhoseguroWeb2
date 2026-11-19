<?php

namespace App\Controllers;

use App\Models\PerguntaQuiz;
use App\Models\Quiz;
use App\Validators\QuizValidator;

class QuizController extends BaseController
{
    public function index()
    {
        $quizModel = new Quiz();
        $quizzes = $quizModel->listarTodos($this->pdo);

        $this->render('quizzes/index', ['quizzes' => $quizzes]);
    }

    public function create()
    {
        $this->exigirAdmin();
        $this->render('quizzes/create');
    }

    public function store()
    {
        $this->exigirAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $erros = QuizValidator::validar($_POST);

            if (!empty($erros)) {
                $this->render('quizzes/create', ['erros' => $erros]);
                return;
            }

            $quiz = new Quiz($_POST);
            $quiz->setIdUsuario((int)$_SESSION['usuario_id']);

            if ($quiz->salvar($this->pdo)) {
                $this->redirect('quiz/index');
            }
        }
    }

    public function edit($id)
    {
        $this->exigirAdmin();
        $quizModel = new Quiz();
        $quiz = $quizModel->buscarPorId($this->pdo, (int)$id);

        if (!$quiz) {
            $this->redirect('quiz/index');
        }

        $this->render('quizzes/edit', ['quiz' => $quiz]);
    }

    public function update($id)
    {
        $this->exigirAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $erros = QuizValidator::validar($_POST);
            $quizModel = new Quiz();

            if (!empty($erros)) {
                $quiz = $quizModel->buscarPorId($this->pdo, (int)$id);
                $this->render('quizzes/edit', ['erros' => $erros, 'quiz' => $quiz]);
                return;
            }

            $quiz = new Quiz($_POST);
            $quiz->setIdQuiz((int)$id);

            if ($quiz->atualizar($this->pdo)) {
                $this->redirect('quiz/index');
            }
        }
    }

    public function delete($id)
    {
        $this->exigirAdmin();
        $quizModel = new Quiz();
        $quizModel->excluir($this->pdo, (int)$id);

        $this->redirect('quiz/index');
    }

    public function perguntas($idQuiz)
    {
        $this->exigirAdmin();
        $idQuiz = (int)$idQuiz;

        $quizModel = new Quiz();
        $perguntaModel = new PerguntaQuiz();

        $quiz = $quizModel->buscarPorId($this->pdo, $idQuiz);
        if (!$quiz) {
            $this->redirect('quiz/index');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $textoPergunta = trim($_POST['texto_pergunta'] ?? '');
            $pontuacao = (float)($_POST['pontuacao'] ?? 1);
            $explicacao = trim($_POST['explicacao'] ?? '');
            $alternativas = $_POST['alternativas'] ?? [];
            $correta = $_POST['correta'] ?? 0;

            if ($textoPergunta !== '' && $explicacao !== '') {
                $perguntaModel->salvarComAlternativas($this->pdo, $idQuiz, $textoPergunta, $pontuacao, $explicacao, $alternativas, $correta);
                $this->redirect('quiz/perguntas/' . $idQuiz);
            }
        }

        $perguntas = $perguntaModel->listarPorQuiz($this->pdo, $idQuiz);
        $this->render('quizzes/perguntas', [
            'quiz' => $quiz,
            'perguntas' => $perguntas
        ]);
    }

    public function excluirPergunta($idPergunta, $idQuiz)
    {
        $this->exigirAdmin();
        $perguntaModel = new PerguntaQuiz();
        $perguntaModel->excluir($this->pdo, (int)$idPergunta);

        $this->redirect('quiz/perguntas/' . (int)$idQuiz);
    }

    public function responder($idQuiz)
    {
        $this->exigirLogin();
        $idQuiz = (int)$idQuiz;

        $quizModel = new Quiz();
        $perguntaModel = new PerguntaQuiz();

        $quiz = $quizModel->buscarPorId($this->pdo, $idQuiz);
        $perguntas = $perguntaModel->listarPorQuiz($this->pdo, $idQuiz);

        if (!$quiz || empty($perguntas)) {
            $this->redirect('quiz/index');
        }

        $this->render('quizzes/responder', [
            'quiz' => $quiz,
            'perguntas' => $perguntas
        ]);
    }

    public function corrigir($idQuiz)
    {
        $this->exigirLogin();
        $idQuiz = (int)$idQuiz;

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('quiz/index');
        }

        $quizModel = new Quiz();
        $perguntaModel = new PerguntaQuiz();

        $quiz = $quizModel->buscarPorId($this->pdo, $idQuiz);
        $perguntas = $perguntaModel->listarPorQuiz($this->pdo, $idQuiz);
        $respostasUsuario = $_POST['respostas'] ?? [];

        $pontuacaoObtida = 0.0;
        $detalhes = [];

        foreach ($perguntas as $p) {
            $idPerg = $p['id_pergunta'];
            $idAltEscolhida = (int)($respostasUsuario[$idPerg] ?? 0);
            $acertou = false;

            foreach ($p['alternativas'] as $alt) {
                if ((int)$alt['id_alternativa'] === $idAltEscolhida && (int)$alt['status_alternativa'] === 1) {
                    $acertou = true;
                    $pontuacaoObtida += (float)$p['pontuacao'];
                }
            }

            $detalhes[] = [
                'pergunta' => $p,
                'escolhida' => $idAltEscolhida,
                'acertou' => $acertou
            ];
        }

        $quizModel->registrarResultado($this->pdo, (int)$_SESSION['usuario_id'], $idQuiz, $pontuacaoObtida);

        $this->render('quizzes/resultado', [
            'quiz' => $quiz,
            'pontuacaoObtida' => $pontuacaoObtida,
            'detalhes' => $detalhes
        ]);
    }

    public function desempenho()
    {
        $this->exigirLogin();
        $quizModel = new Quiz();
        $historico = $quizModel->listarDesempenhoUsuario($this->pdo, (int)$_SESSION['usuario_id']);

        $this->render('quizzes/desempenho', ['historico' => $historico]);
    }
}
