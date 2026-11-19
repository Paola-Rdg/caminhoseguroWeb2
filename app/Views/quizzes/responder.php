<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Quiz &mdash; Perfil <?= htmlspecialchars($quiz['perfil_associado']) ?></h1>

    <form action="/caminhoseguroWeb2/quiz/corrigir/<?= $quiz['id_quiz'] ?>" method="POST">
        <?php foreach ($perguntas as $i => $p): ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Questão <?= $i + 1 ?> (Vale <?= $p['pontuacao'] ?> pts)
                    </h6>
                </div>
                <div class="card-body">
                    <p class="font-weight-bold text-gray-900"><?= htmlspecialchars($p['texto_pergunta']) ?></p>

                    <?php foreach ($p['alternativas'] as $alt): ?>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="respostas[<?= $p['id_pergunta'] ?>]" id="alt_<?= $alt['id_alternativa'] ?>" value="<?= $alt['id_alternativa'] ?>" required>
                            <label class="form-check-label" for="alt_<?= $alt['id_alternativa'] ?>">
                                <?= htmlspecialchars($alt['texto_alternativa']) ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <button type="submit" class="btn btn-success btn-lg">Finalizar e Ver Resultado</button>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>