<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Simulações de Situações Reais de Trânsito</h1>
    <p class="text-gray-600 mb-4">Escolha a atitude correta em cada cenário e veja a consequência imediata segundo o CTB.</p>

    <div class="row">
        <?php foreach ($cenarios as $c): ?>
            <div class="col-md-12 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary"><?= htmlspecialchars($c['titulo']) ?></h6>
                        <span class="badge badge-info">Perfil: <?= htmlspecialchars($c['perfil']) ?></span>
                    </div>
                    <div class="card-body">
                        <p class="font-weight-bold text-gray-800"><?= htmlspecialchars($c['situacao']) ?></p>

                        <?php foreach ($c['opcoes'] as $idx => $op): ?>
                            <button type="button"
                                class="btn btn-outline-primary btn-block text-left mb-2"
                                onclick="mostrarFeedback(<?= $c['id'] ?>, <?= $op['correta'] ? 'true' : 'false' ?>, '<?= addslashes($op['feedback']) ?>')">
                                <?= ($idx + 1) . ') ' . htmlspecialchars($op['texto']) ?>
                            </button>
                        <?php endforeach; ?>

                        <div id="feedback_<?= $c['id'] ?>" class="alert mt-3 d-none"></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    function mostrarFeedback(id, correta, texto) {
        const box = document.getElementById('feedback_' + id);
        box.classList.remove('d-none', 'alert-success', 'alert-danger');
        box.classList.add(correta ? 'alert-success' : 'alert-danger');
        box.innerHTML = '<strong>' + (correta ? 'Decisão Segura: ' : 'Atenção: ') + '</strong>' + texto;
    }
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>