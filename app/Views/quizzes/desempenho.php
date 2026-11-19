<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Meu Desempenho Individual</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Perfil do Quiz</th>
                            <th>Dificuldade</th>
                            <th>Pontuação Obtida</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($historico)): ?>
                            <?php foreach ($historico as $h): ?>
                                <tr>
                                    <td><?= date('d/m/Y H:i', strtotime($h['data_realizacao'])) ?></td>
                                    <td><?= htmlspecialchars($h['perfil_associado']) ?></td>
                                    <td>Nível <?= htmlspecialchars($h['nivel_dificuldade']) ?></td>
                                    <td><strong><?= $h['pontuacao_obtida'] ?></strong> / <?= $h['pontuacao_total'] ?> pts</td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Você ainda não realizou nenhum quiz.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>