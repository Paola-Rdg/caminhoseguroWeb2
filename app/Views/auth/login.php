<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center">
                    <img src="/caminhoseguroWeb2/public/img/logo.png" alt="Logo" class="logo-sistema mr-2" style="width:32px;height:32px;">
                    <h6 class="m-0 font-weight-bold text-primary">Entrar no Caminho Seguro Web</h6>
                </div>
                <div class="card-body">
                    <?php if (!empty($_SESSION['sucesso_auth'])): ?>
                        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['sucesso_auth']) ?></div>
                        <?php unset($_SESSION['sucesso_auth']); ?>
                    <?php endif; ?>

                    <?php if (!empty($erro)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
                    <?php endif; ?>

                    <form action="/caminhoseguroWeb2/auth/login" method="POST">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input type="password" name="senha" id="senha" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Acessar Plataforma</button>
                    </form>

                    <hr>
                    <div class="text-center small">
                        <a href="/caminhoseguroWeb2/auth/resetSenha">Esqueci minha senha</a> |
                        <a href="/caminhoseguroWeb2/auth/register">Criar conta de estudante</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>