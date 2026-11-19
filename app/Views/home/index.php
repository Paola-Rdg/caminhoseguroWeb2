<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <div class="jumbotron bg-white shadow-sm border-left-primary">
        <div class="d-flex align-items-center mb-3">
            <img src="/caminhoseguroWeb2/public/img/logo.png" alt="Logo Caminho Seguro Web" class="logo-sistema mr-3" style="width: 64px; height: 64px;">
            <div>
                <h1 class="h3 text-gray-900 font-weight-bold mb-1">Caminho Seguro Web</h1>
                <p class="text-gray-700 mb-0">
                    Plataforma educativa e gamificada sobre o Código de Trânsito Brasileiro (CTB) para jovens pedestres, ciclistas e futuros motoristas.
                </p>
            </div>
        </div>

        <form action="/caminhoseguroWeb2/home/index" method="GET" class="form-inline mt-3">
            <input type="text" name="busca" class="form-control mr-2 col-md-6" placeholder="Pesquisar conteúdos, quizzes ou simulações (ex: faixa, rotatória, bicicleta)..." value="<?= htmlspecialchars($busca) ?>">
            <button type="submit" class="btn btn-primary">Pesquisar</button>
            <?php if ($busca !== ''): ?>
                <a href="/caminhoseguroWeb2/home/index" class="btn btn-link">Limpar busca</a>
            <?php endif; ?>
        </form>
    </div>

    <?php if ($busca !== ''): ?>
        <h2 class="h5 text-gray-800 mb-3">Resultados da pesquisa por "<?= htmlspecialchars($busca) ?>"</h2>

        <?php if (empty($conteudosEncontrados) && empty($quizzesEncontrados) && empty($simulacoesEncontradas)): ?>
            <div class="alert alert-warning">Nenhum conteúdo, quiz ou simulação encontrado para esse termo.</div>
        <?php else: ?>
            <div class="row mb-4">
                <?php foreach ($conteudosEncontrados as $item): ?>
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm h-100 border-left-primary">
                            <div class="card-body">
                                <span class="badge badge-primary mb-2">Conteúdo &bull; <?= htmlspecialchars($item['perfil_associado']) ?></span>
                                <p class="card-text"><?= nl2br(htmlspecialchars($item['textos'])) ?></p>
                                <small class="text-muted">Palavras-chave: <?= htmlspecialchars($item['palavras_chave']) ?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php foreach ($quizzesEncontrados as $q): ?>
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm h-100 border-left-success">
                            <div class="card-body">
                                <span class="badge badge-success mb-2">Quiz &bull; <?= htmlspecialchars($q['perfil_associado']) ?></span>
                                <p class="mb-2">Nível <?= $q['nivel_dificuldade'] ?> &mdash; Vale <?= $q['pontuacao_total'] ?> pontos.</p>
                                <a href="/caminhoseguroWeb2/quiz/responder/<?= $q['id_quiz'] ?>" class="btn btn-sm btn-success">Responder Quiz</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php foreach ($simulacoesEncontradas as $sim): ?>
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm h-100 border-left-info">
                            <div class="card-body">
                                <span class="badge badge-info mb-2">Simulação &bull; <?= htmlspecialchars($sim['perfil']) ?></span>
                                <h6 class="font-weight-bold"><?= htmlspecialchars($sim['titulo']) ?></h6>
                                <a href="/caminhoseguroWeb2/simulacao/index" class="btn btn-sm btn-info">Acessar Simulação</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <h2 class="h5 text-gray-800 mb-3">Navegue pela sua Trilha de Mobilidade</h2>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <h5 class="font-weight-bold text-success"><i class="fas fa-walking mr-2"></i>Sou Pedestre</h5>
                    <p class="text-gray-700 small">Travessia segura, uso obrigatório da faixa, calçadas e direitos do pedestre no CTB.</p>
                    <a href="/caminhoseguroWeb2/conteudo/trilha/Pedestre" class="btn btn-sm btn-success">Acessar Trilha</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <h5 class="font-weight-bold text-info"><i class="fas fa-bicycle mr-2"></i>Sou Ciclista</h5>
                    <p class="text-gray-700 small">Circulação em ciclovias e bordos da pista, sinalização e segurança viária.</p>
                    <a href="/caminhoseguroWeb2/conteudo/trilha/Ciclista" class="btn btn-sm btn-info">Acessar Trilha</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <h5 class="font-weight-bold text-warning"><i class="fas fa-car mr-2"></i>Sou Motorista</h5>
                    <p class="text-gray-700 small">Distância lateral de 1,50m ao ciclista, rotatórias, preferência na faixa e direção defensiva.</p>
                    <a href="/caminhoseguroWeb2/conteudo/trilha/Motorista" class="btn btn-sm btn-warning text-dark">Acessar Trilha</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>