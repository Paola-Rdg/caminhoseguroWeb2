<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Cadastrar Conteúdo Educativo</h1>

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
            <form action="/caminhoseguroWeb2/conteudo/store" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="perfil_associado">Perfil Associado</label>
                        <select name="perfil_associado" id="perfil_associado" class="form-control" required>
                            <option value="Pedestre">Pedestre</option>
                            <option value="Ciclista">Ciclista</option>
                            <option value="Motorista">Motorista</option>
                        </select>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="palavras_chave">Palavras-chave</label>
                        <input type="text" name="palavras_chave" id="palavras_chave" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="textos">Texto Explicativo (CTB)</label>
                    <textarea name="textos" id="textos" rows="5" class="form-control" required></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="infograficos">Link do Infográfico (opcional)</label>
                        <input type="text" name="infograficos" id="infograficos" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="videos">Link do Vídeo (opcional)</label>
                        <input type="text" name="videos" id="videos" class="form-control">
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Salvar Conteúdo</button>
                <a href="/caminhoseguroWeb2/conteudo/index" class="btn btn-secondary">Voltar</a>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>