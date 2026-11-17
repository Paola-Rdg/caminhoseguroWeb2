<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Conteúdos Educativos</h1>
        <a href="/caminhoseguroWeb2-1/conteudo/create" class="btn btn-primary">Novo Conteúdo</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Perfil Associado</th>
                            <th>Palavras-chave</th>
                            <th>Texto Explicativo</th>
                            <th>Infográfico / Vídeo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($conteudos)): ?>
                            <?php foreach ($conteudos as $c): ?>
                                <tr>
                                    <td><?= htmlspecialchars($c['id_conteudo']) ?></td>
                                    <td><?= htmlspecialchars($c['perfil_associado']) ?></td>
                                    <td><?= htmlspecialchars($c['palavras_chave']) ?></td>
                                    <td><?= htmlspecialchars(mb_strimwidth($c['textos'], 0, 80, '...')) ?></td>
                                    <td>
                                        <?php if (!empty($c['infograficos'])): ?>
                                            <span class="badge badge-info">Infográfico</span>
                                        <?php endif; ?>
                                        <?php if (!empty($c['videos'])): ?>
                                            <span class="badge badge-success">Vídeo</span>
                                        <?php endif; ?>
                                        <?php if (empty($c['infograficos']) && empty($c['videos'])): ?>
                                            <span class="text-muted">Apenas texto</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Nenhum conteúdo cadastrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>