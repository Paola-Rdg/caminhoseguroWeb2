<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center">
                    <img src="/caminhoseguroWeb2/public/img/logo.png" alt="Logo" class="logo-sistema mr-2" style="width:32px;height:32px;">
                    <h6 class="m-0 font-weight-bold text-primary">Cadastrar Usuário &mdash; Caminho Seguro Web</h6>
                </div>
                <div class="card-body">
                    <?php if (!empty($erros)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($erros as $e): ?>
                                    <li><?= htmlspecialchars($e) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="/caminhoseguroWeb2/auth/register" method="POST">
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
                                <label for="cpf">CPF (apenas números)</label>
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
                        <button type="submit" class="btn btn-success btn-block">Criar Conta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>