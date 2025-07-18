<?php

require_once 'app/Controllers/BaseController.php';

class AuthController extends BaseController
{
    public function showLogin()
    {
        if (isset($_SESSION['user_id'])) $this->redirect('/profile');
        $this->view('login');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $this->redirect('/profile');
            } else {
                $_SESSION['error'] = 'E-mail ou senha incorretos.';
                $this->redirect('/login');
            }
        }
    }

    public function showRegister()
    {
        if (isset($_SESSION['user_id'])) $this->redirect('/profile');
        $this->view('register');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            try {
                $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
                $stmt->execute([$name, $email, $password]);
                $_SESSION['message'] = 'Conta criada com sucesso! Faça login.';
                $this->redirect('/login');
            } catch (PDOException $e) {
                $_SESSION['error'] = 'E-mail já cadastrado ou erro no sistema.';
                $this->redirect('/register');
            }
        }
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('/');
    }
}
