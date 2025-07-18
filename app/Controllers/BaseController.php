<?php

class BaseController
{
    protected $pdo;
    
    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    protected function view($view, $data = [])
    {
        extract($data);
        require_once "app/Views/layouts/header.php";
        require_once "app/Views/pages/$view.php";
        require_once "app/Views/layouts/footer.php";
    }

    protected function redirect($path)
    {
        header("Location: $path");
        exit;
    }

    protected function requireAuth()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }
    }
}
