<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Trilha: Sou <?= htmlspecialchars($perfil) ?></h1>
        <a href="/caminhoseguroWeb2/quiz/index" class="btn btn-primary">Testar Conhecimentos no Quiz</a>
    </div>

    <?php if (!empty($conteudos)): ?>
        <div class="row">
            <?php foreach ($conteudos as $c): ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow h-100">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <span class="font-weight-bold text-primary">Normas do CTB</span>
                            <span class="badge badge-secondary"><?= htmlspecialchars($c['palavras_chave']) ?></span>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-gray-800"><?= nl2br(htmlspecialchars($c['textos'])) ?></p>

                            <?php if (!empty($c['infograficos'])): ?>
                                <a href="<?= htmlspecialchars($c['infograficos']) ?>" target="_blank" class="btn btn-sm btn-outline-info mr-2">
                                    <i class="fas fa-image mr-1"></i> Ver Infográfico
                                </a>
                            <?php endif; ?>

                            <?php if (!empty($c['videos'])): ?>
                                <a href="<?= htmlspecialchars($c['videos']) ?>" target="_blank" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-play-circle mr-1"></i> Assistir Vídeo
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">Ainda não há conteúdos cadastrados para esta trilha.</div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>