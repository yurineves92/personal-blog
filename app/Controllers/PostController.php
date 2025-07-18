<?php
require_once 'app/Controllers/BaseController.php';

class PostController extends BaseController
{
    public function show($id)
    {
        $stmt = $this->pdo->prepare("
            SELECT p.*, u.name as author_name 
            FROM posts p 
            JOIN users u ON p.user_id = u.id 
            WHERE p.id = ? AND p.status = 'publicado'
        ");
        $stmt->execute([$id]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$post) {
            http_response_code(404);
            echo "Post não encontrado ou não publicado";
            return;
        }
        $this->view('post', ['post' => $post]);
    }

    public function create()
    {
        $this->requireAuth();
        $this->view('add-post');
    }

    public function store()
    {
        $this->requireAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $status = $_POST['status'] ?? 'rascunho';

            if (empty($title) || empty($content)) {
                $_SESSION['error'] = 'Título e conteúdo são obrigatórios.';
                $this->redirect('/add-post');
                return;
            }

            $stmt = $this->pdo->prepare("INSERT INTO posts (user_id, title, content, status) VALUES (?, ?, ?, ?)");
            $stmt->execute([$_SESSION['user_id'], $title, $content, $status]);

            $_SESSION['message'] = 'Post criado com sucesso!';
            $this->redirect('/profile');
        }
    }

    public function edit($id)
    {
        $this->requireAuth();
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE id = ? AND user_id = ?");
        $stmt->execute([$id, $_SESSION['user_id']]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$post) {
            $_SESSION['error'] = 'Post não encontrado ou você não tem permissão para editá-lo.';
            $this->redirect('/profile');
            return;
        }

        $this->view('edit-post', ['post' => $post]);
    }

    public function update($id)
    {
        $this->requireAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $status = $_POST['status'] ?? 'rascunho';

            if (empty($title) || empty($content)) {
                $_SESSION['error'] = 'Título e conteúdo são obrigatórios.';
                $this->redirect("/edit-post/$id");
                return;
            }

            $stmt = $this->pdo->prepare("
                UPDATE posts 
                SET title = ?, content = ?, status = ?, updated_at = NOW() 
                WHERE id = ? AND user_id = ?
            ");
            $result = $stmt->execute([$title, $content, $status, $id, $_SESSION['user_id']]);

            if ($result && $stmt->rowCount() > 0) {
                $_SESSION['message'] = 'Post atualizado com sucesso!';
            } else {
                $_SESSION['error'] = 'Erro ao atualizar o post ou você não tem permissão.';
            }

            $this->redirect('/profile');
        }
    }

    public function delete($id)
    {
        $this->requireAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $this->pdo->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
            $result = $stmt->execute([$id, $_SESSION['user_id']]);

            if ($result && $stmt->rowCount() > 0) {
                $_SESSION['message'] = 'Post excluído com sucesso!';
            } else {
                $_SESSION['error'] = 'Erro ao excluir o post ou você não tem permissão.';
            }
        }
        $this->redirect('/profile');
    }
}
