<!-- Seção de Busca -->
<div class="search-section mb-4">
    <form method="get" action="/" class="d-flex gap-2 mb-2">
        <input type="text" name="q" class="form-control"
            placeholder="🔍 Buscar posts..."
            value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">

        <button type="submit" class="btn btn-outline-light" style="min-width: 80px;">
            Buscar
        </button>
    </form>

    <?php if (!empty($_GET['q']) || !empty($_GET['author'])): ?>
        <div class="d-flex align-items-center justify-content-between">
            <small class="text-muted">
                <?php if (!empty($_GET['q'])): ?>
                    Resultados para: "<strong><?= htmlspecialchars($_GET['q']) ?></strong>"
                <?php endif; ?>
                <?php if (!empty($_GET['author'])): ?>
                    <?php
                    $selected_author = array_filter($authors, fn($a) => $a['id'] == $_GET['author']);
                    $author_name = reset($selected_author)['name'] ?? '';
                    ?>
                    <?= !empty($_GET['q']) ? ' • ' : '' ?>Autor: <strong><?= htmlspecialchars($author_name) ?></strong>
                <?php endif; ?>
            </small>
            <a href="/" class="read-more">Limpar filtros</a>
        </div>
    <?php endif; ?>
</div>

<!-- Seção de Posts -->
<div class="posts-section">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="posts-title mb-0">
            📝 Postagens
            <?php if (isset($total) && $total > 0): ?>
                <small class="text-muted">(<?= $total ?> encontrados)</small>
            <?php endif; ?>
        </h2>
    </div>

    <?php if (empty($posts ?? [])): ?>
        <div class="text-center py-5">
            <?php if (!empty($_GET['q']) || !empty($_GET['author'])): ?>
                <p class="text-muted">Nenhum post encontrado com os filtros aplicados.</p>
                <a href="/" class="btn btn-outline-light">Ver todos os posts</a>
            <?php else: ?>
                <p class="text-muted">Nenhum post publicado ainda.</p>
                <div class="mt-3">
                    <a href="/subscribe" class="btn btn-subscribe me-2">📧 Receber por e-mail</a>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="/add-post" class="btn btn-outline-light">✍️ Escrever post</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <?php foreach ($posts as $post): ?>
            <article class="post-item">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="post-date">
                        <?= date('d/m/Y', strtotime($post['created_at'])) ?>
                    </div>
                    <small class="text-muted">
                        por <?= htmlspecialchars($post['author_name']) ?>
                    </small>
                </div>
                <h3 class="post-title">
                    <a href="/post/<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a>
                </h3>
                <div class="post-excerpt">
                    <?= nl2br(htmlspecialchars(substr($post['content'], 0, 200))) ?>...
                </div>
                <a href="/post/<?= $post['id'] ?>" class="read-more">Leia mais →</a>
            </article>
        <?php endforeach; ?>

        <!-- Paginação -->
        <?php if (($total_pages ?? 1) > 1): ?>
            <nav class="mt-5">
                <ul class="pagination justify-content-center">
                    <!-- Página anterior -->
                    <?php if ($current_page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $current_page - 1])) ?>">
                                ← Anterior
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- Números das páginas -->
                    <?php
                    $start = max(1, $current_page - 2);
                    $end = min($total_pages, $current_page + 2);
                    ?>

                    <?php if ($start > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => 1])) ?>">1</a>
                        </li>
                        <?php if ($start > 2): ?>
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php for ($i = $start; $i <= $end; $i++): ?>
                        <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                            <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($end < $total_pages): ?>
                        <?php if ($end < $total_pages - 1): ?>
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        <?php endif; ?>
                        <li class="page-item">
                            <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $total_pages])) ?>">
                                <?= $total_pages ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- Próxima página -->
                    <?php if ($current_page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $current_page + 1])) ?>">
                                Próxima →
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>
    <?php endif; ?>
</div>