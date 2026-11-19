<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Editar Usuário</h1>

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
            <form action="/caminhoseguroWeb2/user/update/<?= $usuario['id_usuario'] ?>" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="nome">Nome Completo</label>
                        <input type="text" name="nome" id="nome" class="form-control" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
                    </div>
                    <?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'admin'): ?>
                        <div class="form-group col-md-4">
                            <label for="tipo_usuario">Tipo de Usuário</label>
                            <select name="tipo_usuario" id="tipo_usuario" class="form-control">
                                <option value="comum" <?= $usuario['tipo_usuario'] === 'comum' ? 'selected' : '' ?>>Usuário Comum</option>
                                <option value="admin" <?= $usuario['tipo_usuario'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
                            </select>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($usuario['email']) ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="senha">Nova Senha (deixe em branco para manter a atual)</label>
                        <input type="password" name="senha" id="senha" class="form-control">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="cpf">CPF</label>
                        <input type="text" name="cpf" id="cpf" class="form-control" maxlength="14" value="<?= htmlspecialchars($usuario['cpf']) ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="data_nascimento">Data de Nascimento</label>
                        <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="<?= htmlspecialchars($usuario['data_nascimento']) ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="perfil_interesse">Perfil de Interesse</label>
                        <select name="perfil_interesse" id="perfil_interesse" class="form-control" required>
                            <option value="Pedestre" <?= $usuario['perfil_interesse'] === 'Pedestre' ? 'selected' : '' ?>>Pedestre</option>
                            <option value="Ciclista" <?= $usuario['perfil_interesse'] === 'Ciclista' ? 'selected' : '' ?>>Ciclista</option>
                            <option value="Motorista" <?= $usuario['perfil_interesse'] === 'Motorista' ? 'selected' : '' ?>>Motorista</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="/caminhoseguroWeb2/home/index" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>