<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Quizzes Cadastrados</h1>
        <a href="/caminhoseguroWeb2-1/quiz/create" class="btn btn-primary">Novo Quiz</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Perfil</th>
                            <th>Qtd. Perguntas</th>
                            <th>Dificuldade</th>
                            <th>Pontuação Total</th>
                            <th>Criado por</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($quizzes)): ?>
                            <?php foreach ($quizzes as $q): ?>
                                <tr>
                                    <td><?= htmlspecialchars($q['id_quiz']) ?></td>
                                    <td><?= htmlspecialchars($q['perfil_associado']) ?></td>
                                    <td><?= htmlspecialchars($q['quant_perguntas']) ?></td>
                                    <td>Nível <?= htmlspecialchars($q['nivel_dificuldade']) ?></td>
                                    <td><?= htmlspecialchars($q['pontuacao_total']) ?> pts</td>
                                    <td><?= htmlspecialchars($q['nome_usuario']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Nenhum quiz cadastrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>