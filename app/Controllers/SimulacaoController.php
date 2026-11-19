<?php

namespace App\Controllers;

class SimulacaoController extends BaseController
{
    public static function obterCenarios()
    {
        return [
            [
                'id' => 1,
                'perfil' => 'Pedestre',
                'titulo' => 'Travessia de pedestres em faixa sem semáforo',
                'situacao' => 'Você precisa atravessar uma avenida movimentada e existe uma faixa de pedestres a 25 metros de distância. Qual decisão tomar?',
                'opcoes' => [
                    [
                        'texto' => 'Atravessar direto onde estou aproveitando uma brecha entre os veículos.',
                        'correta' => false,
                        'feedback' => 'Atenção: O Art. 69 do CTB obriga o pedestre a utilizar a faixa quando ela existir a até 50 metros.'
                    ],
                    [
                        'texto' => 'Caminhar até a faixa, sinalizar com a mão, fazer contato visual e atravessar.',
                        'correta' => true,
                        'feedback' => 'Decisão correta! Pelo Art. 70 do CTB, o pedestre tem prioridade na faixa não semaforizada.'
                    ]
                ]
            ],
            [
                'id' => 2,
                'perfil' => 'Motorista',
                'titulo' => 'Comportamento em rotatória urbana',
                'situacao' => 'Você está dirigindo e se aproxima de uma rotatória onde outro veículo já está circulando no contorno. Quem tem a preferência?',
                'opcoes' => [
                    [
                        'texto' => 'O veículo que já está circulando pela rotatória tem a preferência de passagem.',
                        'correta' => true,
                        'feedback' => 'Correto! Conforme o Art. 29, inciso III do CTB, em rotatórias a preferência é de quem já circula por ela.'
                    ],
                    [
                        'texto' => 'Quem entra na rotatória pela direita sempre tem preferência.',
                        'correta' => false,
                        'feedback' => 'Incorreto: a regra da direita vale para cruzamentos sem sinalização, mas na rotatória a preferência é de quem já está nela.'
                    ]
                ]
            ],
            [
                'id' => 3,
                'perfil' => 'Ciclista',
                'titulo' => 'Sinalização semafórica em cruzamento',
                'situacao' => 'Você está pedalando pelo bordo direito da pista e o semáforo fica amarelo, prestes a fechar. Como agir?',
                'opcoes' => [
                    [
                        'texto' => 'Acelerar para tentar cruzar antes que o sinal fique vermelho.',
                        'correta' => false,
                        'feedback' => 'Perigoso! Avançar sinal vermelho é infração gravíssima (Art. 208) e expõe o ciclista a colisões laterais.'
                    ],
                    [
                        'texto' => 'Reduzir a velocidade e parar antes da faixa de retenção até o sinal abrir novamente.',
                        'correta' => true,
                        'feedback' => 'Correto! Ciclistas também devem respeitar a sinalização semafórica prevista no CTB.'
                    ]
                ]
            ]
        ];
    }

    public function index()
    {
        $this->render('simulacoes/index', [
            'cenarios' => self::obterCenarios()
        ]);
    }
}
