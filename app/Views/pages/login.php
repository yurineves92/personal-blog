<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="mb-4">Login</h2>
        <hr/>
        <form method="post" action="/login">
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
            <a href="/register" class="btn btn-link">Criar conta</a>
        </form>
    </div>
</div>