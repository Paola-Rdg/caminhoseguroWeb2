<?php

namespace App\Controllers;

use App\Models\Conteudo;
use App\Models\Quiz;

class HomeController extends BaseController
{
    public function index()
    {
        $busca = trim($_GET['busca'] ?? '');
        $conteudosEncontrados = [];
        $quizzesEncontrados = [];
        $simulacoesEncontradas = [];

        if ($busca !== '') {
            $conteudoModel = new Conteudo();
            $quizModel = new Quiz();

            $conteudosEncontrados = $conteudoModel->pesquisar($this->pdo, $busca);
            $quizzesEncontrados = $quizModel->pesquisar($this->pdo, $busca);

            $todasSimulacoes = SimulacaoController::obterCenarios();
            foreach ($todasSimulacoes as $sim) {
                $textoBusca = mb_strtolower($sim['titulo'] . ' ' . $sim['perfil'] . ' ' . $sim['situacao']);
                if (strpos($textoBusca, mb_strtolower($busca)) !== false) {
                    $simulacoesEncontradas[] = $sim;
                }
            }
        }

        $this->render('home/index', [
            'busca' => $busca,
            'conteudosEncontrados' => $conteudosEncontrados,
            'quizzesEncontrados' => $quizzesEncontrados,
            'simulacoesEncontradas' => $simulacoesEncontradas
        ]);
    }
}
