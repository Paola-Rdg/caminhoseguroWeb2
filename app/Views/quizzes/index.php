<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php $isAdmin = isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'admin'; ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Quizzes de Educação no Trânsito</h1>
        <?php if ($isAdmin): ?>
            <a href="/caminhoseguroWeb2/quiz/create" class="btn btn-primary">Novo Quiz</a>
        <?php endif; ?>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Perfil</th>
                            <th>Dificuldade</th>
                            <th>Perguntas</th>
                            <th>Pontuação Total</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($quizzes)): ?>
                            <?php foreach ($quizzes as $q): ?>
                                <tr>
                                    <td><span class="badge badge-primary"><?= htmlspecialchars($q['perfil_associado']) ?></span></td>
                                    <td>Nível <?= htmlspecialchars($q['nivel_dificuldade']) ?></td>
                                    <td><?= $q['perguntas_cadastradas'] ?> / <?= htmlspecialchars($q['quant_perguntas']) ?></td>
                                    <td><?= htmlspecialchars($q['pontuacao_total']) ?> pts</td>
                                    <td>
                                        <?php if ((int)$q['perguntas_cadastradas'] > 0): ?>
                                            <a href="/caminhoseguroWeb2/quiz/responder/<?= $q['id_quiz'] ?>" class="btn btn-sm btn-success">Realizar Quiz</a>
                                        <?php endif; ?>

                                        <?php if ($isAdmin): ?>
                                            <a href="/caminhoseguroWeb2/quiz/perguntas/<?= $q['id_quiz'] ?>" class="btn btn-sm btn-info">Perguntas</a>
                                            <a href="/caminhoseguroWeb2/quiz/edit/<?= $q['id_quiz'] ?>" class="btn btn-sm btn-warning text-dark">Editar</a>
                                            <a href="/caminhoseguroWeb2/quiz/delete/<?= $q['id_quiz'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir este quiz e todas as suas perguntas?');">Excluir</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Nenhum quiz cadastrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>