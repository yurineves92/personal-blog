<?php
require_once 'app/Controllers/BaseController.php';

class HomeController extends BaseController
{
    public function index()
    {
        // Filtros
        $where = ['p.status = ?'];
        $params = ['publicado']; // Só mostra posts publicados

        if (!empty($_GET['author'])) {
            $where[] = 'p.user_id = ?';
            $params[] = $_GET['author'];
        }
        if (!empty($_GET['q'])) {
            $where[] = 'p.title LIKE ?';
            $params[] = '%' . $_GET['q'] . '%';
        }
        $where_sql = 'WHERE ' . implode(' AND ', $where);

        // Paginação
        $page = max(1, intval($_GET['page'] ?? 1));
        $per_page = 5;
        $offset = ($page - 1) * $per_page;

        // Buscar posts com autor (só publicados)
        $sql = "SELECT p.*, u.name as author_name 
                FROM posts p 
                JOIN users u ON p.user_id = u.id 
                $where_sql 
                ORDER BY p.created_at DESC 
                LIMIT $per_page OFFSET $offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Total para paginação
        $count_sql = "SELECT COUNT(*) FROM posts p JOIN users u ON p.user_id = u.id $where_sql";
        $count_stmt = $this->pdo->prepare($count_sql);
        $count_stmt->execute($params);
        $total = $count_stmt->fetchColumn();
        $total_pages = ceil($total / $per_page);

        // Buscar autores para filtro (só quem tem posts publicados)
        $authors_stmt = $this->pdo->query("
            SELECT DISTINCT u.id, u.name 
            FROM users u 
            JOIN posts p ON u.id = p.user_id 
            WHERE p.status = 'publicado' 
            ORDER BY u.name
        ");
        $authors = $authors_stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->view('home', [
            'posts' => $posts,
            'authors' => $authors,
            'current_page' => $page,
            'total_pages' => $total_pages,
            'filters' => $_GET
        ]);
    }

    public function showSubscribe()
    {
        $this->view('subscribe');
    }

    public function subscribe()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

            if ($email) {
                try {
                    $stmt = $this->pdo->prepare("INSERT INTO subscribers (email) VALUES (?)");
                    $stmt->execute([$email]);
                    $_SESSION['message'] = '✅ E-mail inscrito com sucesso! Obrigado por se inscrever.';
                } catch (PDOException $e) {
                    if ($e->getCode() == 23000) { // Duplicate entry
                        $_SESSION['error'] = '⚠️ Este e-mail já está inscrito na nossa newsletter.';
                    } else {
                        $_SESSION['error'] = '❌ Erro no sistema. Tente novamente mais tarde.';
                    }
                }
            } else {
                $_SESSION['error'] = '❌ Por favor, digite um e-mail válido.';
            }
        }
        $this->redirect('/subscribe');
    }

    public function subscribers()
    {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Você precisa estar logado para acessar esta página.';
            $this->redirect('/login');
        }

        $stmt = $this->pdo->query("SELECT id, email, created_at FROM subscribers ORDER BY created_at DESC");
        $subscribers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->view('subscribers', ['subscribers' => $subscribers]);
    }
}
