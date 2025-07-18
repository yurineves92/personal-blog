<h2 class="mb-4">Inscrições</h2>

<?php if (empty($subscribers)): ?>
    <p>Nenhum inscrito encontrado.</p>
<?php else: ?>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Data de Inscrição</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subscribers as $sub): ?>
                <tr>
                    <td><?= $sub['id'] ?></td>
                    <td><?= htmlspecialchars($sub['email']) ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($sub['created_at'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<a href="/" class="btn btn-outline-light mt-3">← Voltar para Home</a>