<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Perguntas do Quiz (<?= htmlspecialchars($quiz['perfil_associado']) ?>)</h1>
        <a href="/caminhoseguroWeb2/quiz/index" class="btn btn-secondary">Voltar aos Quizzes</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Adicionar Pergunta de Múltipla Escolha</h6>
        </div>
        <div class="card-body">
            <form action="/caminhoseguroWeb2/quiz/perguntas/<?= $quiz['id_quiz'] ?>" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label>Enunciado da Pergunta</label>
                        <input type="text" name="texto_pergunta" class="form-control" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Pontuação</label>
                        <input type="number" step="0.5" name="pontuacao" class="form-control" value="5" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Explicação Geral (Baseada no CTB)</label>
                    <input type="text" name="explicacao" class="form-control" required>
                </div>

                <label class="font-weight-bold">Alternativas (marque a correta):</label>
                <?php for ($i = 0; $i < 3; $i++): ?>
                    <div class="form-row align-items-center mb-2">
                        <div class="col-auto">
                            <input type="radio" name="correta" value="<?= $i ?>" <?= $i === 0 ? 'checked' : '' ?>>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="alternativas[<?= $i ?>][texto]" class="form-control" placeholder="Texto da alternativa <?= $i + 1 ?>" required>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="alternativas[<?= $i ?>][explicacao]" class="form-control" placeholder="Explicação desta alternativa">
                        </div>
                    </div>
                <?php endfor; ?>

                <button type="submit" class="btn btn-success mt-3">Salvar Pergunta</button>
            </form>
        </div>
    </div>

    <?php foreach ($perguntas as $idx => $p): ?>
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="font-weight-bold mb-0"><?= ($idx + 1) . '. ' . htmlspecialchars($p['texto_pergunta']) ?> (<?= $p['pontuacao'] ?> pts)</h6>
                    <div>
                        <a href="/caminhoseguroWeb2/quiz/editarPergunta/<?= $p['id_pergunta'] ?>/<?= $quiz['id_quiz'] ?>" class="btn btn-sm btn-warning text-dark">Editar</a>
                        <a href="/caminhoseguroWeb2/quiz/excluirPergunta/<?= $p['id_pergunta'] ?>/<?= $quiz['id_quiz'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir esta pergunta?');">Excluir</a>
                    </div>
                </div>
                <ul class="mb-2">
                    <?php foreach ($p['alternativas'] as $alt): ?>
                        <li class="<?= (int)$alt['status_alternativa'] === 1 ? 'text-success font-weight-bold' : '' ?>">
                            <?= htmlspecialchars($alt['texto_alternativa']) ?>
                            <?= (int)$alt['status_alternativa'] === 1 ? '(Correta)' : '' ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <small class="text-muted">Explicação CTB: <?= htmlspecialchars($p['explicacao']) ?></small>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>