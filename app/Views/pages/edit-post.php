<div class="posts-section">
    <h2 class="posts-title">✏️ Editar Post</h2>
    <form method="post" action="/edit-post/<?= $post['id'] ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($post['title']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Conteúdo</label>
            <textarea class="form-control" id="content" name="content" rows="10" required><?= htmlspecialchars($post['content']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status">
                <option value="rascunho" <?= $post['status'] == 'rascunho' ? 'selected' : '' ?>>📝 Rascunho</option>
                <option value="publicado" <?= $post['status'] == 'publicado' ? 'selected' : '' ?>>✅ Publicado</option>
                <option value="arquivado" <?= $post['status'] == 'arquivado' ? 'selected' : '' ?>>📦 Arquivado</option>
            </select>
        </div>
        <button type="submit" class="btn btn-subscribe">Atualizar Post</button>
        <a href="/profile" class="btn btn-outline-light ms-2">Cancelar</a>
    </form>
</div>