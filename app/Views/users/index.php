<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Gerenciar Usuários</h1>
        <a href="/caminhoseguroWeb2/user/create" class="btn btn-primary">Novo Usuário</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>CPF</th>
                            <th>Perfil</th>
                            <th>Tipo</th>
                            <th width="160">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $u): ?>
                            <tr>
                                <td><?= htmlspecialchars($u['nome']) ?></td>
                                <td><?= htmlspecialchars($u['email']) ?></td>
                                <td><?= htmlspecialchars($u['cpf']) ?></td>
                                <td><?= htmlspecialchars($u['perfil_interesse']) ?></td>
                                <td>
                                    <span class="badge badge-<?= $u['tipo_usuario'] === 'admin' ? 'danger' : 'secondary' ?>">
                                        <?= htmlspecialchars($u['tipo_usuario']) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="/caminhoseguroWeb2/user/edit/<?= $u['id_usuario'] ?>" class="btn btn-sm btn-warning text-dark">Editar</a>
                                    <?php if ((int)$u['id_usuario'] !== (int)$_SESSION['usuario_id']): ?>
                                        <a href="/caminhoseguroWeb2/user/delete/<?= $u['id_usuario'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirma a exclusão deste usuário?');">Excluir</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>