## 📖 Descrição
Este projeto é uma API simples para um estoque de livros feita em PHP puro para exercitar minhas habilidades em PHP.

### ⚙️ Funcionalidades
Todas as operações de um CRUD, isto é:
- Listar livros(GET)
- Registrar livros(POST)
- Editar dados de livros(PUT)
- Remover livros(DELETE)

### 🚀 Como rodar o código
Para rodar o código será necessário um servidor como o XAMPP, no caso desta opção basta colocar a pasta raiz do projeto
na pasta htdocs, iniciar o Apache e envar as requisições HTTP para as seguintes URLs:
- http://localhost/php-bookstore-api/public/index.php/api/books para Listar todos os livros e Registrar um novo livro.
- http://localhost/php-bookstore-api/public/index.php/api/books/id para Listar um livro por número do ID, Editar dados de um livro ou Remover um livro.

Formato do corpo da requisição POST para registrar um livro:

    {
        "title": "Clean Code",
        "author": "Robert C. Martin",
        "pages": 464,
        "publication_date": "01-08-2008",
        "price": 39.9
    }
