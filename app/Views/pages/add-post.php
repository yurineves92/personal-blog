<div class="posts-section">
    <h2 class="posts-title">✍️ Novo Post</h2>
    <form method="post" action="/add-post">
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Conteúdo</label>
            <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status">
                <option value="rascunho">📝 Rascunho</option>
                <option value="publicado">✅ Publicado</option>
                <option value="arquivado">📦 Arquivado</option>
            </select>
        </div>
        <button type="submit" class="btn btn-subscribe">Salvar Post</button>
        <a href="/profile" class="btn btn-outline-light ms-2">Cancelar</a>
    </form>
</div>