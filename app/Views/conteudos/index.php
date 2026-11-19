<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Conteúdos Educativos</h1>
        <a href="/caminhoseguroWeb2/conteudo/create" class="btn btn-primary">Novo Conteúdo</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Perfil</th>
                            <th>Palavras-chave</th>
                            <th>Texto Explicativo</th>
                            <th>Recursos</th>
                            <th width="160">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($conteudos)): ?>
                            <?php foreach ($conteudos as $c): ?>
                                <tr>
                                    <td><span class="badge badge-primary"><?= htmlspecialchars($c['perfil_associado']) ?></span></td>
                                    <td><?= htmlspecialchars($c['palavras_chave']) ?></td>
                                    <td><?= htmlspecialchars(mb_strimwidth($c['textos'], 0, 80, '...')) ?></td>
                                    <td>
                                        <?php if (!empty($c['infograficos'])): ?><span class="badge badge-info">Infográfico</span><?php endif; ?>
                                        <?php if (!empty($c['videos'])): ?><span class="badge badge-success">Vídeo</span><?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="/caminhoseguroWeb2/conteudo/edit/<?= $c['id_conteudo'] ?>" class="btn btn-sm btn-warning text-dark">Editar</a>
                                        <a href="/caminhoseguroWeb2/conteudo/delete/<?= $c['id_conteudo'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir este conteúdo?');">Excluir</a>
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