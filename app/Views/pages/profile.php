<div class="posts-section">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="posts-title mb-2">👤 Meu Perfil</h2>
            <p class="text-muted">Olá, <?= htmlspecialchars($_SESSION['user_name']) ?>!</p>
        </div>
        <a href="/add-post" class="btn btn-subscribe">✍️ Novo Post</a>
    </div>

    <?php if (empty($posts)): ?>
        <div class="text-center py-5">
            <p class="text-muted">Você ainda não criou nenhum post.</p>
            <a href="/add-post" class="btn btn-subscribe">Criar meu primeiro post</a>
        </div>
    <?php else: ?>
        <?php foreach ($posts as $post): ?>
            <article class="post-item">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="post-date">
                        <?= date('d/m/Y H:i', strtotime($post['created_at'])) ?>
                        <?php if ($post['status'] == 'rascunho'): ?>
                            <span class="badge bg-warning text-dark ms-2">📝 Rascunho</span>
                        <?php elseif ($post['status'] == 'arquivado'): ?>
                            <span class="badge bg-secondary ms-2">📦 Arquivado</span>
                        <?php else: ?>
                            <span class="badge bg-success ms-2">✅ Publicado</span>
                        <?php endif; ?>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            ⚙️
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/edit-post/<?= $post['id'] ?>">✏️ Editar</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="post" action="/delete-post/<?= $post['id'] ?>" class="d-inline"
                                    onsubmit="return confirm('Tem certeza que deseja excluir este post?')">
                                    <button type="submit" class="dropdown-item text-danger">🗑️ Excluir</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <h3 class="post-title">
                    <?php if ($post['status'] == 'publicado'): ?>
                        <a href="/post/<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a>
                    <?php else: ?>
                        <?= htmlspecialchars($post['title']) ?>
                    <?php endif; ?>
                </h3>
                <div class="post-excerpt">
                    <?= nl2br(htmlspecialchars(substr($post['content'], 0, 150))) ?>...
                </div>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</div>