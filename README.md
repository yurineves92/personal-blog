# Personal Blog em PHP

Este é um projeto simples de blog pessoal desenvolvido em PHP, utilizando Bootstrap 5 para o front-end e Parsedown para renderização de posts em Markdown. O sistema possui autenticação, criação e edição de posts, área de assinantes e visualização responsiva.

---

## Funcionalidades

- Cadastro e login de usuários
- Criação, edição, exclusão e visualização de posts
- Posts escritos em Markdown, renderizados com Parsedown
- Área para gerenciamento de assinantes (newsletter)
- Filtro e busca de posts por texto e autor
- Paginação de posts
- Layout responsivo com Bootstrap 5
- Dark mode ativado via Bootstrap
- Navegação entre posts (anterior/próximo)
- Proteção de rotas para usuários autenticados
- Visualização responsiva e otimizada para dispositivos móveis

---

## Requisitos

- PHP 7.4 ou superior
- MySQL ou MariaDB
- Composer (para gerenciar dependências)
- Servidor web (Apache, Nginx, etc.)

---

## Instalação

1. Faça o download ou clone o repositório para sua máquina local.

2. Instale as dependências do projeto utilizando o Composer.

3. Configure o banco de dados MySQL:
   - Crie um banco de dados (por exemplo, `blog`).
   - Importe os arquivos SQL que contêm o esquema do banco e os dados de exemplo, incluindo os posts.

4. Ajuste as credenciais do banco de dados no arquivo `config/database.php` para conectar ao seu banco.

5. Configure seu servidor web para apontar para a pasta pública do projeto (por exemplo, `public` ou a raiz do projeto).

---

## Uso

- Acesse o site pelo navegador.
- Cadastre um novo usuário ou utilize o usuário de teste já existente.
- Crie, edite e visualize posts no blog.
- Inscreva-se na newsletter para receber atualizações.
- Visualize a lista de assinantes (rota protegida para usuários autenticados).
- Utilize a busca e filtros para navegar pelos posts.
- Navegue entre posts usando os links de post anterior e próximo.
- Aproveite o layout responsivo e o modo escuro para melhor experiência.

---

## Renderização Markdown

Os posts são escritos em Markdown e renderizados com a biblioteca [Parsedown](https://parsedown.org/). O projeto utiliza o Composer para gerenciar essa dependência, garantindo que o conteúdo dos posts seja exibido com a formatação correta (títulos, listas, negrito, etc.).

---

## Estrutura do Projeto

| Caminho                     | Descrição                                           |
|-----------------------------|-----------------------------------------------------|
| `/assets/css/style.css`     | Estilos customizados para o layout e posts          |
| `/libs/Parsedown.php`       | Biblioteca Parsedown (caso não use Composer)        |
| `/controllers/`             | Controladores PHP que gerenciam a lógica do sistema |
| `/views/`                   | Templates PHP para renderização das páginas         |
| `/config/database.php`      | Configuração da conexão com o banco de dados        |
| `/index.php`                | Front Controller que roteia as requisições          |
| `/posts_data_fixed.sql`     | Arquivo SQL com dados de posts para teste           |
---

## Segurança

- As rotas que exigem autenticação são protegidas para evitar acesso não autorizado.
- A biblioteca Parsedown é utilizada em modo seguro para evitar injeção de código malicioso.
- Senhas são armazenadas utilizando hashing seguro (ex: `password_hash` do PHP).

---

## Contribuição

Contribuições são bem-vindas! Você pode abrir issues para reportar bugs ou sugerir melhorias, e enviar pull requests para adicionar funcionalidades ou corrigir problemas.

---

## Licença

Este projeto está licenciado sob a licença MIT. Consulte o arquivo LICENSE para mais detalhes.

---

## Contato

Yuri do Valle Neves  
[GitHub](https://github.com/yurineves92)
[LinkedIn](https://www.linkedin.com/in/yuri-neves-555b44aa/)