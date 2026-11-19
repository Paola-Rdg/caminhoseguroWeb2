<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Editar Conteúdo Educativo</h1>

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
            <form action="/caminhoseguroWeb2/conteudo/update/<?= $conteudo['id_conteudo'] ?>" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="perfil_associado">Perfil Associado</label>
                        <select name="perfil_associado" id="perfil_associado" class="form-control" required>
                            <option value="Pedestre" <?= $conteudo['perfil_associado'] === 'Pedestre' ? 'selected' : '' ?>>Pedestre</option>
                            <option value="Ciclista" <?= $conteudo['perfil_associado'] === 'Ciclista' ? 'selected' : '' ?>>Ciclista</option>
                            <option value="Motorista" <?= $conteudo['perfil_associado'] === 'Motorista' ? 'selected' : '' ?>>Motorista</option>
                        </select>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="palavras_chave">Palavras-chave</label>
                        <input type="text" name="palavras_chave" id="palavras_chave" class="form-control" value="<?= htmlspecialchars($conteudo['palavras_chave']) ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="textos">Texto Explicativo</label>
                    <textarea name="textos" id="textos" rows="5" class="form-control" required><?= htmlspecialchars($conteudo['textos']) ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="infograficos">Link do Infográfico</label>
                        <input type="text" name="infograficos" id="infograficos" class="form-control" value="<?= htmlspecialchars($conteudo['infograficos'] ?? '') ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="videos">Link do Vídeo</label>
                        <input type="text" name="videos" id="videos" class="form-control" value="<?= htmlspecialchars($conteudo['videos'] ?? '') ?>">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="/caminhoseguroWeb2/conteudo/index" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>