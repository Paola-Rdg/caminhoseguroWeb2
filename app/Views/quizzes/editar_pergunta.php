<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Editar Pergunta &mdash; Quiz <?= htmlspecialchars($quiz['perfil_associado']) ?></h1>
        <a href="/caminhoseguroWeb2/quiz/perguntas/<?= $quiz['id_quiz'] ?>" class="btn btn-secondary">Cancelar</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/caminhoseguroWeb2/quiz/editarPergunta/<?= $pergunta['id_pergunta'] ?>/<?= $quiz['id_quiz'] ?>" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label>Enunciado da Pergunta</label>
                        <input type="text" name="texto_pergunta" class="form-control" value="<?= htmlspecialchars($pergunta['texto_pergunta']) ?>" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Pontuação</label>
                        <input type="number" step="0.5" name="pontuacao" class="form-control" value="<?= htmlspecialchars($pergunta['pontuacao']) ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Explicação Geral (Baseada no CTB)</label>
                    <input type="text" name="explicacao" class="form-control" value="<?= htmlspecialchars($pergunta['explicacao']) ?>" required>
                </div>

                <label class="font-weight-bold">Alternativas (marque a correta):</label>
                <?php
                $alts = $pergunta['alternativas'] ?? [];
                $totalCampos = max(3, count($alts));
                for ($i = 0; $i < $totalCampos; $i++):
                    $altAtual = $alts[$i] ?? null;
                ?>
                    <div class="form-row align-items-center mb-2">
                        <div class="col-auto">
                            <input type="radio" name="correta" value="<?= $i ?>" <?= ($altAtual && (int)$altAtual['status_alternativa'] === 1) ? 'checked' : '' ?>>
                        </div>
                        <div class="col-md-6">
                            <?php if ($altAtual): ?>
                                <input type="hidden" name="alternativas[<?= $i ?>][id_alternativa]" value="<?= $altAtual['id_alternativa'] ?>">
                            <?php endif; ?>
                            <input type="text" name="alternativas[<?= $i ?>][texto]" class="form-control" value="<?= htmlspecialchars($altAtual['texto_alternativa'] ?? '') ?>" placeholder="Texto da alternativa <?= $i + 1 ?>" <?= $i < 2 ? 'required' : '' ?>>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="alternativas[<?= $i ?>][explicacao]" class="form-control" value="<?= htmlspecialchars($altAtual['explicacao_altern'] ?? '') ?>" placeholder="Explicação desta alternativa">
                        </div>
                    </div>
                <?php endfor; ?>

                <button type="submit" class="btn btn-primary mt-3">Salvar Alterações</button>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>