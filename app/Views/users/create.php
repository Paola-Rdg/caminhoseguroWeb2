<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Cadastrar Usuário</h1>

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
            <form action="/caminhoseguroWeb2/user/store" method="POST">
                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" class="form-control" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="cpf">CPF</label>
                        <input type="text" name="cpf" id="cpf" class="form-control" maxlength="14" value="<?= htmlspecialchars($_POST['cpf'] ?? '') ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="data_nascimento">Data de Nascimento</label>
                        <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="<?= htmlspecialchars($_POST['data_nascimento'] ?? '') ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="perfil_interesse">Perfil de Interesse</label>
                        <select name="perfil_interesse" id="perfil_interesse" class="form-control" required>
                            <option value="">Selecione...</option>
                            <option value="Pedestre">Pedestre</option>
                            <option value="Ciclista">Ciclista</option>
                            <option value="Motorista">Futuro Motorista</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Salvar Cadastro</button>
                <a href="/caminhoseguroWeb2/user/index" class="btn btn-secondary">Voltar</a>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>