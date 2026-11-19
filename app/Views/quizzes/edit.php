<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Editar Quiz</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/caminhoseguroWeb2/quiz/update/<?= $quiz['id_quiz'] ?>" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="perfil_associado">Perfil Associado</label>
                        <select name="perfil_associado" id="perfil_associado" class="form-control" required>
                            <option value="Pedestre" <?= $quiz['perfil_associado'] === 'Pedestre' ? 'selected' : '' ?>>Pedestre</option>
                            <option value="Ciclista" <?= $quiz['perfil_associado'] === 'Ciclista' ? 'selected' : '' ?>>Ciclista</option>
                            <option value="Motorista" <?= $quiz['perfil_associado'] === 'Motorista' ? 'selected' : '' ?>>Motorista</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nivel_dificuldade">Nível de Dificuldade</label>
                        <select name="nivel_dificuldade" id="nivel_dificuldade" class="form-control" required>
                            <option value="1" <?= (int)$quiz['nivel_dificuldade'] === 1 ? 'selected' : '' ?>>1 - Fácil</option>
                            <option value="2" <?= (int)$quiz['nivel_dificuldade'] === 2 ? 'selected' : '' ?>>2 - Médio</option>
                            <option value="3" <?= (int)$quiz['nivel_dificuldade'] === 3 ? 'selected' : '' ?>>3 - Difícil</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="quant_perguntas">Quantidade Prevista de Perguntas</label>
                        <input type="number" name="quant_perguntas" id="quant_perguntas" class="form-control" value="<?= $quiz['quant_perguntas'] ?>" min="1" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="pontuacao_total">Pontuação Total</label>
                        <input type="number" step="0.5" name="pontuacao_total" id="pontuacao_total" class="form-control" value="<?= $quiz['pontuacao_total'] ?>" min="1" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="/caminhoseguroWeb2/quiz/index" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>