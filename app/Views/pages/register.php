<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="mb-4">Cadastro</h2>
        <hr/>
        <form method="post" action="/register">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="/login" class="btn btn-link">Já tenho conta</a>
        </form>
    </div>
</div>