<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Redefinir Senha</h6>
                </div>
                <div class="card-body">
                    <?php if (!empty($mensagem)): ?>
                        <div class="alert alert-success"><?= htmlspecialchars($mensagem) ?></div>
                    <?php endif; ?>
                    <?php if (!empty($erro)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
                    <?php endif; ?>

                    <form action="/caminhoseguroWeb2/auth/resetSenha" method="POST">
                        <div class="form-group">
                            <label for="email">E-mail Cadastrado</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF de Confirmação</label>
                            <input type="text" name="cpf" id="cpf" class="form-control" maxlength="14" required>
                        </div>
                        <div class="form-group">
                            <label for="nova_senha">Nova Senha</label>
                            <input type="password" name="nova_senha" id="nova_senha" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-warning text-dark btn-block">Salvar Nova Senha</button>
                    </form>
                    <hr>
                    <a href="/caminhoseguroWeb2/auth/login" class="small">&larr; Voltar para o Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>