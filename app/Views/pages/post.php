<?php
require_once __DIR__ . '../../../../libs/Parsedown.php';
$Parsedown = new Parsedown();
?>
<!-- Post Individual -->
<article class="post-single">
    <!-- Header do Post -->
    <header class="post-header mb-4">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
                <div class="post-actions">
                    <a href="/edit-post/<?= $post['id'] ?>" class="btn btn-outline-light btn-sm">
                        ✏️ Editar
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <h1 class="post-title-single"><?= htmlspecialchars($post['title']) ?></h1>

        <!-- Status (se não for publicado) -->
        <?php if ($post['status'] !== 'publicado'): ?>
            <div class="post-status-badge">
                <span class="badge bg-warning text-dark">
                    <?= ucfirst($post['status']) ?>
                </span>
            </div>
        <?php endif; ?>
    </header>

    <!-- Conteúdo do Post -->
    <div class="post-content">
        <?= $Parsedown->text($post['content']) ?>
    </div>

    <!-- Footer do Post -->
    <footer class="post-footer mt-5 pt-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="post-tags">
                <small class="text-muted">
                    📅 Publicado em <?= date('d/m/Y \à\s H:i', strtotime($post['created_at'])) ?>
                </small>
            </div>
        </div>
    </footer>
</article>

<!-- Navegação entre posts -->
<nav class="post-navigation mt-5 pt-4">
    <div class="row">
        <?php if (isset($prev_post)): ?>
            <div class="col-md-6">
                <div class="nav-post nav-post-prev">
                    <small class="text-muted">← Post anterior</small>
                    <h6 class="nav-post-title">
                        <a href="/post/<?= $prev_post['id'] ?>" class="text-decoration-none">
                            <?= htmlspecialchars(substr($prev_post['title'], 0, 60)) ?><?= strlen($prev_post['title']) > 60 ? '...' : '' ?>
                        </a>
                    </h6>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($next_post)): ?>
            <div class="col-md-6 text-end">
                <div class="nav-post nav-post-next">
                    <small class="text-muted">Próximo post →</small>
                    <h6 class="nav-post-title">
                        <a href="/post/<?= $next_post['id'] ?>" class="text-decoration-none">
                            <?= htmlspecialchars(substr($next_post['title'], 0, 60)) ?><?= strlen($next_post['title']) > 60 ? '...' : '' ?>
                        </a>
                    </h6>
                </div>
            </div>
        <?php endif; ?>
    </div>
</nav>

<!-- Voltar para home -->
<div class="text-center mt-4">
    <a href="/" class="read-more">← Voltar para todos os posts</a>
</div>