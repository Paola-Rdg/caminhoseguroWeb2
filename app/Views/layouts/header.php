<?php
$logado = isset($_SESSION['usuario_id']);
$isAdmin = isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'admin';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Caminho Seguro Web</title>

    <link rel="icon" type="image/png" href="/caminhoseguroWeb2/public/img/logo.png">
    <link href="/caminhoseguroWeb2/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="/caminhoseguroWeb2/public/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/caminhoseguroWeb2/public/css/estilo.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center py-3" href="/caminhoseguroWeb2/home/index">
                <div class="sidebar-brand-icon">
                    <img src="/caminhoseguroWeb2/public/img/logo.png" alt="Logo Caminho Seguro Web" class="logo-sistema">
                </div>
                <div class="sidebar-brand-text mx-2 text-left" style="font-size: 0.85rem; line-height: 1.2;">
                    Caminho Seguro Web
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="/caminhoseguroWeb2/home/index">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Início &amp; Pesquisa</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Trilhas CTB</div>

            <li class="nav-item">
                <a class="nav-link" href="/caminhoseguroWeb2/conteudo/trilha/Pedestre">
                    <i class="fas fa-fw fa-walking"></i>
                    <span>Sou Pedestre</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/caminhoseguroWeb2/conteudo/trilha/Ciclista">
                    <i class="fas fa-fw fa-bicycle"></i>
                    <span>Sou Ciclista</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/caminhoseguroWeb2/conteudo/trilha/Motorista">
                    <i class="fas fa-fw fa-car"></i>
                    <span>Sou Motorista</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Gamificação</div>

            <li class="nav-item">
                <a class="nav-link" href="/caminhoseguroWeb2/simulacao/index">
                    <i class="fas fa-fw fa-road"></i>
                    <span>Simulações de Trânsito</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/caminhoseguroWeb2/quiz/index">
                    <i class="fas fa-fw fa-question-circle"></i>
                    <span>Quizzes</span>
                </a>
            </li>

            <?php if ($logado): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/caminhoseguroWeb2/quiz/desempenho">
                        <i class="fas fa-fw fa-chart-line"></i>
                        <span>Meu Desempenho</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if ($isAdmin): ?>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Painel Admin</div>

                <li class="nav-item">
                    <a class="nav-link" href="/caminhoseguroWeb2/user/index">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Gerenciar Usuários</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/caminhoseguroWeb2/conteudo/index">
                        <i class="fas fa-fw fa-book"></i>
                        <span>Gerenciar Conteúdos</span>
                    </a>
                </li>
            <?php endif; ?>

            <hr class="sidebar-divider d-none d-md-block">
        </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <div class="d-flex align-items-center">
                        <img src="/caminhoseguroWeb2/public/img/logo.png" alt="Logo" class="logo-sistema mr-2 d-md-none" style="width:36px;height:36px;">
                        <span class="navbar-text font-weight-bold text-gray-800">
                            Educação para o Trânsito &bull; CTB
                        </span>
                    </div>

                    <ul class="navbar-nav ml-auto align-items-center">
                        <li class="nav-item mr-2">
                            <button type="button" onclick="alternarContraste()" class="btn btn-sm btn-outline-dark" title="Alternar Alto Contraste">
                                <i class="fas fa-adjust"></i> <span class="d-none d-lg-inline">Alto Contraste</span>
                            </button>
                        </li>

                        <?php if ($logado): ?>
                            <li class="nav-item mr-2 d-flex align-items-center">
                                <span class="badge badge-<?= $isAdmin ? 'danger' : 'info' ?> mr-2">
                                    <?= $isAdmin ? 'Admin' : 'Usuário' ?>
                                </span>
                                <span class="text-gray-800 small font-weight-bold d-none d-sm-inline">
                                    <?= htmlspecialchars($_SESSION['usuario_nome']) ?>
                                </span>
                            </li>
                            <li class="nav-item">
                                <a href="/caminhoseguroWeb2/user/edit/<?= $_SESSION['usuario_id'] ?>" class="btn btn-sm btn-outline-primary mr-2">
                                    Perfil
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/caminhoseguroWeb2/auth/logout" class="btn btn-sm btn-outline-danger">
                                    Sair
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a href="/caminhoseguroWeb2/auth/login" class="btn btn-sm btn-primary mr-2">Entrar</a>
                            </li>
                            <li class="nav-item">
                                <a href="/caminhoseguroWeb2/auth/register" class="btn btn-sm btn-success">Cadastrar</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>