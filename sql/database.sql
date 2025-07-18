-- Crie o banco de dados
CREATE DATABASE IF NOT EXISTS blog_yn DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE blog_yn;

-- Tabela de usuários
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de posts
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    status ENUM('rascunho', 'publicado', 'arquivado') DEFAULT 'rascunho',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabela de inscrições por e-mail
CREATE TABLE subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Usuário de exemplo (senha: password)
INSERT INTO users (name, email, password) VALUES
('Yuri do Valle Neves', 'yuri@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Posts de exemplo
INSERT INTO posts (user_id, title, content, status) VALUES
(1, 'Meu primeiro post', 'Este é o conteúdo do meu primeiro post no blog. Aqui vou compartilhar minhas ideias e experiências.', 'publicado'),
(1, 'Post em rascunho', 'Este post ainda está sendo escrito...', 'rascunho'),
(1, 'Post arquivado', 'Este post foi arquivado por algum motivo.', 'arquivado');