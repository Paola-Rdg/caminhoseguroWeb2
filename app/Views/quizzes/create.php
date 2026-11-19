<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Cadastrar Quiz</h1>

    <?php if (!empty($erros)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($erros as $erro): ?>
                    <li><?= htmlspecialchars($erro) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/caminhoseguroWeb2/quiz/store" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="perfil_associado">Perfil Associado</label>
                        <select name="perfil_associado" id="perfil_associado" class="form-control" required>
                            <option value="Pedestre">Pedestre</option>
                            <option value="Ciclista">Ciclista</option>
                            <option value="Motorista">Motorista</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nivel_dificuldade">Nível de Dificuldade</label>
                        <select name="nivel_dificuldade" id="nivel_dificuldade" class="form-control" required>
                            <option value="1">1 - Fácil</option>
                            <option value="2">2 - Médio</option>
                            <option value="3">3 - Difícil</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="quant_perguntas">Quantidade Prevista de Perguntas</label>
                        <input type="number" name="quant_perguntas" id="quant_perguntas" class="form-control" min="1" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="pontuacao_total">Pontuação Total</label>
                        <input type="number" step="0.5" name="pontuacao_total" id="pontuacao_total" class="form-control" min="1" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Salvar Quiz</button>
                <a href="/caminhoseguroWeb2/quiz/index" class="btn btn-secondary">Voltar</a>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>