<?php
require_once 'app/Controllers/BaseController.php';

class UserController extends BaseController
{
    public function profile()
    {
        $this->requireAuth();
        $stmt = $this->pdo->prepare("
            SELECT * FROM posts 
            WHERE user_id = ? 
            ORDER BY created_at DESC
        ");
        $stmt->execute([$_SESSION['user_id']]);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $this->view('profile', ['posts' => $posts]);
    }
}
?>