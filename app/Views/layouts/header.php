<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container main-container py-4">
        <!-- Seção do Perfil -->
        <div class="profile-section">
            <img src="https://avatars.githubusercontent.com/u/9011206?v=4" alt="Yuri do Valle Neves" class="profile-img">
            <h1 class="profile-name">Yuri do Valle Neves</h1>
            <p class="profile-bio">
                Especialista em desenvolvimento de <strong>APIs RESTful</strong>, <strong>integrações de sistemas</strong>
                e arquitetura de software. Escrevo sobre PHP, JavaScript, bancos de dados e as
                tecnologias que uso para criar soluções robustas e escaláveis.
            </p>
        </div>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded mb-4 shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold fs-4" href="/">Personal Blog</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                        <li class="nav-item">
                            <a class="nav-link" href="/subscribe">📧 Newsletter</a>
                        </li>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/add-post">Novo Post</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/subscribers">Inscritos</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="https://avatars.githubusercontent.com/u/9011206?v=4" alt="Avatar" class="rounded-circle me-2" width="30" height="30">
                                    <span><?= htmlspecialchars($_SESSION['user_name'] ?? 'Usuário') ?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="/profile">Meu Perfil</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item text-danger" href="/logout">Sair</a></li>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/register">Cadastro</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Mensagens -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['message'];
                unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>