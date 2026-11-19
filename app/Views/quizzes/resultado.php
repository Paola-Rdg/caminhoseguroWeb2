<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <div class="card border-left-success shadow mb-4">
        <div class="card-body">
            <h1 class="h3 text-gray-900">Resultado do Quiz</h1>
            <p class="lead mb-0">
                Sua pontuação: <strong class="text-success"><?= $pontuacaoObtida ?></strong> de <strong><?= $quiz['pontuacao_total'] ?></strong> pontos!
            </p>
        </div>
    </div>

    <?php foreach ($detalhes as $i => $item): ?>
        <div class="card shadow-sm mb-3 border-left-<?= $item['acertou'] ? 'success' : 'danger' ?>">
            <div class="card-body">
                <h6 class="font-weight-bold">
                    <?= ($i + 1) . '. ' . htmlspecialchars($item['pergunta']['texto_pergunta']) ?>
                    <span class="badge badge-<?= $item['acertou'] ? 'success' : 'danger' ?> ml-2">
                        <?= $item['acertou'] ? 'Acertou' : 'Errou' ?>
                    </span>
                </h6>

                <ul class="mt-2">
                    <?php foreach ($item['pergunta']['alternativas'] as $alt): ?>
                        <li class="<?= (int)$alt['status_alternativa'] === 1 ? 'text-success font-weight-bold' : '' ?>">
                            <?= htmlspecialchars($alt['texto_alternativa']) ?>
                            <?php if ((int)$alt['id_alternativa'] === $item['escolhida']): ?>
                                <span class="badge badge-dark">Sua escolha</span>
                            <?php endif; ?>
                            <br><small class="text-muted"><?= htmlspecialchars($alt['explicacao_altern']) ?></small>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="alert alert-light border mt-2 mb-0 small">
                    <strong>Fundamentação CTB:</strong> <?= htmlspecialchars($item['pergunta']['explicacao']) ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <a href="/caminhoseguroWeb2/quiz/desempenho" class="btn btn-primary">Ver Meu Histórico</a>
    <a href="/caminhoseguroWeb2/quiz/index" class="btn btn-secondary">Voltar aos Quizzes</a>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>